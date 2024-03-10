<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "first_name",
        "last_name",
        "dob",
        "email",
        "phone",
        "gender",
        "address",
        "city",
        "pincode",
        "state_id",
        "country_id",
        "hobbies",
        "other_hobbies",
        "course",
        
       ];
       public function stuQul(){
        return $this->hasMany(student_qualification::class);
       }
       public function country(){
        return $this->belongsTo(Country::class,"country_id"); //student table me->"country_id"
       }
       public function state(){
        return $this->belongsTo(State::class ,'state_id'); //student table me->"state_id",(state_id likh bi skte nhi bhi)
       }
       public function getDobAttribute($value){
        return date('d-M-Y',strtotime($value));
       }
       public function setFirstNameAttribute($value){
        $this->attributes['first_name'] = ucwords($value);
       }
}
