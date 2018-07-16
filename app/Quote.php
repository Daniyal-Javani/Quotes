<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * Get the user that owns the quote.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the author that owns the quote.
     */
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
