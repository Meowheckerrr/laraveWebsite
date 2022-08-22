<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listing extends Model
{
    use HasFactory;
    // add the fillable property
    //protected $fillable = ["company",'title','location','email','website','tags', 'description'];  //appServerProvider   model:unguard()
    

    public function scopeFilter($query, array $filters){
        //Tag filter
        if($filters['tag'] ?? false){  //tag from the database 
            $query->where('tags','like','%'.request('tag').'%');
        }

        //dd($filters['tag']);
        //Search filter 
        if($filters['search'] ?? false){  //tag from the database 

            $query->where('title','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%')
            ->orWhere('tags','like','%'.request('search').'%')
            ->orWhere('location','like','%' .request('search')."%")
            ->orWhere('company','like','%' .request('search')."%");
            
        } 
    }

    //Relationship to user
    public function user(){  //listings belong to a user 
         return $this->belongsTo(User::class,'user_id');
    }

}
