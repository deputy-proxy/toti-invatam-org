<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submits_and_persists_a_message(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('subject', 'Question')
            ->set('message', 'This is a test message for the contact form.')
            ->call('submit')
            ->assertSet('sent', true);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'Question',
            'status' => 'new',
        ]);
    }
}
