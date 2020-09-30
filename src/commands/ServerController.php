<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiVarDumper\commands;

use InvalidArgumentException;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Server\DumpServer;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Manages application Server.
 */
class ServerController extends Controller
{
    /**
     * @var string controller default action ID
     */
    public $defaultAction = 'run';

    protected $argvInput;

    protected $consoleOutput;

    public $format = 'cli';

    public function init()
    {
        parent::init();

        $this->argvInput = new ArgvInput();
        $this->consoleOutput = new ConsoleOutput();
    }

    /**
     * Runs guanguans/yii-var-dumper server.
     *
     * @return int
     */
    public function actionRun()
    {
        if (!in_array($this->format, ['cli', 'html'])) {
            throw new InvalidArgumentException(sprintf('Unsupported format "%s".', $this->format));
        }

        $io = new SymfonyStyle($this->argvInput, $this->consoleOutput);
        $errorIo = $io->getErrorStyle();
        $errorIo->title('Yii Var Dump Server');

        $server = new DumpServer(Yii::$app->controller->module->host);
        $server->start();
        $errorIo->success(sprintf('Server listening on %s', $server->getHost()));
        $errorIo->comment('Quit the server with CONTROL-C.');

        $descriptorName = sprintf('\Symfony\Component\VarDumper\Command\Descriptor\%sDescriptor', $this->format);
        $dumperName = sprintf('\Symfony\Component\VarDumper\Dumper\%sDumper', $this->format);
        $descriptor = new $descriptorName(new $dumperName());

        $server->listen(function (Data $data, array $context, int $clientId) use ($descriptor, $io) {
            $descriptor->describe($io, $data, $context, $clientId);
        });

        return ExitCode::OK;
    }

    /**
     * @param string $actionID
     *
     * @return array|string[]
     */
    public function options($actionID)
    {
        return array_merge(parent::options($actionID), [
            'format',
        ]);
    }

    /**
     * @return array|string[]
     *
     * @since 2.0.8
     */
    public function optionAliases()
    {
        return array_merge(parent::optionAliases(), [
            'f' => 'format',
        ]);
    }
}
