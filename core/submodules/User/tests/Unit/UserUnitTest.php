<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Database\Eloquent\Faker;
use Tests\Support\Test\Concerns\InteractsWithAuthentication;
use Tests\Support\Test\Concerns\InteractsWithDatabase;
use Tests\Support\Test\Concerns\MocksApplicationServices;
use Tests\Support\Test\WithFaker;
use Tests\Support\Test\WithRepository;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

class UserUnitTest extends TestCase
{
    use WithFaker, WithRepository;

    /**
     * @test
     * @group user
     * @return void
     */
    public function testItCanCreateAUser()
    {
        $provider = $this->app->make(EloquentFactory::class)->of(User::class)->make();
        $user = $this->repository(UserRepository::class, User::class)->create($provider->toArray());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($provider->firstname, $user->firstname);
        $this->assertEquals($provider->lastname, $user->lastname);
        $this->assertEquals($provider->email, $user->email);
        $this->assertEquals($provider->username, $user->username);
        $this->assertEquals($provider->password, $user->password);
    }

    /**
     * @test
     * @group user
     * @return void
     */
    public function testUserCanLogin()
    {
        $provider = factory(User::class)->make();
        $user = $this->repository(UserRepository::class, User::class)->create($provider->toArray());

        $this->get(route('login.show'))
             ->assertStatus(200);

        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->get(route('login.show'));
        $this->followRedirects($response)->assertStatus(200);
    }

    /**
     * @test
     * @group user
     * @return void
     */
    public function testUserCanLogout()
    {
        $this->get(route('login.logout'))
             ->followRedirects($response)->assertStatus(200);
    }
}
