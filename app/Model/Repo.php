<?php namespace Branches\Model;
  
use Illuminate\Database\Eloquent\Model;

class Repo extends Model
{
   	public function branches()
	{
        return $this->hasMany('Branches\Model\Branch');
	}

}