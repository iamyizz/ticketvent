<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket'; // Nama tabel secara eksplisit

    protected $fillable = [
        'event_id', 'type', 'price', 'quantity'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'ticket_id');
    }
}
