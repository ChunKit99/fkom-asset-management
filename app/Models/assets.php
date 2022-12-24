<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('App\Models\Vendor');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
