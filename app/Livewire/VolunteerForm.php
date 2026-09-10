<?php

namespace App\Livewire;

use App\Models\VolunteerApplication;
use Livewire\Component;
use Livewire\WithFileUploads;

class VolunteerForm extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $profession = '';
    public string $skills = '';
    public string $motivation = '';
    public string $availability = '';
    public $cv = null;
    public bool $sent = false;

    protected array $rules = [
        'name' => 'required|string|min:2|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'profession' => 'nullable|string|max:255',
        'skills' => 'nullable|string|max:2000',
        'motivation' => 'required|string|min:20|max:5000',
        'availability' => 'nullable|string|max:255',
        'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
    ];

    public function submit(): void
    {
        $this->validate();

        $cvPath = $this->cv ? $this->cv->store('cvs', 'public') : null;

        VolunteerApplication::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profession' => $this->profession,
            'skills' => $this->skills,
            'motivation' => $this->motivation,
            'availability' => $this->availability,
            'cv_path' => $cvPath,
            'status' => 'pending',
        ]);

        $this->reset(['name','email','phone','profession','skills','motivation','availability','cv']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.volunteer-form');
    }
}
