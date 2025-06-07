<?php

namespace Beauty\Validation\Tests;

use Beauty\Validation\Rules\Regex;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{

    public function setUp(): void
    {
        $this->rule = new Regex;
    }

    public function testValids()
    {
        $this->assertTrue($this->rule->fillParameters(["/^F/i"])->check("foo"));
    }

    public function testInvalids()
    {
        $this->assertFalse($this->rule->fillParameters(["/^F/i"])->check("bar"));
    }
}
