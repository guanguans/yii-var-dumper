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
    protected $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = require __DIR__.'/main.php';
    }

    public function testModule()
    {
        $this->assertTrue(\Yii::$app->hasModule('dumper'));
    }

    public function tearHost()
    {
        $this->assertSame($this->config['modules']['dumper']['host'], \Yii::$app->getModule('dumper')->host);
    }
}
