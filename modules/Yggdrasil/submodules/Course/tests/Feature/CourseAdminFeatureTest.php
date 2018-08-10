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
class CourseAdminFeatureTest extends TestCase
{
    use DatabaseMigrations, WithRepository;

    /**
     * @test
     * @group course:feature
     */
    public function testUserCanInteractWithCoursesPage()
    {
        // Save to database first.
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        $course = factory(Course::class)->create();

        $response = $this->get(route('courses.index'));

        $response
            // Check if no error is thrown.
            ->assertStatus(200)
            // Important to let the users see
            // a confirmation title.
            ->assertSee(__('All Courses'));
    }

    /**
     * @test
     * @group course:feature
     *
     */
    public function testUserCanReadASingleCourse()
    {
        // Save to database first.
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        $course = factory(Course::class)->create();

        $response = $this->get(route('courses.show', $course->slug));

        $response
            // Check if no error is thrown.
            ->assertStatus(200);
    }

    /**
     * @test
     * @group course:feature
     */
    public function testUserCanCreateCourse()
    {
        // Save to database first.
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        $response = $this->get(route('courses.create'));
        $response
            // Chcek if no error is thrown.
            ->assertStatus(200);
    }

    /**
     * @test
     * @group course:feature
     */
    public function testUserCanStoreCourse()
    {
        // Save to database first.
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        $course = factory(Course::class)->make();

        $response = $this->get(route('courses.store', $course));

        $response
            // Check if no error is thrown.
            ->assertStatus(200);
    }

    /**
     * @test
     * @group course:feature
     */
    public function testUserCanUpdateCourse()
    {
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        $course = factory(Course::class)->make();

        $response = $this->get(route('courses.update', $course));

        $response
            // Check if no error is thrown.
            ->assertStatus(200);
    }

    /**
     * @test
     * @group course:feature
     */
    public function testuserCandDestroyCourse()
    {
        Artisan::call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        Artisan::call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
        $user->roles()->attach(Role::whereCode('superadmin')->first());
        $this->actingAs($user);

        $course = factory(Course::class)->make();

        $response = $this->get(route('courses.destroy', $course));

        $response->assertStatus(200);
    }

    /** @provider */
    public function providerSeed()
    {
        $this->refreshApplication();

        $user = factory(User::class)->make();

        return [
            // for testClientCanLogInViaLoginPage
            [$user->toArray(), [], true],
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $user
     * @return \User\Models\User
     */
    protected function persistProviderToDatabase(array $user) : User
    {
        return $this->repository(UserRepository::class, User::class)
            ->create(array_merge(
                $user, ['password' => Hash::make('secret')]
            ));
    }

}
