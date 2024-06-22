<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

     /**
	 * Menentukan hubungan dengan produk
	 *
	 * @return void
	 */
	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
