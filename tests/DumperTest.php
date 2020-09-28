<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Tests;

class DumperTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testToDo()
    {
        $this->assertIsString('To do testing.');
    }
}
