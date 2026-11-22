<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    public function test_admin_login_page_is_rendered(): void
    {
        $this->withoutVite();

        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Împreună Învățăm');
    }
}
