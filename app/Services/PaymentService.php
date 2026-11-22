<?php

namespace App\Services;

use App\Models\Donation;

/**
 * Abstract payment layer. Concrete provider (Stripe, Netopia, Mobilpay, PayPal)
 * can be plugged in later without changing the donation flow.
 */
class PaymentService
{
    public function __construct(protected string $provider = 'null') {}

    /**
     * Initiate a payment for a donation.
     *
     * @return array{redirect_url:?string, provider_reference:?string, status:string}
     */
    public function initiate(Donation $donation): array
    {
        return match ($this->provider) {
            'stripe' => $this->initiateStripe($donation),
            'netopia' => $this->initiateNetopia($donation),
            default => $this->initiateNull($donation),
        };
    }

    protected function initiateNull(Donation $donation): array
    {
        // No real provider configured: mark as pending and return without a redirect.
        $donation->update([
            'payment_provider' => 'manual',
            'payment_reference' => 'MANUAL-'.strtoupper(bin2hex(random_bytes(4))),
            'status' => 'pending',
        ]);

        return ['redirect_url' => null, 'provider_reference' => $donation->payment_reference, 'status' => 'pending'];
    }

    protected function initiateStripe(Donation $donation): array
    {
        // Placeholder: real Stripe Checkout Session creation would go here.
        $donation->update(['payment_provider' => 'stripe', 'status' => 'pending']);

        return ['redirect_url' => null, 'provider_reference' => null, 'status' => 'pending'];
    }

    protected function initiateNetopia(Donation $donation): array
    {
        $donation->update(['payment_provider' => 'netopia', 'status' => 'pending']);

        return ['redirect_url' => null, 'provider_reference' => null, 'status' => 'pending'];
    }
}
