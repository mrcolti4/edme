<?php

namespace App\Livewire\Profile;

use App\Services\Stripe\StripeService;
use Livewire\Component;

class CreditCards extends Component
{
    public $stripeId;
    protected $stripeService;

    public function mount(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }
    public function render()
    {
        $cards = $this->stripeService->getCustomerCards(customerId: $this->stripeId);

        return view('livewire.profile.credit-cards', compact('cards'));
    }
}
