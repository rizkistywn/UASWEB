<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// mendefinisikan kelas Shipment
class Shipment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public const PENDING = 'pending';
	public const SHIPPED = 'shipped';

    /**
	 * Hubungan antara suatu model dengan model "order" 
	 *
	 * @return void
	 */
	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
