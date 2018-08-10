<?php

namespace Tests\Feature;

use Course\Models\Course;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Role\Models\Role;
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
class BookmarkUnitTest extends TestCase
{
    use DatabaseMigrations, WithRepository;

    /**
     * @test
     * @group bookmark:test
     */
    public function testUserCanViewMyCourses()
    {
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        //$course = factory(Course::class)->create();

        $response = $this->get(route('courses.my'));

        $response->assertStatus(200);
    }

    /**
     * @test
     * @group bookmark:test
     */
    public function testUserCanInteractWithBookmarkPage()
    {
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        //$course = factory(Course::class)->create();

        $response = $this->get(route('courses.bookmarked'));

        $response->assertStatus(200);
    }
}
