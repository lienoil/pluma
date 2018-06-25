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
    use DatabaseMigrations, DatabaseTransactions;

    /** @provider */
    public function providerLessonData()
    {
        $this->refreshApplication();

        $lessons = factory(Lesson::class, 10)->create();

        return [
            [$lessons],
        ];
    }

    /**
     * @test
     * @dataProvider providerLessonData
     */
    public function testLessonCanInsertItselfAsRootNode($lessons)
    {
        $lesson = $lessons->first();

        $this->assertEquals($expected, $actual);
    }
}
