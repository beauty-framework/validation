<?php

namespace Beauty\Validation\Tests;

use Beauty\Validation\Rules\AlphaDash;
use PHPUnit\Framework\TestCase;

class AlphaDashTest extends TestCase
{

    public function setUp(): void
    {
        $this->rule = new AlphaDash;
    }

    public function testValids()
    {
        $this->assertTrue($this->rule->check('123'));
        $this->assertTrue($this->rule->check('abc'));
        $this->assertTrue($this->rule->check('123abc'));
        $this->assertTrue($this->rule->check('abc123'));
        $this->assertTrue($this->rule->check('foo_123'));
        $this->assertTrue($this->rule->check('213-foo'));
    }

    public function testInvalids()
    {
        $this->assertFalse($this->rule->check('foo bar'));
        $this->assertFalse($this->rule->check('123 bar '));
    }
}
