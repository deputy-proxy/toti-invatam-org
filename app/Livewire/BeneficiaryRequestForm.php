<?php

namespace App\Livewire;

use App\Models\BeneficiaryRequest;
use Livewire\Component;

class BeneficiaryRequestForm extends Component
{
    public string $requester_name = '';

    public string $email = '';

    public string $phone = '';

    public string $beneficiary_type = 'school';

    public string $educational_need = '';

    public string $target_audience = '';

    public string $location = '';

    public int $estimated_beneficiaries = 0;

    public string $requested_support = '';

    public string $urgency = 'normal';

    public bool $sent = false;

    protected array $rules = [
        'requester_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'beneficiary_type' => 'required|string|max:100',
        'educational_need' => 'required|string|min:20|max:5000',
        'target_audience' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'estimated_beneficiaries' => 'nullable|integer|min:0',
        'requested_support' => 'nullable|string|max:5000',
        'urgency' => 'required|in:low,normal,high,critical',
    ];

    public function submit(): void
    {
        $this->validate();
        BeneficiaryRequest::create([...$this->only(array_keys($this->rules)), 'status' => 'new']);
        $this->reset(array_keys($this->rules));
        $this->beneficiary_type = 'school';
        $this->urgency = 'normal';
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.beneficiary-request-form');
    }
}
