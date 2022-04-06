<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Al crear la peticion dentro de un job, nos permite realizar un retry 
        // para intentar una o más veces el post, con esto se garantiza una mayor
        // probabilidad de que se ejecute de manera exitosa.
        $response = Http::post('https://atomic.incfile.com/fakepost');


        // Al utilizar la función onError garantizamos que la petición que haya fallado
        // se guarde en la tabla de failed_jobs, con esto podemos repetir dicho request fallido
        // y saber el motivo del fallo
        $response->onError(function () use ($response) {
            $this->fail();
            Log::error($response->body());
        });
    }
}
