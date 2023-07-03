<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

    public function capacity()
    {
        return $this->belongsTo(Capacity::class,'capacity_id');
    }
}
