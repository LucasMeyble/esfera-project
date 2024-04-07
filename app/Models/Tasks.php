<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    protected $table = "tasks";
    protected $primaryKry = "id";
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'descricao',
        'user_id',
        'email',
        'status_id'
    ];
}
