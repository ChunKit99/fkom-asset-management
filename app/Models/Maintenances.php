<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenances extends Model
{
    use HasFactory;
    protected $table = 'maintenances';
    protected $primaryKey = 'id';
    protected $fillable = ['serial_number', 'request_time', 'approve_time', 'status', 'cost'];
}
