<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function monitoring(){
        return $this->hasMany(monitoring::class, 'hardware_id', 'id_ori');
    }
}
