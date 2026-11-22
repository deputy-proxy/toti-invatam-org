<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_is_rendered(): void
    {
        $this->withoutVite();

        $this->get('/')
            ->assertOk();
    }
}
