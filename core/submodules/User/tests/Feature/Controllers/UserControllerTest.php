<?php

namespace Tests\Feature\Controllers;

use Tests\Support\Test\Concerns\InteractsWithAuthentication;
use Tests\Support\Test\RefreshDatabase;
use Tests\Support\Test\WithFaker;
use Tests\TestCase;
use User\Models\User;

class UserControllerTest extends TestCase
{
    use WithFaker,
        InteractsWithAuthentication;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndexMethod()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('admin/users')
             ->see('');
    }
}
