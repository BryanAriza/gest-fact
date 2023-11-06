<?php

namespace App\Jobs;

use App\Models\citasPac;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportarDatosJob implements ShouldQueue
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
        Excel::filter('chunk')->load($this->archivo->getRealPath())->chunk(250, function($results) {
            foreach($results as $row) {
                
                citasPac::create([
                    'type_doc' => $row->tipodocumento,
                    'document' => $row->nrodocumento,
                    'full_name' => $row->nombrecompleto,
                    'organization' => $row->organizacion,
                    'date_authorization' => $row->fechaautorizacion
                ]);
            }
        });
    }
}
