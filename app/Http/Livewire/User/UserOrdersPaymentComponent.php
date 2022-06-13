<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\Shipping;
use Illuminate\Support\Facades\DB;

class UserOrdersPaymentComponent extends Component
{
    public $snapToken;
    public $order_id;
    public $belanja;
    public $va_number;
    public $gross_amount;
    public $bank;
    public $transaction_status;
    public $deadline;
    public $ts;


    public function mount($order_id)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        if (isset($_GET['result_data'])) {
            $current_status = json_decode($_GET['result_data'], true);
            $id = $current_status['order_id'];
            $this->belanja = Order::where('id', $id)->first();
            // $this->ts = Transaction::where('order_id', $id)->first();

            $this->belanja->status = 'pending';
            $this->belanja->update();
            // $this->ts->status = 'approved';
            // $this->ts->update();
        } else {
            $this->belanja = Order::find($order_id);
        }



        // dd($this->belanja);

        if (!empty($this->belanja)) {
            if ($this->belanja->status == 'ordered') {
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $this->belanja->id,
                        'gross_amount' => $this->belanja->total + $this->belanja->cost,
                    ),
                    'customer_details' => array(
                        'first_name' => $this->belanja->firstname,
                        'last_name' => $this->belanja->lastname,
                        'email' => Auth::user()->email,
                        'phone' => $this->belanja->mobile,
                    ),
                );
                $this->snapToken = \Midtrans\Snap::getSnapToken($params);
            } elseif ($this->belanja->status == 'pending') {
                $status = \Midtrans\Transaction::status($this->belanja->id);
                $status = json_decode(json_encode($status), true);

                $this->va_number = $status['va_numbers'][0]['va_number'];
                $this->gross_amount = $status['gross_amount'];
                $this->bank = $status['va_numbers'][0]['bank'];
                $this->transaction_status = $status['transaction_status'];
                $transaction_time = $status['transaction_time'];
                $this->deadline = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                if ($this->transaction_status == 'settlement') {
                    $id = $this->belanja->id;
                    $this->ts = Transaction::where('order_id', $id)->first();
                    $this->ts->status = 'approved';
                    $this->ts->update();
                }
            }
        }
    }

    // public function makeTransaction($order_id)
    // {
    //     $transaction = Order::where('id', $order_id)->first();
    //     $transaction->status = 'approved';
    //     $transaction->update();
    // }


    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->first();
        $transaction = Transaction::where('user_id', Auth::user()->id)->where('order_id', $this->order_id)->first();


        return view('livewire.user.user-orders-payment-component', ['order' => $order, 'transaction' => $transaction])->layout('layouts.base');
    }
}
