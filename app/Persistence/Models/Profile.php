<?php

namespace App\Persistence\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Profile extends Model
{
    use HasFactory;
    protected $guarded = null;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getGenderTitleAttribute() : string
    {
        if ($this->gender === 1){
            return 'Male';
        }
        if ($this->gender === 2){
            return 'Female';
        }
        return 'Unknown';
    }
}
