<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pedido;
use App\Services\HistorialEstadoService;

class PopularHistorialEstados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pedidos:popular-historial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popula el historial de estados para pedidos existentes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando población del historial de estados...');
        
        // Obtener todos los pedidos que no tienen historial
        $pedidos = Pedido::whereDoesntHave('historialEstados')->get();
        
        $this->info('Encontrados ' . $pedidos->count() . ' pedidos sin historial.');
        
        $bar = $this->output->createProgressBar($pedidos->count());
        $bar->start();
        
        foreach ($pedidos as $pedido) {
            // Crear registro del estado actual usando la fecha de creación del pedido
            HistorialEstadoService::registrarCambioEstado(
                $pedido->id, 
                $pedido->estado, 
                $pedido->id_usuario // Usuario que creó el pedido
            );
            
            // Actualizar la fecha de creación del registro del historial
            // para que coincida con la fecha de creación del pedido
            $ultimoRegistro = $pedido->historialEstados()->latest()->first();
            if ($ultimoRegistro) {
                $ultimoRegistro->update([
                    'created_at' => $pedido->created_at,
                    'updated_at' => $pedido->created_at
                ]);
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('Población del historial completada exitosamente.');
        
        return Command::SUCCESS;
    }
}
