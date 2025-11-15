<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysLog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type', 'data'];
    protected $table = 'sys_logs';
}
