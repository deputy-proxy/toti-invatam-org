<?php

namespace App\Livewire;

use App\Models\PartnershipInquiry;
use Livewire\Component;

class PartnershipForm extends Component
{
    public string $organisation_name = '';

    public string $contact_name = '';

    public string $email = '';

    public string $phone = '';

    public string $website = '';

    public string $organisation_type = '';

    public string $partnership_type = '';

    public string $message = '';

    public bool $sent = false;

    protected array $rules = [
        'organisation_name' => 'required|string|max:255',
        'contact_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'website' => 'nullable|url|max:255',
        'organisation_type' => 'nullable|string|max:100',
        'partnership_type' => 'nullable|string|max:100',
        'message' => 'required|string|min:20|max:5000',
    ];

    public function submit(): void
    {
        $this->validate();
        PartnershipInquiry::create([...$this->only(array_keys($this->rules)), 'status' => 'new']);
        $this->reset(array_keys($this->rules));
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.partnership-form');
    }
}
