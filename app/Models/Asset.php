<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;

class Asset extends Model
{
    use HasFactory;
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'serial_number', 'location_id', 'category', 'budget', 'vendor_id', 'user_id', 'image_path'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
