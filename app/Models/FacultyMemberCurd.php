<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyMemberCurd extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = ['name','username', 'contact', 'position','department','location'];
}
