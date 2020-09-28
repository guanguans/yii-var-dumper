<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

/*
 * This file is modified from `baijunyao/laravel-print`.
 * @see https://github.com/baijunyao/laravel-print
 */

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\VarDumper;
use yii\console\Application;

if (!function_exists('p')) {
    // 传递数据以易于阅读的样式格式化后输出
    function p($data)
    {
        if (Yii::$app instanceof Application) {
            return dump($data);
        }

        VarDumper::setHandler(function ($var) {
            $cloner = new VarCloner();
            $dumper = new HtmlDumper();
            $hint = '';

            $dumper->setStyles([
                'default' => 'background-color:#18171B; color:#FF8400; line-height:1.2em; font-size:14px; font-family:Microsoft Yahei; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:9999; word-break: break-all',
                'num' => 'font-weight:bold; color:#1299DA',
                'const' => 'font-weight:bold',
                'str' => 'color:#56DB3A; font-family:Microsoft Yahei;',
                'note' => 'color:#1299DA; font-family:Microsoft Yahei;',
                'ref' => 'color:#A0A0A0',
                'public' => 'color:#FFFFFF',
                'protected' => 'color:#FFFFFF',
                'private' => 'color:#FFFFFF',
                'meta' => 'color:#B729D9',
                'key' => 'color:#56DB3A; font-family:Microsoft Yahei',
                'index' => 'color:#1299DA',
                'ellipsis' => 'color:#FF8400',
            ]);
            $dumper->setDisplayOptions([
                'maxDepth' => 3,
            ]);
            $dumper->setDumpBoundaries(
                $hint.'</pre><pre class=sf-dump id=%s data-indent-pad="%s">',
                '</pre><script>Sfdump(%s)</script>'
            );
            $dumper->dump($cloner->cloneVar($var));
        });
        // 设置 response 为 500 以处理 ajax 下无法预览结构的问题
        http_response_code(500);
        dump($data);
    }
}

if (!function_exists('pd')) {
    function pd($data)
    {
        p($data);
        exit;
    }
}
