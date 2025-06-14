<?php

namespace Beauty\Validation\Tests;

use Beauty\Validation\Rules\Defaults;
use PHPUnit\Framework\TestCase;

class DefaultsTest extends TestCase
{
    public function setUp(): void
    {
        $this->rule = new Defaults;
    }

    public function testDefaults()
    {
        $this->assertTrue($this->rule->fillParameters([10])->check(0));
        $this->assertTrue($this->rule->fillParameters(['something'])->check(null));
        $this->assertTrue($this->rule->fillParameters([[1,2,3]])->check(false));
        $this->assertTrue($this->rule->fillParameters([[1,2,3]])->check([]));
    }
}
