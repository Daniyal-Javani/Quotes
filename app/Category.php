<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'parent_id'];

    /**
     * Get the categories for the author.
     */
    public function categories()
    {
        return $this->hasMany('App\Quote');
    }

    /**
     * Get the categories for the author.
     */
    public function subcategories()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }
}
