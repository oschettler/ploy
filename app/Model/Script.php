<?php namespace Branches\Model;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;
use Mpociot\Versionable\Version;

class Script extends Model {

    use VersionableTrait;
    protected $fillable = ['name', 'description', 'body'];

    public function lastVersions($limit = 10)
    {
        return $this->versions()
            ->orderBy(Version::CREATED_AT , 'DESC')
            ->take($limit)
            ->get();
    }
}
