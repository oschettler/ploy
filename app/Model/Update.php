<?php namespace Branches\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Branches\Model\Repo;
use Branches\Model\Branch;
use Branches\Model\Log;

class Update extends Model
{
    public static function createFromInfo($info)
    {
        /*
         * Repo
         */

        try {
            $repo = Repo::where('name', '=', $info->name)->firstOrFail();
        }
        catch (ModelNotFoundException $e) {
            $repo = new Repo;
            $repo->name = $info->name;
        }

        $repo->owner_name = $info->owner_name;
        $repo->owner_email = $info->owner_email;
        $repo->ssh_clone_url = $info->ssh_clone_url;
        $repo->save();

        /*
         * Branch
         */

        try {
            $branch = Branch::where('name', '=', $info->branch_name)->firstOrFail();
        }
        catch (ModelNotFoundException $e) {
            $branch = new Branch;
            $branch->name = $info->branch_name;
        }

        $branch->repo_id = $repo->id;
        $branch->save();

        /*
         * Update
         */

        $update = new self;
        $update->branch_id = $branch->id;
        $update->save();

        /*
         * Log
         */

        $log = new Log;
        $log->update_id = $update->id;
        $log->message = "Update for {$repo->name}.{$branch->name}";
        $log->save();

        return $update;
	}

	public function branch()
	{
        $this->belongsTo('Branches\Model\Branch');
	}

	public function workingCopyDirectory()
	{
        $root_dir = getenv('WORKING_COPY_ROOT_DIR');
        $branch = $this->update->branch;
        return $root_dir
            . preg_replace('/\W+/', '-', $branch->repo->name . '-' . $branch->name);
	}
}