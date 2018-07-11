<?php

namespace Tests\Feature;

use Course\Models\Course;
use Illuminate\Support\Facades\Hash;
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
        $user = factory(User::class)->create(['password' => Hash::make('secret')]);
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
     * @dataProvider providerSeed
     */
    public function testUserCanReadASingleCourse($user)
    {
        $user = factory(User::class)->create(); // $this->persistProviderToDatabase($user);
        $this->actingAs($user);

        $course = factory(Course::class)->create();

        $response = $this->get(route('courses.show', $course->slug));

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
