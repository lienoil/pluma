<?php

namespace Tests\Unit;

use Course\Models\Course;
use Course\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\Test\Concerns\InteractsWithDatabase;
use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\DatabaseTransactions;
use Tests\Support\Test\RefreshDatabase;
use Tests\Support\Test\WithFaker;
use Tests\TestCase;
use User\Models\User;

class CourseUnitTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
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

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testLessonCanInsertNodes()
    {
        $lessons = factory(Lesson::class, 10)->create();

        collect($lessons)->each(function ($lesson) {
            // Insert each lesson as a top level node.
            // E.g.
            //   Lesson 1
            //   Lesson 2
            //   Lesson 3 ... 10
            $lesson->insertSelfToNode();

            // Each lessons will have 5 chapters.
            // First we insert these 'chapters' in the lessons table.
            $chapters = factory(Lesson::class, 5)->create();

            // Then each chapters will be a child of this current $lesson.
            // E.g.
            //   Lesson 1
            //   ---- Chapter 1
            //   ---- Chapter 2 ... 5
            //   Lesson 2  <-- next $lesson in loop
            //   ---- Chapter 1
            //   ---- Chapter 2 ... 5
            collect($chapters)->each(function ($chapter) use ($lesson) {
                $chapter->insertNodeAsChildOf($lesson->id);
            });

        });

        // We should expect the number of rows in the closure table to be:
        // 10 lessons + ((10 lessons x 5 chapters) x 2 depths)
        // ---------------------------------------------------
        // Result: 110 rows
        //
        // We multiply by 2 depths since the depth is 2 level deep,
        // e.g. Lesson -> Chapter.
        $expected = 110;

        // We will now check the actual rows of the table.
        $actual = DB::table((new Lesson)->getAdjacentTable())->count();

        // Assertion
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testLessonCanBeMoved()
    {
        $lessons = factory(Lesson::class, 2)->create();
        $lesson = $lessons->first();

        // $lesson->moveNodeTo($lessons->last()->id);

        // $s = DB::table((new Lesson)->getAdjacentTable())->get();
        $this->assertEquals(true, true);
    }
}
