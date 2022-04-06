<?php

namespace App\Console\Commands;

use App\Jobs\ProcessRequest;
use Illuminate\Console\Command;

class PostInterview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:post {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making a simple POST request to https://atomic.incfile.com/fakepost';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->argument('count');

        try {
            for ($i = 1; $i <= $count; $i++) {
                // Al crear la peticion dentro de un job, nos permite realizar un retry 
                // para intentar una o más veces el post, con esto se garantiza una mayor
                // probabilidad de que se ejecute de manera exitosa.
                ProcessRequest::dispatch();
                $this->info("Processing {$i} of {$count} requests to queue");
            }

            $this->info("All request are processed into the queue");
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
