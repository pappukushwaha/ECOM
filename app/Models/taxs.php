<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taxs extends Model
{
    use HasFactory;
    protected $table = 'taxs';
    protected $primarykey = 'id';
}
