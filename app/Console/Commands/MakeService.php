<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $serviceName = $this->argument('name');
        $servicePath = app_path('Services/' . $serviceName . '.php');

        $stub = file_get_contents(__DIR__ . '/stubs/Service.stub');
        $stub = str_replace('{{serviceName}}', $serviceName, $stub);

        file_put_contents($servicePath, $stub);

        $this->info($serviceName . ' service created successfully.');
    }
}
