<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class RefreshDatabase extends Command
{
    protected $signature = 'db:refresh';
    protected $description = 'Reinicia la base de datos, ejecuta todas las migraciones y ejecuta los seeders';

    public function handle()
    {
        $this->info('Reiniciando la base de datos...');

        Schema::disableForeignKeyConstraints();
        Artisan::call('migrate:reset', ['--force' => true]);
        Schema::enableForeignKeyConstraints();

        Artisan::call('migrate', ['--force' => true]);

        $this->info('Ejecutando seeders...');
        Artisan::call('db:seed', ['--force' => true]);

        $this->info('La base de datos ha sido reiniciada, las migraciones y los seeders han sido ejecutados.');
    }
}
