<?php
declare(strict_types=1);

namespace App;

use App\Impl\Reporter\DefaultReporter;
use App\Impl\Request\FileHandler;
use App\Impl\Request\GenLead;
use App\Impl\Storage\FileStorage;
use App\Reporter\Reporter;
use App\Request\Handler;
use App\Request\Lead;
use App\Storage\Storage;
use LeadGenerator\Generator;
use Psr\Container\ContainerInterface;
use function DI\autowire;
use function DI\get;

/**
 * @package App
 */
class DIConfig
{
    private const LEAD_GENERATOR = 'lead.generator';

    /** @noinspection PhpUnusedParameterInspection */
    public function getConfig(): array
    {
        return array(

            Reporter::class => static function (ContainerInterface $c) {
                return new DefaultReporter();
            },
            Handler::class => autowire(FileHandler::class),

            Lead::class => autowire(GenLead::class),

            Storage::class => autowire(FileStorage::class)
                ->constructorParameter('fileDir', HANDLER_FILE_NAME),

            self::LEAD_GENERATOR => static function(ContainerInterface $c) {
                return new Generator();
            },

            Process::class => autowire()
                ->constructorParameter('generator', get(self::LEAD_GENERATOR))
                ->constructorParameter('leadCount', LEAD_GENERATE_COUNT),
        );
    }
}
