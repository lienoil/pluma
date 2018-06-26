<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Tests\Support\Test\Concerns\InteractsWithAuthentication;
use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\WithRepository;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

class ClientFeatureTest extends TestCase
{
    use DatabaseMigrations, WithRepository;

    /** setUp */
    public function setUp()
    {
        parent::setUp();

        $provider = factory(User::class)->make();
        $this->user = $this->repository(UserRepository::class, User::class)
                           ->create($provider->toArray());
    }

    /** @provider */
    public function providerUser()
    {
        $this->refreshApplication();

        $provider = factory(User::class)->make();

        return [
            // for testClientCanLogInViaLoginPage
            [$provider->toArray(), [], true],
        ];
    }

    /**
     * @test
     * @group         client
     * @dataProvider  providerUser
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testClientCanLogInViaLoginPage($user)
    {
        // Save to database first.
        $user = $this->persistProviderToDatabase($user);

        // Log in user via the url
        $this->post(route('login.login', $user->only(['username', 'password'])));
        $this->actingAs($user);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @group         client
     * @dataProvider  providerUser
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testLoginWithWrongCredentials($user)
    {
        // Save to database first.
        $user = $this->persistProviderToDatabase($user);

        $this->get(route('login.show'))
            ->assertStatus(200);

        $this->post(route('login.login', $user->only(['username', 'password'])))
            ;
    }

    protected function persistProviderToDatabase($user)
    {
        return $this->repository(UserRepository::class, User::class)
            ->create(array_merge(
                $user, ['password' => Hash::make('secret')]
            ));
    }
}
