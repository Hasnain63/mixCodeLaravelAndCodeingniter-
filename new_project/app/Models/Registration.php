<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Registration extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'std_1_name',
        'std_2_name',
        'std_1_roll_no',
        'std_2_roll_no',
        'std_1_email',
        'std_2_email',
        'std_1_session',
        'std_2_session',
        'department_id',
        'is_registered',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
