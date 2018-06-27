<?php

namespace Tests\Unit\Models;

use Course\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Tests\Support\Test\DatabaseMigrations;
use Tests\TestCase;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class LessonModelUnitTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group lesson
     */
    public function testLessonNodesCanBeAttached()
    {
        $lessons = factory(Lesson::class, 10)->create();

        $actual = DB::table((new Lesson)->getAdjacentTable())->get();

        collect($lessons)->each(function ($lesson) {
            // Insert each lesson as a top level node.
            // E.g.
            //   Lesson 1
            //   Lesson 2
            //   Lesson 3 ... 10
            $lesson->adjaceables()->addAsRoot();

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
                $lesson->adjaceables()->attach($chapter);
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
     * @group lesson
     */
    public function testLessonNodesCanBeMoved()
    {
        $lessons = factory(Lesson::class, 5)->create();

        collect($lessons)->each(function ($lesson) {
            // Insert each lesson as a top level node.
            // E.g.
            //   Lesson 1
            //   Lesson 2 ... 5
            $lesson->adjaceables()->addAsRoot();
        });

        $firstLesson = $lessons->first();
        $secondLesson = $lessons->get(1);

        // Move the $firstLesson under the $secondLesson
        // Result:
        //   Lesson 2
        //   ---- Lesson 1
        //   Lesson 3
        //   Lesson 4
        //   Lesson 5
        $firstLesson->adjaceables()->move($secondLesson->id);

        // We should expect the number of rows in the closure table to be:
        // 4 lesson + ((1 lesson x 1 moved lesson) x 2 depths)
        // ---------------------------------------------------
        // Result: 6 rows
        //
        // We multiply by 2 depths since the depth is 2 level deep,
        // e.g. Lesson -> Moved Lesson.
        $expected = 6;

        // We will now check the actual rows of the table.
        $actual = DB::table((new Lesson)->getAdjacentTable())->count();

        // Assertion
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @group lesson
     */
    public function testLessonNodesCanBeDetached()
    {
        $lessons = factory(Lesson::class, 5)->create();

        collect($lessons)->each(function ($lesson) {
            $lesson->adjaceables()->addAsRoot();

            $chapters = factory(Lesson::class, 5)->create();
            collect($chapters)->each(function ($chapter) use ($lesson) {
                $lesson->adjaceables()->attach($chapter);
            });
        });

        // Retrieve this:
        // Lesson 1
        // ---- Chapter 1 <-- this
        // Lesson 2 ... 5
        $firstChapterOfFirstLesson = Lesson::find(6);

        // Detach
        // Result:
        // Lesson 1
        // Lesson 2 ... 5
        $firstChapterOfFirstLesson->adjaceables()->detach();

        $expected = 53; // from 55
        $actual = DB::table((new Lesson)->getAdjacentTable())->count();
        $this->assertEquals($expected, $actual);

        // Retrieve second lesson
        // and detach with all 5 children.
        $secondLesson = Lesson::find(2);
        $secondLesson->adjaceables()->detach();

        $expected = 42; // 53 - (1 + ((1 * 5) * 2))
        $actual = DB::table((new Lesson)->getAdjacentTable())->count();
        $this->assertEquals($expected, $actual);
    }
}
