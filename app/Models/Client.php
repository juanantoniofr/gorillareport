<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $fillable = [
        'huid', 'name','ip', 'information', 'gorilla_global_info'
    ];
    
    public $sortable = ['name', 'ip', 'updated_at'];
    

    public function report()
    {
        return $this->hasOne(Report::class);
    }

    //ALTER TABLE clients MODIFY updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
}
