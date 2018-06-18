<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Tests\Support\Test\RefreshDatabase;
use Tests\Support\Test\WithFaker;
use Tests\TestCase;
use User\Models\User;
use User\Repositories\UserRepository;

class UserUnitTest extends TestCase
{
    use WithFaker;

    /** @test  */
    public function it_can_create_a_user()
    {
        // $data = factory(User::class)->create()->toArray();
        $data = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $email = $this->faker->unique()->safeEmail,
            'username' => str_slug($email),
            'password' => Hash::make('secret'), // $2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm
            'remember_token' => str_random(10),
        ];

        $repository = new UserRepository(new User);

        $user = $repository->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['firstname'], $user->firstname);
        $this->assertEquals($data['lastname'], $user->lastname);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['username'], $user->username);
        $this->assertEquals($data['password'], $user->password);
    }
}
