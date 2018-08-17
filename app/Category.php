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
    public function subcategories()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    /**
     * Get the parent category.
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    /**
     * Get the categories for the user.
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();;
    }

    /**
     * Get quotes for the category.
     */
    public function quotes()
    {
        return $this->hasMany('App\Quote');
    }
}
