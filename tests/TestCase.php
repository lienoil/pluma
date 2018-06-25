<?php

namespace Tests;

use Tests\Support\Test\DatabaseMigrations;
use Tests\Support\Test\DatabaseTransactions;
use Tests\Support\Test\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
