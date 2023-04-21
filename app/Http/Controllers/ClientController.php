<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


use App\Models\Client;
use App\Models\Report;
use Carbon\Carbon;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $clients = Client::sortable(['updated_at' => 'desc'])
                ->where('clients.name', 'like', '%'.$filter.'%')
                ->paginate(10);
        } else {
            $clients = Client::sortable(['updated_at' => 'desc'])
                ->paginate(10);
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
        try{
            
            $client = Client::updateOrCreate(

                ['huid' =>  request('huid')],
        
                ['ip' =>  request('ip'), 'name' => request('name')]
        
            );

        }catch(\Exception $e){
            Log::error('ClientController@register error al registrar cliente: ' . $e->getMessage());
            return response()->json(['message' => 'ClientController@register: Error al registrar cliente'], 400);
        }

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
            $client = Client::where('huid', $data['huid'])->first();
            #Actualizamos el campo information
            $client->update
            (
                [
                    'information' => $data['information']
                ]
            );
            
        }catch(\Exception $e){
            Log::error('ClientController@updateBasicInformation: error al actualizar información básica:' . $e->getMessage());
            return response()->json(['message' => 'ClientController@updateBasicInformation: Error al actualizar información'], 400);
        }
        
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
                Log::error('ClientController@updateReport content $data[\'report\'] : ' . $data['report']);
                $managed_installs = $this->getContentReport(json_decode($data['report'], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PARTIAL_OUTPUT_ON_ERROR|JSON_THROW_ON_ERROR, 512), 'managed_installs');
            }
            catch(\Exception $e){
                Log::error('ClientController@updateReport: Error al obtener managed_install');
                // Retornar una respuesta de error
                return response()->json(['message' => 'ClientController@updateReport: Error al obtener managed_install']);
            }

            // Actualizar report
            $report_data = ['managed_install' => json_encode($managed_installs), 'managed_uninstall' => '{}', 'managed_update' => '{}'];
            $client->report()->updateOrCreate($report_data);
            
            //***************/
            // Generar evento a partir del reporte
            //***************/

            // Obtener número de instalaciones successfull
            foreach ($managed_installs as $install) {
                if (isset($install->installing_ps1_block->command_output)) {
                    $command_output = $install->installing_ps1_block->command_output;
                    // hacer algo con $command_output, como buscar la cadena "SUCCESSFUL"
                    $managed_installs_successfull = count(array_filter($command_output, function($str) {
                        return strpos($str, "SUCCESSFUL") !== false;
                    }));
                }
            }
            
            
            


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

            $client->update
            (
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
}