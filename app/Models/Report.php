<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kyslik\ColumnSortable\Sortable;

class Report extends Model
{
    use HasFactory;
    use Sortable;


    protected $fillable = [
        'managed_install',
        'managed_uninstall',
        'managed_update'
    ];

    public $sortable = ['managed_install', 'managed_uninstall', 'managed_update', 'updated_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function event()
    {
        return $this->hasOne(Event::class);
    }



}
