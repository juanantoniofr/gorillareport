<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


use App\Models\Client;
use App\Models\Event;
use App\Models\Report;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Http\Controllers\ReportController;

use stdClass;


class ListingController extends Controller
{

    public function tasks(Request $request)
    {
        //Get reports with clients
        $reports = Report::with('client')
            ->sortable(['updated_at' => 'desc'])
            ->get();
        
        //para cada report 
        $list_tasks = new Collection();   
        foreach($reports as $report){

            //Obtenemos managed_install
            $managed_install = json_decode($report->managed_install);
            //intialize variables
            $task_failed = 0;
            $task_successful = 0;
            $task_name = '';
            //para cada tarea en managed_install
            foreach($managed_install as $install){
                  
                //obtemos installing_ps1_block
                $installing_ps1_block = $install->installing_ps1_block ?? null;

                //si istalling_ps1_block no es null
                if(null != $installing_ps1_block){
                    //obtenemos el nombre de la tarea
                    $task_name = $install-> task_name ?? null;
                    //obtenemos command_output
                    $command_output = $installing_ps1_block->command_output ?? null;
                    
                    //si command_output no es null
                    if(null != $command_output){
                            
                        //para cada linea de command_output
                        foreach($command_output as $line){
                            if (strpos($line, "FAILED") !== false) {
                                $task_failed = $task_failed + 1;
                                break;
                            } elseif (strpos($line, "SUCCESSFUL") !== false) {
                                $task_successful = $task_successful + 1;
                                break;                                    
                            }
                        }
                        
                        // Buscar la tarea por el nombre en la colección
                        $existingTask = $list_tasks->firstWhere('task_name', $task_name);

                        // Si no se encuentra la tarea, se crea un nuevo objeto de tarea y se agrega a la colección
                        if (!$existingTask) {
                            $newTask = new stdClass();
                            $newTask->task_name = $task_name;
                            $newTask->task_failed = $task_failed;
                            $newTask->task_successful = $task_successful;
                            //$newTask->client_name = $report->client->name;
                            //$newTask->client_id = $report->client->id;
                            $list_tasks->push($newTask);
                        }
                        else{
                            $existingTask->task_failed = $existingTask->task_failed + $task_failed;
                            $existingTask->task_successful = $existingTask->task_successful + $task_successful;
                        }

                    }
                } //END if(null != $installing_ps1_block)
            } //END foreach($managed_install as $install)
        } //END foreach($reports as $report)

     
        return view('list.tasks')->with('list_tasks', $list_tasks);
    }

    public function hardware(Request $request)
    {
        return view('list.hardware');
    }

    public function SystemEvents(Request $request)
    {
        return view('list.SystemEvents');
    }
}