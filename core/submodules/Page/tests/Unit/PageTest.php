<?php

namespace Tests\Unit;

use Page\Models\Page;
use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\RefreshDatabase;
use Tests\Support\Test\WithFaker;
use Tests\TestCase;
use User\Models\User;

/**
 * @package Tests
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PageTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    /**
     * @test
     * @group unit:page
     */
    public function testIfItHasAnAuthor()
    {
        $page = factory(Page::class)->create();

        $this->assertInstanceOf(User::class, $page->user);
    }
}
