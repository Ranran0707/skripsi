<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use Livewire\Component;

class AdminAttributesComponent extends Component
{

    public function deleteAttribute($attribute_id)
    {
        $paatribute = ProductAttribute::find($attribute_id);
        $paatribute->delete();
        session()->flash('message', 'Attribute has been Updated !');
    }

    public function render()
    {
        $pattributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-attributes-component', ['pattributes' => $pattributes])->layout('layouts.base');
    }
}
