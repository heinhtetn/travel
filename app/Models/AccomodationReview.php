<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomodationReview extends Model
{
    use HasFactory;

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }
}
