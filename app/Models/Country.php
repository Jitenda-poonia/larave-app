<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "status",
    ];
    public function states(){                    //country edit me state edit ke liye
        return $this->hasMany(State::class);  
           // ya  
        // return $this->hasMany(State::class ,"country_id");  //jab State- country me relestion ho -> ydi  State table me Country ki id country_id(artharth Country model h jisme id h)h to country_id likhne ki aavsykta nhi h
    }

//     // country ke name ke aage ya piche change krne ke liye
//     public function getNameAttribute($value){
//         return $this->attributes[""] = "cnnnmmt:  ".$value;

// }
 }