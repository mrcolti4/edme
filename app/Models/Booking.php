<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    protected $fillable = [
        'user_id',
        'course_id',
        'session_id',
        'status',
    ];
}
