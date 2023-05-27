<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');
        $stub = File::get(app_path('Console/Commands/stubs/Service.stub'));

        $stub = str_replace('{{serviceName}}', $name, $stub);

        $file = app_path('Services/' . $name . '.php');

        if (File::exists($file)) {
            $this->error('Service already exists!');
            return;
        }

        File::put($file, $stub);

        $this->info('Service created successfully.');
    }
}
