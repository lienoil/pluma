<?php

namespace Tests\API\Controllers;

use Course\Models\Course;
use GuzzleHttp\Client;
use Tests\Support\Test\DatabaseMigrations;
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

    const API_GET_ALL_COURSES = 'api.courses.all';
    const API_POST_STORE_COURSE = 'api.courses.store';

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
        $response = $this->get(route(self::API_GET_ALL_COURSES));
        $expected = 302;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);

        // Should return 200
        $user = new \User\Resources\User($user);
        $response = $this->get(
            route(
                self::API_GET_ALL_COURSES,
                $user->only('api_token')
            )
        );
        $expected = 200;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);
    }
}
