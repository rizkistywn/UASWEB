<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

     /**
     * Hubungan antara suatu model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
