<?php

namespace Tests\API\Controllers;

use Course\Models\Course;
use GuzzleHttp\Client;
use Tests\Support\Test\DatabaseMigrations;
use Tests\TestCase;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CoursesApiControllerTest extends TestCase
{
    use DatabaseMigrations;

    const API_GET_COURSES = '/api/v1/courses/all';
    const API_POST_COURSE = '/api/v1/courses';

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
    public function testGetAllCourses()
    {
        $course = factory(Course::class)->create();

        $response = $this->client->get(self::API_GET_COURSES, []);

        $expected = 200;
        $actual = $response->getStatusCode();
        $this->assertEquals($expected, $actual);

        $contentType = $response->getHeaders()['Content-Type'][0];
        $this->assertEquals('application/json', $contentType);

        dd($response->getBody());
    }
}
