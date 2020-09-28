<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiVarDumper;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\Server\Connection;

/**
 * This file is modified from `beyondcode/laravel-dump-server`.
 *
 * @see https://github.com/beyondcode/laravel-dump-server
 */
class Dumper
{
    /**
     * The connection.
     *
     * @var \Symfony\Component\VarDumper\Server\Connection|null
     */
    private $connection;

    /**
     * Dumper constructor.
     */
    public function __construct(Connection $connection = null)
    {
        $this->connection = $connection;
    }

    /**
     * Dump a value with elegance.
     *
     * @param $value
     */
    public function dump($value)
    {
        if (class_exists(CliDumper::class)) {
            $data = (new VarCloner())->cloneVar($value);
            if (null === $this->connection || false === $this->connection->write($data)) {
                $dumper = in_array(PHP_SAPI, ['cli', 'phpdbg']) ? new CliDumper() : new HtmlDumper();

                $dumper->dump($data);
            }
        } else {
            var_dump($value);
        }
    }
}
