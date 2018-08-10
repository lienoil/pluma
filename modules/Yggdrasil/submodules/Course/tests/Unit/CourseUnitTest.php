<?php

namespace Tests\Unit;

use Course\Models\Course;
use Course\Models\Lesson;
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
class CourseUnitTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group course
     */
    public function testCoursesCanBeCreated()
    {
        $courses = factory(Course::class, 10)->create();

        $expected = 10;
        $actual = $courses->count();

        // Assertion
        $this->assertEquals($expected, $actual);

        $course = $courses->first();
        $actual = DB::table((new Course)->getTable())->first();

        // Assertion
        $this->assertContains($course->code, (array) $actual);
    }
}
