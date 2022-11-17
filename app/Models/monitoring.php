<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitoring extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function hardware(){
        return $this->hasOne(Hardware::class, 'id_ori', 'hardware_id');
    }
}
