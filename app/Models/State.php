<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        "country_id",
        "name",
        "status"
    ];
    public function cities(){
        return $this->hasMany(City::class);  // use of edit file
    }
      public function country(){   //state index me country ka name ke liye
        return $this->belongsTo(Country::class); 
    }

    // State ke name ke aage ya piche change krne ke liye
//    public function getStateNameAttribute($value){        //table me state_name -> Attribute  me StateName use kre
//         return $this->attributes[] = "ttt:  ".$value."jj";
// }
}
