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
                ->paginate(5);
        } else {
            $reports = Report::sortable(['updated_at' => 'desc'])
                ->paginate(5);
        }
        
        return view('reports.index')->with('reports', $reports)->with('filter', $filter);
    }

    
    public function getSummaryTask(Request $request){
        // Obtemos el número de elementos que quieres mostrar por página
        $perPage = 10;

        // Obtemos el número de página actual
        $page = request()->input('page', 1);

        // Calcular el desplazamiento
        $offset = ($page - 1) * $perPage;

        // Cargar informes y clientes asociados
        $reports = Report::with('client')
            ->sortable(['updated_at' => 'desc'])
            ->get();

        // Inicializar array de eventos
        $last_events = [];

        foreach ($reports as $report) {
            $managed_install = json_decode($report->managed_install); 
            
            $hash_errors = [];
            $download_errors = [];
            $task_failed = [];
            $task_successful = 0;
            
            foreach ($managed_install as $install) {
                $installing_ps1_block = $install->installing_ps1_block ?? null;
                $command_output = $installing_ps1_block->command_output ?? null;
                $hash_error = $installing_ps1_block->hash_error ?? null;
                $download_error = $installing_ps1_block->download_error ?? null;
                
                if ($hash_error) {
                    foreach ($hash_error as $str) {
                        if (strpos($str, "File hash does not match") !== false) {
                            $hash_errors[] = [ $report->client->name . " reports at ". $report->updated_at->format('d-m-Y H:i:s') . ": " .$str , "id" => $report->client->id ];
                        }
                    }
                }
                
                if ($download_error) {
                    foreach ($download_error as $str) {
                        if (strpos($str, "download") !== false) {
                            $download_errors[] = [ $report->client->name . " reports at ". $report->updated_at->format('d-m-Y H:i:s') . ": " . $str,  "id" => $report->client->id ];
                        }
                    }
                }
                
                if ($command_output) {
                    foreach ($command_output as $str) {
                        if (strpos($str, "FAILED") !== false) {
                            $task_failed[] = [ $report->client->name . " reports at ". $report->updated_at->format('d-m-Y H:i:s') . ": " . $str, "id" => $report->client->id ];
                        } elseif (strpos($str, "SUCCESSFUL") !== false) {
                            $task_successful++;
                            $str_successfull = $str;
                        }
                    }
                }
            }
            
            if (!empty($hash_errors)) {
                $last_events = $hash_errors;
            }
            
            if (!empty($download_errors)) {
                $last_events = array_merge($last_events, $download_errors);
            }
            
            if (!empty($task_failed)) {
                $last_events = array_merge($last_events,$task_failed);
            }
            
            // Si task_successfull es 1, guardamos la cadena $str_successfull en $last_events, si es mayor que 1, generamos custom message, por defecto, no hacemos nada
            switch($task_successful){
                case 1:
                    $last_events = array_merge($last_events, $str_successfull);
                    break;
                case ($task_successful > 1):
                    $last_events[] =  [ $report->client->name . " reports at ". $report->updated_at->format('d-m-Y H:i:s') . ": " . $task_successful . " tasks successful", "id" => $report->client->id ];
                    break;
                default:
                    break;
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