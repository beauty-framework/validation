<?php

namespace Beauty\Validation\Tests;

use Beauty\Validation\Rules\Uppercase;
use PHPUnit\Framework\TestCase;

class UppercaseTest extends TestCase
{

    public function setUp(): void
    {
        $this->rule = new Uppercase;
    }

    public function testValids()
    {
        $this->assertTrue($this->rule->check('USERNAME'));
        $this->assertTrue($this->rule->check('FULL NAME'));
        $this->assertTrue($this->rule->check('FULL_NAME'));
    }

    public function testInvalids()
    {
        $this->assertFalse($this->rule->check('username'));
        $this->assertFalse($this->rule->check('Username'));
        $this->assertFalse($this->rule->check('userName'));
    }
}
