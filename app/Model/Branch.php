<?php namespace Branches\Model;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	public function repo()
	{
        return $this->belongsTo('Branches\Model\Repo');
	}

    public function lastUpdate()
    {
        return $this->updates()
            ->orderBy('created_at' , 'DESC')
            ->first();
    }

    public function updates()
    {
        return $this->hasMany('Branches\Model\Update')
	    ->orderBy('created_at' , 'DESC');
    }

    public function paginatedUpdates($limit = 3)
    {
        return $this->updates()->paginate($limit);
    }

}
