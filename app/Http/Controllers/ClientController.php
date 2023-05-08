<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


use App\Models\Client;
use App\Models\Report;
use Carbon\Carbon;
use Config;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $clients = Client::sortable(['updated_at' => 'desc'])
                ->where('clients.name', 'like', '%'.$filter.'%')
                ->paginate(5);
        } else {
            $clients = Client::sortable(['updated_at' => 'desc'])
                ->paginate(5);
        }
        
        return view('clients.index')->with('clients', $clients)->with('filter', $filter);
    }
 
    public function show(Client $client)
    {
        return  view('clients.show')->with('client', $client);  
    }

    public function show_report(Client $client)
    {
        return  view('clients.show_report')->with('client', $client);  
    }

    
    public function register(Request $request)
    {
        
        #Obtenemos los datos del request
        $data = $request->all();
        $arrayData = json_decode($data['report'], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PARTIAL_OUTPUT_ON_ERROR|JSON_THROW_ON_ERROR, 512);
        
        $isAllowedIp = $this->isAllowedIp($arrayData['ip']);

        if (!$isAllowedIp) {
            Log::error('ClientController@register: Ip fuera de rango permitido');
            return response()->json(['message' => 'ClientController@register: Ip fuera de rango permitido'], 400);
        }

        try{
            
            $client = Client::updateOrCreate(

                ['huid' =>  $arrayData['huid']],
        
                ['ip' =>  $arrayData['ip'], 'name' => $arrayData['name']]
        
            );

        
        }catch(\Exception $e){
            Log::error('ClientController@register error al registrar cliente: ' . $e->getMessage());
            return response()->json(['message' => 'ClientController@register: Error al registrar cliente'], 400);
        }

        Log::info('ClientController@register: Cliente ' . $arrayData['ip'] . '  registrado exitosamente');
        return response()->json(['message' => 'ClientController@register: Cliente registrado exitosamente'], 200);
        
    }

    /*
    Actualizamds el campo information del modelo client los valores recibidos en el request
    */
    public function updateBasicInformation(Request $request)
    {
        try{
            #Obtenemos los datos del request
            $data = $request->all();
            #Buscamos el cliente por su huid
            $client = Client::where('huid', $data['huid'])->firstOrFail();
            #Actualizamos el campo information
            $client->update
            (
                [
                    'information' => $data['report']
                ]
            );
        }catch(\Exception $e){
            Log::error('ClientController@updateBasicInformation: error al actualizar información básica:' . $e->getMessage());
            return response()->json(['message' => 'ClientController@updateBasicInformation: Error al actualizar información básica: ' . $e->getMessage()]);
        }
        
        Log::info('ClientController@updateBasicInformation: Información básica actualizada exitosamente' . $client->name);
        return response()->json(['message' => 'ClientController@updateBasicInformation: Información actualizada exitosamente'], 200);
    }

    /* actualizamos el campo report del modelo client con los valores recibidos en el request */
    public function updateReport(Request $request)
    {
        try {
            // Obtener los datos del request
            $data = $request->all();
        
            // Buscar el cliente por su huid
            $client = Client::where('huid', $data['huid'])->firstOrFail();
        
            
            // Obtener sección managed_installs
            $managed_install = '{}';
            try {
                //Log::info('ClientController@updateReport content $data[\'report\'] : ' . $data['report']);
                $managed_installs = $this->getContentReport(json_decode($data['report'], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PARTIAL_OUTPUT_ON_ERROR|JSON_THROW_ON_ERROR, 512), 'managed_installs');
            }
            catch(\Exception $e){
                Log::error('ClientController@updateReport: Error al obtener managed_install');
                // Retornar una respuesta de error
                return response()->json(['message' => 'ClientController@updateReport: Error al obtener managed_install']);
            }

            // Actualizar report
            $report_data = ['managed_install' => json_encode($managed_installs), 'managed_uninstall' => '{}', 'managed_update' => '{}'];
            $client->report()->updateOrCreate(
                ['client_id' => $client->id],
                $report_data
            );
            
            //***************/
            // Generar evento a partir del reporte
            //***************/

            // Obtener número de instalaciones successfull
            $managed_installs_successfull = 0;
            $managed_installs_failed = 0;
            $managed_installs_warning = 0;

            foreach ($managed_installs as $install) {

                $is_successful = false;
                $is_failed = false;
                
                //check_block
                $check_block = $install['check_block'];
                if ( isset($check_block['script']) ){
                    $script = $check_block['script'];
                    $stderr = $script['stderr'];
                    //Log::error('ClientController@updateReport: $stderr count: ' . count(array_filter($stderr, function($value) {return trim($value) != "";})));
                
                    if (count(array_filter($stderr, function($value) {return trim($value) != "";})) > 0){
                        //$managed_installs_failed = $managed_installs_failed + 1;
                        $is_failed = true;
                    }
                }

                //installing_ps1_block
                $installing_ps1_block = $install['installing_ps1_block'];
                //Log::error('ClientController@updateReport: $installing_ps1_block: ' . count($installing_ps1_block));
                if (isset( $installing_ps1_block['command_output'])) {
                    
                    $command_output = $installing_ps1_block['command_output'];
                    //Log::error('ClientController@updateReport: $command_output: ' . count($command_output));    
                    
                    // Buscar la cadena "SUCCESSFUL"
                    if (count(array_filter($command_output, function($str) {
                        return strpos($str, "SUCCESSFUL") !== false;
                    })) > 0){
                        //$managed_installs_successfull = $managed_installs_successfull + 1;
                        $is_successful = true;
                    }
                    /*$managed_installs_successfull = $managed_installs_successfull + count(array_filter($command_output, function($str) {
                        return strpos($str, "SUCCESSFUL") !== false;
                    }));*/
                    // Buscar la cadena "FAILED"
                    if (count(array_filter($command_output, function($str) {
                        return strpos($str, "FAILED") !== false;
                    })) > 0){
                        //$managed_installs_failed = $managed_installs_failed + 1;
                        $is_failed = true;
                    }
                    /*$managed_installs_failed = $managed_installs_failed + count(array_filter($command_output, function($str) {
                        return strpos($str, "FAILED") !== false;
                    }));*/

                    if ($is_successful && $is_failed){
                        $managed_installs_warning = $managed_installs_warning + 1;
                    }
                    elseif ($is_successful && !$is_failed){
                        $managed_installs_successfull = $managed_installs_successfull + 1;
                    }
                    elseif (!$is_successful && $is_failed){
                        $managed_installs_failed = $managed_installs_failed + 1;
                    }
                }

                
                //Log::error('ClientController@updateReport: $managed_installs_successfull: ' . $managed_installs_successfull);
            }
            
            
            // Actualizar evento
            $client->report->event()->updateOrCreate(
                ['report_id' => $client->report->id],
                [
                    'successful' => $managed_installs_successfull,
                    'error' => $managed_installs_failed,
                    'warning' => $managed_installs_warning,
                ]
            );
            

            // Actualizar client
            // Sección global_info
            try{
                $global_info = $this->getContentReport(json_decode($data['report'], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PARTIAL_OUTPUT_ON_ERROR|JSON_THROW_ON_ERROR, 512), 'global_info');
            }
            catch(\Exception $e){
                Log::error('ClientController@updateReport: Error al obtener global_info');
                // Retornar una respuesta de error
                return response()->json(['message' => 'ClientController@updateReport: Error al obtener global_info']);
            }
            Log::info('ClientController@updateReport: $global_info actualizada ' . $client->name);
            
            $client->update(
                    [
                        'gorilla_global_info' => json_encode($global_info),
                    ]
                );
            
            // Si todo salió bien, retornar una respuesta exitosa
            return response()->json(['message' => 'ClientController@updateReport: Reporte creado exitosamente']);
        }
        catch (\Exception $e) {
            // Si hubo un error, registrar el error en el log de Laravel
            Log::error($e->getMessage());
            // Retornar una respuesta de error
            return response()->json(['message' => 'ClientController@updateReport error ' .$e->getMessage()]);
        }
    }
    
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return response()->json($client, 200);
    }

    public function delete(Client $client)
    {
        $client->delete();

        return response()->json(null, 204);
    }


    private function getContentReport($report, String $section){
        try{
            $content = $report[$section];
        }
        catch (\Exception $e){
            Log::error('ClientController@getContentReport: Error al obtener el contenido de la sección ' . $section);
            Log::error('ClientController@getContentReport: ' . $e->getMessage());
        }
        
        return $content;
    }



    private function isAllowedIp(String $ip_address)
    {
        
        
        $ip = str_replace('"', '', $ip_address);
        Log::info('ClientController@isAllowedIp: debug -> $ip: ' . $ip);
        $ipRanges = Config::get('gorillareport.allowed_ip_ranges');
        $allowed = false;

        Log::info($ipRanges);
        foreach ($ipRanges as $range) {
            $start = ip2long($range['start']);
            $end = ip2long($range['end']);
            $ipLong = ip2long($ip);

            if ($ipLong >= $start && $ipLong <= $end) {
                $allowed = true;
                break;
            }
        }
       
        return $allowed;
    }

}