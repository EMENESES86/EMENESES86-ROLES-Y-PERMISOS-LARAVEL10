<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
  
class User_saga extends Model
{
   
  	protected $connection = 'mysql_saga';
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
}