<?php
declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';

use App\DIConfig;
use App\Process;
use App\Reporter\Reporter;

$builder = new DI\ContainerBuilder();
$config = new DIConfig();
$builder->addDefinitions($config->getConfig());


while (true) {
    /** @noinspection PhpUnhandledExceptionInspection */
    $container = $builder->build();

    try {
        $process = $container->get(Process::class);
        $process->run();
        // if we stop process correctly we don't run process more
        break;
    } catch (Throwable $e) {
        $reporter = $container->get(Reporter::class);
        $reporter->reportAlert("Error: --message {$e->getMessage()} --code {$e->getCode()} --trace {$e->getTraceAsString()}");
    }

    sleep(1);
}
