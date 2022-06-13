<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class ThankyouComponent extends Component
{
    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        $ooid = session()->get('order')['order'];

        return view('livewire.thankyou-component', ['ooid' => $ooid])->layout('layouts.base');
    }
}
