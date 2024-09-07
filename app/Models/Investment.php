<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Investment extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'liablity', 'cost'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $date = explode('-', Carbon::parse($value)->format('Y-m-d'));
        return $date[0].$date[1];
    }
}
