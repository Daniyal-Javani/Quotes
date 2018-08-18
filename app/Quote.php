<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;

class Quote extends Model implements LikeableContract
{
    use Likeable;
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

    /**
     * Get the author that owns the quote.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
