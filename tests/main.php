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
    'bootstrap' => ['var-dumper'],
    'modules' => [
        'var-dumper' => [
            'class' => 'Guanguans\YiiVarDumper\Module',
        ],
    ],
    'components' => [
    ],
];

return $config;
