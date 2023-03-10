<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Budget extends Model
{
    use HasFactory;
    protected $table = 'budget';
    protected $primaryKey = 'id';
    protected $fillable = ['serial_number', 'status'];

}
