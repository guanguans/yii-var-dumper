<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

$config = [
    'id' => 'yii-var-dumper',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['dumper'],
    'modules' => [
        'dumper' => [
            'class' => 'Guanguans\YiiVarDumper\Module',
            'host' => 'tcp://127.0.0.1:9916',
        ],
    ],
    'components' => [
    ],
];

return $config;
