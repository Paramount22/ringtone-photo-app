<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ringtone extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*MUTATOR*/
    /**
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        //$this->attributes['slug'] = Str::slug($value, '-');
    }

    /**
     * create slug in db
     */
    protected static function boot() {
        parent::boot();
        static::creating(function ($ringtone) {
            $ringtone->slug = Str::slug($ringtone->title);
        });
    }
}
