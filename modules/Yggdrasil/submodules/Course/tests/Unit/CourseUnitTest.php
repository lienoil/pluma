<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Support\Test\WithFaker;
use Tests\Support\Test\RefreshDatabase;

class CourseUnitTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
