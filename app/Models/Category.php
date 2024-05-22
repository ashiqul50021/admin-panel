<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'status'
    ];


    protected function image(): Attribute{
        return Attribute::make(
            get: function(string $value){
                if($value === "default.png"){
                    return asset("images/default.png");
                }
                return asset("storage/uploads/$value");
            }
        );
    }
}
