<?php

namespace Tests\Unit;

use App\Controllers\Foo;
use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    public function test_bar_returns_one()
    {
        $foo = new Foo();

        $this->assertEquals(1, $foo->bar());
    }
}
