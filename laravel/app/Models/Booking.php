<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['product_id', 'size', 'date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getBookedDates()
    {
        return $this->bookings()->pluck('start_datetime', 'end_datetime')->toArray();
    }
}