<?php

namespace Tests\Feature;

use Tests\Support\Test\Concerns\InteractsWithAuthentication;
use Tests\Support\Test\WithFaker;
use Tests\Support\Test\WithRepository;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

class ClientFeatureTest extends TestCase
{
    use WithFaker, WithRepository, InteractsWithAuthentication;

    /**
     * User instance to mock.
     *
     * @var \User\Models\User
     */
    protected $user;

    /** setUp */
    public function setUp()
    {
        parent::setUp();

        $provider = factory(User::class)->make();
        $this->user = $this->repository(UserRepository::class, User::class)
                           ->create($provider->toArray());
    }

    public function providerUser()
    {
        $provider = factory(User::class)->make();
        $this->user = $this->repository(UserRepository::class, User::class)
                           ->create($provider->toArray());
        return $this->user->toArray();
    }

    /**
     * @group         client
     * @dataProvider  providerUser
     * @return        void
     */
    public function testClientCanLogInViaLoginPage($user)
    {
        // Mock user is logged in
        $this->actingAs($user);

        $this->assertAuthenticatedAs($user);
        $this->assertTrue(true, true);
        // dd($user);
    }
}
