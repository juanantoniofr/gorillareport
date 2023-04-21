<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
}