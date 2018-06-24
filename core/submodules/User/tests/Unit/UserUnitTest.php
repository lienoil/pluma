<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Database\Eloquent\Faker;
use Tests\Support\Test\Concerns\InteractsWithAuthentication;
use Tests\Support\Test\Concerns\InteractsWithConsole;
use Tests\Support\Test\Concerns\InteractsWithDatabase;
use Tests\Support\Test\WithFaker;
use Tests\Support\Test\WithRepository;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

class UserUnitTest extends TestCase
{
    use InteractsWithAuthentication,
        InteractsWithDatabase,
        InteractsWithConsole,
        WithFaker,
        WithRepository;

    /**
     * @group user
     * @return void
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
