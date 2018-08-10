<?php

namespace Tests\API\Controllers;

use Course\Models\Course;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Pluma\Support\Repository\Repository;
use Tests\Support\Test\Concerns\InteractsWithDatabase;
use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\DatabaseTransactions;
use Tests\Support\Test\RefreshDatabase;
use Tests\Support\Test\WithFaker;
use Tests\TestCase;
use User\Models\User;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CoursesApiControllerTest extends TestCase
{
    use DatabaseMigrations;

    const API_GET_ALL_COURSE = 'api.courses.all';
    const API_POST_STORE_COURSE = 'api.courses.store';
    const API_POST_FIND_COURSE = 'api.courses.search';
    const API_GET_SHOW_COURSE = 'api.courses.show';
    const API_DELETE_DESTROY_COURSE = 'api.courses.destroy';

    private $client;

    /** setup */
    public function setUp()
    {
        parent::setUp();

        $this->client = new Client([
            'base_uri' => url('/'),
            'request.options' => [
                'exceptions' => false,
            ]
        ]);
    }

    /** tear down */
    public function tearDown()
    {
        $this->client = null;

        parent::tearDown();
    }

    /**
     * @test
     * @group course:api
     */
    public function testShouldReturnAllCoursesWithAPITokenAuthentication()
    {
        $course = factory(Course::class)->create();
        $user = factory(User::class)->create(
            ['api_token' => User::tokenize('secret')]
        );

        // Should redirect since user token is missing from parameters.
        $response = $this->get(route(self::API_GET_ALL_COURSE));
        $expected = 302;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);

        // Should return 200
        $this->actingAs($user);
        $user = new \User\Resources\User($user);
        $response = $this->get(
            route(
                self::API_GET_ALL_COURSE,
                $user->only('api_token')
            )
        );
        $expected = 200;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);

        // Should return courses
        $expected = $course->count();
        $actual = $response->getData();
        $this->assertEquals($expected, $actual->total);
    }

    /**
     * @test
     * @group course:api
     */
    public function testShouldSearchCoursesWithAPITokenAuthentication()
    {

        $course = factory(Course::class)->create();
        $user = factory(User::class)->create(
            ['api_token' => User::tokenize('secret')]
        );

        // Should redirect since user token is missing from parameters.
        $response = $this->get(route(self::API_POST_FIND_COURSE));
        $expected = 302;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);

        // Should return 200
        $this->actingAs($user);
        $user = new \User\Resources\User($user);
        $response = $this->get(
            route(
                self::API_POST_FIND_COURSE,
                $user->only('api_token')
            )
        );
        $expected = 200;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);

        // Should return courses
        $expected = $course->count();
        $actual = $response->getData();
        $this->assertEquals($expected, $actual->total);
    }

    /**
     * @test
     * @group course:api
     */
    public function testShouldStoreCoursesWithAPITokenAuthentication()
    {

        $user = factory(User::class)->create(
            ['api_token' => User::tokenize('secret')]
        );

        // Should redirect since user token is missing from parameters
        $response = $this->get(route(self::API_POST_STORE_COURSE));
        $expected = 302;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);

        // Should return 200
        $user = new \User\Resources\User($user);
        $response = $this->get(
            route(
                self::API_POST_STORE_COURSE,
                $user->only('api_token')
            )
        );

        $courses = factory(Course::class, 3)->create();
        $expected = 3;
        $actual = $courses->count();
        $this->assertEquals($expected, $actual);

        $course = $courses->first();
        $actual = DB::table((new Course)->getTable())->first();

        // Assertion
        $this->assertContains($course->code, (array) $actual);

    }

    /**
     * @test
     * @group course:asd
     */
    public function testShouldRestoreCourseWithAPITokenAuthentication()
    {

    }



}
