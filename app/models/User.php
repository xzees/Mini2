<?php 

namespace Models;

class User extends \Illuminate\Database\Eloquent\Model 
{
    
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $connection = 'default';
    public $timestamps = false;
    
}