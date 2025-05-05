<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
class CleanTmpTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina registros temporales con más de 7 min de inactividad';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    }
}
