<?php

namespace App\Livewire\Web\Checkout;

use Livewire\Component;
use App\Models\Order;
use App\Models\proposal;
use App\Models\Transaction;
use Livewire\Attributes\{Layout, Title};
use App\Tools\Cart;
use App\Tools\Paiement;
use Illuminate\Support\Facades\Session;
use Filament\Forms\Get;
use Filament\Forms\Components\Select;

use Livewire\WithFileUploads;
use Filament\Forms\Components\Grid;

use Filament\Forms\Components\{TextInput, Textarea, Section, DatePicker};
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

use Filament\Support\RawJs;
use Illuminate\Support\Facades\DB;
use App\Models\UserSetting;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class CheckoutCustom extends Component
{

    public proposal $proposal;



    public function render()
    {
        return view('livewire.web.checkout.checkout-custom');
    }
}
