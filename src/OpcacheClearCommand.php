<?php

namespace Maximkou\LaravelOpcacheClear;

use Illuminate\Console\Command;

/**
 * Artisan command for cleaning opcache
 * Class OpcacheClearCommand
 * @package MicheleCurletta\LaravelOpcacheClear
 */
class OpcacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opcache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear OpCache';

    /**
     * @param Cleaner $cleaner
     */
    public function handle(Cleaner $cleaner)
    {
        $this->info(
            $cleaner->sendClearRequest() ? 'Opcache successful cleared.' : 'Error on cleaning opcache.'
        );
    }
}
