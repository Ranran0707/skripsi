<?php

namespace App\Http\Livewire;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Kavist\RajaOngkir\RajaOngkir;

class CheckoutComponent extends Component
{
    public $firstname, $lastname, $email, $mobile, $f_address, $line2, $city, $cost, $province, $zipcode;

    public $thankyou;
    public $oid;

    private $apiKey = '1418cb13a5cb7a1562715512e1a14b81';

    public $jasa;
    public $daftarProvinsi;
    public $daftarKota;
    public $coba;
    public $totalCost;

    public function update($fields)
    {
        $this->validateOnly($fields, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'f_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
        ]);
    }

    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'f_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zipcode' => 'required',
        ]);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'] . $this->cost;

        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->f_address = $this->f_address;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->zipcode = $this->zipcode;
        $order->cost = $this->cost;
        $order->status = 'ordered';
        $order->save();

        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            if ($item->options) {
                $orderItem->options = serialize($item->options);
            }

            $orderItem->save();
        }

        $shipping = new Shipping();
        $shipping->order_id = $order->id;
        $shipping->firstname = $this->firstname;
        $shipping->lastname = $this->lastname;
        $shipping->email = $this->email;
        $shipping->mobile = $this->mobile;
        $shipping->f_address = $this->f_address;
        $shipping->city = $this->city;
        $shipping->province = $this->province;
        $shipping->zipcode = $this->zipcode;
        $shipping->cost = $this->cost;
        $shipping->save();

        $this->oid = $shipping->id;
        session()->put('order', ['order' => $order->id]);

        $this->makeTransaction($order->id);
        $this->resetCart();

        $this->sendOrderConfirmationMail($order);
    }

    public function resetCart()
    {
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }

    public function makeTransaction($order_id)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->status = 'pending';
        $transaction->save();
    }

    public function sendOrderConfirmationMail($order)
    {
        Mail::to($order->email)->send(new OrderMail($order));
    }

    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } elseif ($this->thankyou) {
            return redirect()->route('thankyou');
        } elseif (!session()->get('checkout')) {
            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        $rajaOngkir = new RajaOngkir($this->apiKey);
        $this->daftarProvinsi = $rajaOngkir->provinsi()->all();
        if ($this->province) {
            $this->daftarKota = $rajaOngkir->kota()->dariProvinsi($this->province)->get();
        }
        if ($this->city && $this->jasa) {
            $this->totalCost = $rajaOngkir->ongkosKirim([
                'origin' => 489,
                'destination' => $this->city,
                'weight' => 100,
                'courier' => $this->jasa,
            ])->get();
        }
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
