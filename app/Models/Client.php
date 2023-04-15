<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

####
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory;
    

    ####
    use Sortable;
    
    protected $fillable = [
        'huid', 'name','ip', 'information', 'report'
    ];
    
    public $sortable = ['name', 'ip', 'updated_at'];
    
}
