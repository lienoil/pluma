<?php

namespace Tests\Unit;

use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\WithRepository;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class UserUnitTest extends TestCase
{
    use DatabaseMigrations,
        WithRepository;

    /**
     * @test
     * @group user
     */
    public function testItCanCreateAUser()
    {
        $repository = $this->repository(UserRepository::class, User::class);

        // // Mock data from UserFactory
        // $provider = factory(User::class)->make();
        // // Create the user.
        // $user = $repository->create($provider->toArray());

        // $this->assertInstanceOf(User::class, $user);
        // $this->assertEquals($provider->email, $user->email);
    }
}
