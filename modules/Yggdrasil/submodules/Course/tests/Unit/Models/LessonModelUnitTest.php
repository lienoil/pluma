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
     * @group lesson:unit
     */
    public function testLessonNodesCanBeAttached()
    {
        $lessons = factory(Lesson::class, 10)->create();

        $lessons->each(function ($lesson) {
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
            $chapters->each(function ($chapter) use ($lesson) {
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
     * @group lesson:unit
     */
    public function testLessonNodesCanBeMoved()
    {
        $lessons = factory(Lesson::class, 5)->create();

        $lessons->each(function ($lesson) {
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
     * @group lesson:unit
     */
    public function testLessonNodesCanBeDetached()
    {
        $lessons = factory(Lesson::class, 5)->create();
        $lessons->each(function ($lesson) {
            $lesson->adjaceables()->addAsRoot();

            $chapters = factory(Lesson::class, 5)->create();
            $chapters->each(function ($chapter) use ($lesson) {
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
     * @group lesson:unit
     */
    public function testLessonNodesCanOnlyRetrieveRootNodesAutomaticallyViaScope()
    {
        $course = factory(Course::class)->create();
        $lessons = factory(Lesson::class, 10)->create(['course_id' => $course->id]);

        $lessons->each(function ($lesson) use ($course) {
            $lesson->course()->associate($course);
            // Add all 10 lessons as root.
            $lesson->adjaceables()->addAsRoot();

            // And each root lessons will have 5 chapters.
            $chapters = factory(Lesson::class, 5)->create(['course_id' => $course->id]);

            $chapters->each(function ($chapter) use ($course, $lesson) {
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

    /**
     * @test
     * @group lesson:unit
     */
    public function testLessonChildCanRetrieveNextSibling()
    {
        // Setup
        $course = factory(Course::class)->create();
        $lessons = factory(Lesson::class, 2)->create(['course_id' => $course->id]);
        $lessons->each(function ($lesson) {
            $lesson->adjaceables()->addAsRoot();
            $chapters = factory(Lesson::class, 10)->create();
            $chapters->each(function ($chapter) use ($lesson) {
                $lesson->adjaceables()->attach($chapter);
            });
        });

        /**
         * Chapter Sibling Test
         *
         * Visual representation
         * ---------------------
         *   Lesson 1  <----. $lesson
         *    Chapter 3  <--. $chapter
         *    Chapter 4  <--. $expectedId
         *    ...
         *    Chapter 12
         *   Lesson 2
         *    Chapter 13
         *    ...
         *    Chapter 22
         */
        $lesson = Lesson::first();
        $chapters = $lesson->children;
        $chapter = $chapters->first();
        $expectedId = 4;
        $actual = $chapter->next();
        $this->assertEquals($expectedId, $actual->id);
    }

    /**
     * @test
     * @group lesson:unit
     */
    public function testLessonChildCanRetrievePreviousSibling()
    {
        // Setup
        $lessons = factory(Lesson::class, 2)->create();
        $lessons->each(function ($lesson) {
            $lesson->adjaceables()->addAsRoot();
            $chapters = factory(Lesson::class, 10)->create();
            $chapters->each(function ($chapter) use ($lesson) {
                $lesson->adjaceables()->attach($chapter);
            });
        });

        /**
         * Chapter Sibling Test
         *
         * Visual representation
         * ---------------------
         *   Lesson 1
         *    Chapter 3
         *    Chapter 4
         *    ...
         *    Chapter 12
         *   Lesson 2  <----. $lesson
         *    Chapter 13 <--. $expectedId
         *    Chapter 14 <--. $chapter
         *    ...
         *    Chapter 22
         */
        $lesson = Lesson::find(2);
        $chapters = $lesson->children;
        $chapter = $chapters->get(1);
        $expectedId = 13;
        $actual = $chapter->previous();
        $this->assertEquals($expectedId, $actual->id);
    }

    /**
     * @test
     * @group lesson:unit
     */
    public function testLastLessonShouldReturnNullIfQueryingForNextLesson()
    {
        // Setup
        $lessons = factory(Lesson::class, 2)->create();
        $lessons->each(function ($lesson) {
            $lesson->adjaceables()->addAsRoot();
            $chapters = factory(Lesson::class, 10)->create();
            $chapters->each(function ($chapter) use ($lesson) {
                $lesson->adjaceables()->attach($chapter);
            });
        });

        /**
         * Baseline Test
         *
         * Visual representation
         * ---------------------
         *   Lesson 1  <----. $lesson
         *    Chapter 3
         *    Chapter 4
         *    ...
         *    Chapter 12 <--. $lastChapter
         *               <--. $expected 'null'
         *   Lesson 2
         *    Chapter 13
         *    ...
         *    Chapter 22
         */
        $lesson = Lesson::first();
        $lastChapter = $lesson->children->last();
        $expected = null;
        $actual = $lastChapter->next();
        $this->assertEquals((int) $expected, (int) $actual);

        /**
         * Last Lesson's Last Chapter's Next Sibling Should Be Null
         * Main Test
         *
         * Visual representation
         * ---------------------
         *   Lesson 1
         *    Chapter 3
         *    Chapter 4
         *    ...
         *    Chapter 12
         *   Lesson 2 <-----. $lesson
         *    Chapter 13
         *    ...
         *    Chapter 22 <--. $lastChapter
         *               <--. $expected 'null'
         */
        $lesson = Lesson::find(2);
        $lastChapter = $lesson->children->last();
        $expected = null;
        $actual = $lastChapter->next();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @group lesson:unit
     */
    public function testFirstLessonChildShouldReturnNullIfQueryingForPreviousLesson()
    {
        // Setup
        $lessons = factory(Lesson::class, 2)->create();
        $lessons->each(function ($lesson) {
            $lesson->adjaceables()->addAsRoot();
            $chapters = factory(Lesson::class, 10)->create();
            $chapters->each(function ($chapter) use ($lesson) {
                $lesson->adjaceables()->attach($chapter);
            });
        });

        /**
         * Baseline Test
         *
         * Visual representation
         * ---------------------
         *   Lesson 1
         *    Chapter 3
         *    Chapter 4
         *    ...
         *    Chapter 12
         *   Lesson 2 <-----. $lesson
         *               <--. $expected 'null', not Chapter 12
         *    Chapter 13 <--. $firstChapter
         *    ...
         *    Chapter 22
         */
        $lesson = Lesson::find(2);
        $lastChapter = $lesson->children->first();
        $expected = null;
        $actual = $lastChapter->previous();
        $this->assertEquals($expected, $actual);

        /**
         * First Lesson's First Chapter's Previous Sibling Should Be Null
         *
         * Visual representation
         * ---------------------
         *   Lesson 1 <-----. $lesson
         *               <--. $expected 'null'
         *    Chapter 3  <--. $firstChapter
         *    Chapter 4
         *    ...
         *    Chapter 12
         *   Lesson 2
         *    Chapter 13
         *    ...
         *    Chapter 22
         */
        $lesson = Lesson::first();
        $firstChapter = $lesson->children->first();
        $expected = null;
        $actual = $firstChapter->previous();
        $this->assertEquals($expected, $actual);
        $this->assertEquals($expected, $lesson->previous());
    }
}
