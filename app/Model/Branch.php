<?php namespace Branches\Model;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	public function repo()
	{
        return $this->belongsTo('Branches\Model\Repo');
	}
}