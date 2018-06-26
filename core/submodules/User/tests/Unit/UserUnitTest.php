<?php

namespace Tests\Unit;

use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\WithRepository;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;


class UserUnitTest extends TestCase
{
    use DatabaseMigrations,
        WithRepository;

    /**
     * @test
     * @group user
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testItCanCreateAUser()
    {
        // Mock data from UserFactory
        $provider = factory(User::class)->make();

        // Create the user.
        $user = $this->repository(UserRepository::class, User::class)->create($provider->toArray());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($provider->email, $user->email);
    }
}
