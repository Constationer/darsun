<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    use HasFactory;

    public $fillable = ['nama', 'tahun_ajaran', "current_semaster", "gender", "musyrif_id"];
}
