<?php namespace Branches\Model;
  
use Illuminate\Database\Eloquent\Model;

class Repo extends Model
{
   	public function branches()
	{
        return $this->hasMany('Branches\Model\Branch')->orderBy('updated_at');
	}

    public function paginatedBranches($limit = 10)
    {
        return $this->branches()->paginate($limit);
    }

    public function script()
    {
        return $this->belongsTo('Branches\Model\Script');
    }

}