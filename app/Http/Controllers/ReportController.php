<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;


use App\Models\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $reports = Report::sortable(['updated_at' => 'desc'])
                ->where('clients.name', 'like', '%'.$filter.'%')
                ->paginate(10);
        } else {
            $reports = Report::sortable(['updated_at' => 'desc'])
                ->paginate(10);
        }
        
        return view('reports.index')->with('reports', $reports)->with('filter', $filter);
    }

    public function get_lastEvents(Request $request)
    {
        //paginación
        // Obtemos el número de elementos que quieres mostrar por página
        $perPage = 10;
        
        
        // Obtemos el número de página actual
        $page = request()->input('page', 1);

        // Calcular el desplazamiento
        $offset = ($page - 1) * $perPage;
        
        //get reports, order by updated_at
        $reports = Report::sortable(['updated_at' => 'desc'])
            ->offset($offset)
            ->limit($perPage)
            ->get();    
        //$reports = Report::all();

        //init  last_events array
        $last_events = array();

        // Obtener instalaciones failed
        foreach ($reports as $report) {
            
            $managed_install = json_decode($report->managed_install); 
            
            //Get Hash errors task
            $hash_errors = array(); 
            $hash_failed = array();
            foreach ($managed_install as $install) {
                $installing_ps1_block = $install->installing_ps1_block;
                // Obtener hash_error si está definido
                if (isset($installing_ps1_block->hash_error)) {
                    $hash_error = $installing_ps1_block->hash_error; 
                    // Si hash_error no es vacio, agregar los resultados al array $hash_errors
                    if (!empty($hash_error)) {
                     
                        //search File hash does not match
                        foreach ($hash_error as $str) {
                            if (strpos($str, "File hash does not match") !== false) {
                                $hash_failed[] = $report->client->name . ": " .$str;
                            }
                        }
                    }
                }
            }
            
            if (count($hash_failed) > 0) {
                $hash_errors[$report->client->id][$install->task_name] = $hash_failed;
            }
                    
            if (!empty($hash_errors)) {
                $last_events[$report->client->id]['hash_errors'] = $hash_errors;
            }

            // Get failed tasks
            $task_failed = array();
            $failed = array(); 
            $task_successful = 0;
            foreach ($managed_install as $install) {
                $installing_ps1_block = $install->installing_ps1_block;
                if (isset($installing_ps1_block->command_output)) {
                    $command_output = $installing_ps1_block->command_output;
                    // Buscar la cadena "FAILED" y agregar los resultados al array $failed
                    foreach ($command_output as $str) {
                        if (strpos($str, "FAILED") !== false) {
                            $failed[] = $report->client->name .": " . $str;
                        }
                    }
                    // Buscar la cadena "SUCCESSFUL" y agregar los resultados al array $succeeded
                    foreach ($command_output as $str) {
                        if (strpos($str, "SUCCESSFUL") !== false) {
                            $task_successful++;
                            }
                        }
                    
                }
            }
            
            if (count($failed) > 0) {
                $task_failed[$report->client->id][$install->task_name] = $failed;
            }

            //Si $managed_installs_failed es mayor a 0, entonces el cliente tiene instalaciones fallidas
            if (count($task_failed) > 0) {
                $last_events[$report->client->id]['managed_install_failed'] = $task_failed;
            }

            if ( $task_successful > 0) {
                $last_events[$report->client->id]['managed_install_successful'] =  $task_successful . " tasks successful in " . $report->client->name . "  at " . $report->updated_at->format('d-m-Y H:i:s') ;
            }



        }


        //paginación
        // Obtener una porción de $last_events que contiene los elementos de la página actual
        $slice = array_slice($last_events, $offset, $perPage);
        // Crear una instancia de LengthAwarePaginator
        $paginator = new LengthAwarePaginator($slice, count($last_events), $perPage, $page);
        // Agregar cualquier parámetro de consulta a la URL de la página
        $paginator->appends(request()->query());

        return $paginator;

    }

}