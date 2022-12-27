<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\vendors;
class assets extends Model
{
    use HasFactory;
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'serial_number', 'location', 'category', 'budget', 'vendor_id', 'user_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(vendors::class, 'foreign_key');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'foreign_key');
    }
}
