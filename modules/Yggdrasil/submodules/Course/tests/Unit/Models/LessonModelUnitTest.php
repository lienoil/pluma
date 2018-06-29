<?php

namespace Tests\Unit\Models;

use Course\Models\Course;
use Course\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Pluma\Support\Database\Adjacency\Scopes\TreeScope;
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

        // Retrieve Lesson 6:
        // Lesson 1
        // ---- Lesson 6 <-- this
        // ---- Lesson 7 ... 10
        // Lesson 2 ... 5
        $firstChapterOfFirstLesson = Lesson::find(6);
        $this->assertInstanceOf(Lesson::class, $firstChapterOfFirstLesson);

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

    /**
     * @test
     * @group lesson-tree
     */
    public function testLessonNodesCanOnlyRetrieveRootNodesAutomaticallyViaScope()
    {
        $course = factory(Course::class)->create();
        $lessons = factory(Lesson::class, 10)->create(['course_id' => $course->id]);

        collect($lessons)->each(function ($lesson) use ($course) {
            $lesson->course()->associate($course);
            // Add all 10 lessons as root.
            $lesson->adjaceables()->addAsRoot();

            // And each root lessons will have 5 chapters.
            $chapters = factory(Lesson::class, 5)->create(['course_id' => $course->id]);

            collect($chapters)->each(function ($chapter) use ($course, $lesson) {
                $chapter->course()->associate($course);
                $lesson->adjaceables()->attach($chapter);
            });
        });

        $expected = 10;
        $actual = $course->children->count();

        $this->assertEquals($expected, $actual);

        // Test an updated table.
        // This simulates an update where new topics under chapter 12
        // are created.
        // Note that this extra code should not affect the expected result
        // because we are not adding new root nodes.
        //
        // Result:
        //  Lesson 1
        //  ---- Chapter 11
        //  ---- Chapter 12  <--- This is chapter 12
        //  -------- Topic 1 ... 5 <--- Updated with 5 new topics
        //  ---- Chapter 13 ... 15
        //  Lesson 2 ... 10 <--- expected result should still be 10
        $chapter = Lesson::find(12);
        $topics = factory(Lesson::class, 5)->create(['course_id' => $course->id]);
        collect($topics)->each(function ($topic) use ($course, $chapter) {
            $topic->course()->associate($course);
            $chapter->adjaceables()->attach($topic);
        });

        $expected = 10;
        $actual = $course->children->count();

        $this->assertEquals($expected, $actual);
    }
}
