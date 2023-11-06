<?php

namespace App\Imports;

use App\Models\CitasPac;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; 
use GuzzleHttp\Client;
use Carbon\Carbon;

class PacientesImport implements ToModel,WithStartRow
{

    /**
     * Indica desde qué fila debe comenzar la importación (segunda fila en este caso).
     *
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = Auth::id();


        $excelDateAuth = $row[4];
        $excelBaseDate = Carbon::create(1900, 1, 1);
        $excelDate = $excelBaseDate->addDays($excelDateAuth - 2); // Restamos 2 porque Excel cuenta desde el 1 de enero de 1900
        $formattedDateAuth = $excelDate->format('Y-m-d');



        //Validacion Paciente Afiliado
        $auth_token = $this->autenticate();
        $token = $auth_token["token"];

        $type_doc = $row[0];
        $document = $row[1];

        $header_api = 'patient?id='.$type_doc.'&identifier='.$document.'&_format=json&afilia=true';

        $api_agenda = new Client([
            'base_uri' => 'http://172.18.223.198:2082/scheduler/api/'
        ]);

        $request = $api_agenda->request('GET', $header_api, 
                                    ['headers' => [
                                        'Authorization' => 'Bearer '.$token
                                    ]]);           

         // Obtiene el cuerpo de la respuesta como JSON
        $schedule_data = json_decode($request->getBody()->getContents(),true);       
        
        if(!isset($schedule_data['total'])){

            return new CitasPac([
                'type_doc'          => $type_doc,
                'document'          => $document,
                'full_name'         => $row[2],
                'organization'      => $row[3],
                'date_authorization' => $formattedDateAuth,
                'speciality_id'     => $row[5],
                'id_user_upload'    => $user,
                'status'            => 3,
                'afilia_status'     => 4,
                'cups'              => $row[6],
                'concept'           => $row[7],
            ]);

        }else{
            
            return new CitasPac([
                'type_doc'          => $row[0],
                'document'          => $row[1],
                'full_name'         => $row[2],
                'organization'      => $row[3],
                'date_authorization' => $formattedDateAuth,
                'speciality_id'     => $row[5],
                'id_user_upload'    => $user,
                'status'            => 2,
                'afilia_status'     => 5,
                'cups'              => $row[6],
                'concept'           => $row[7],
            ]);

        }

        
    }


    public function autenticate() : Response
    {
        $url = config('services.agen.url');
        $response = Http::post($url, [
            "user" => config('services.agen.user'),
            "code" => config('services.agen.pass'),
                        
        ]);

        $token = $response['token'];
        //print_r($token);
        return $response;

    }
}
