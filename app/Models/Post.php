<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $with = ['photos','user','category'];


    //accessor

//    public function getTitleAttribute($value)
//    {
//        return strtoupper($value);
//    }



    public function getTimeAttribute(){
        return " <p class='small mb-0 text-black-50'>
                     <i class='bi bi-calendar'></i>
                    {$this->created_at->format('d M Y')}
                </p>
                <p class='small mb-0 text-black-50'>
                    <i class='bi bi-clock'></i>
                    {$this->created_at->format('h : m A')}
                </p>
                        ";
    }

//    protected $casts = [
//      "category_id" => "boolean"
//    ];

    //mutator

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public  function photos(){
        return $this->hasMany(Photo::class);
    }

    public function scopeSearch($query){
        return $query->when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere("title","like","%$keyword%")
                ->orWhere("description","like","%$keyword%");
        });
    }

    protected static function booted()
    {
//        static::created(function(){
//            logger("I created a post");
//        });
    }
}
