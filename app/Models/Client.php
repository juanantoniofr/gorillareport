<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

####
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory;
    

    ####
    use Sortable;
    
    protected $fillable = [
        'huid', 'name','ip', 'information'
    ];
    
    public $sortable = ['name', 'ip', 'updated_at'];
    
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
