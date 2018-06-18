<?php

namespace Tests\Feature;

use Illuminate\Database\Capsule\Manager as Capsule;
use Tests\Support\Test\RefreshDatabase;
use Tests\Support\Test\WithFaker;
use Tests\TestCase;
use User\Models\User;

class SnackTest extends TestCase
{
    /**
     * _________________________.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }
}
