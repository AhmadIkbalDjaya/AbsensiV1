<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function shift () {
        return $this->belongsTo(Shift::class);
    }

    public function cuty () {
        return $this->hasOne(Cuty::class);
    }

}
