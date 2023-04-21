<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;

class Event extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $fillable = [
        'successful', 'warning','error'
    ];
    
    public $sortable = ['successful', 'warning', 'error', 'updated_at'];
    
    
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    #https://github.com/Kyslik/column-sortable#blade-and-relation-sorting
    public function hostnameSortable($query, $direction)
    {
        return $query->join('reports', 'reports.id', '=', 'events.report_id')
                     ->join('clients', 'clients.id', '=', 'reports.client_id')
                     ->orderBy('name', $direction)
                     ->select('events.*');
    }
}