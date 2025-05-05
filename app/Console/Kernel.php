<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define el schedule de comandos de tu aplicación.
     */
    protected function schedule(Schedule $schedule)
    {
        // Aquí programarás la ejecución de tu comando

    }

    /**
     * Registra los comandos para la aplicación.
     */
    protected function commands()
    {
        // Carga todos los comandos de la carpeta 'Commands'
        $this->load(__DIR__.'/Commands');

        // Si quieres usar el archivo routes/console.php para definir comandos
        // require base_path('routes/console.php');
    }
}
