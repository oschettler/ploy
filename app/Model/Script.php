<?php namespace Branches\Model;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\VersionableTrait;

class Script extends Model {

    use VersionableTrait;
    protected $fillable = ['name', 'description', 'body'];

}
