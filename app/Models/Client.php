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
        'name','ip', 'information'
    ];
    
    public $sortable = ['name', 'ip', 'updated_at'];
    
}
