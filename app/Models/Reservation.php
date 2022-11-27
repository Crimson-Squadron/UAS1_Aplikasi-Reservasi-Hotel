<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['reservation_code','guest_name','phone_number','hotel_name','room_type','starts_on','ends_on','total'];
}
