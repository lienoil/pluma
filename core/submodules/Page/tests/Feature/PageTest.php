<?php

namespace Tests\Feature;

use Tests\Support\Test\DatabaseMigrations;
use Tests\TestCase;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PageTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function testIfAUserCan()
    {
        $this->assertTrue(true);
    }
}
