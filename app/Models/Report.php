<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'managed_install',
        'managed_uninstall',
        'managed_update'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    

}
