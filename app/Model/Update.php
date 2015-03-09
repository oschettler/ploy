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
        $update->status = 'created';
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
        return $this->belongsTo('Branches\Model\Branch');
	}

    public function logs()
    {
        return $this->hasMany('Branches\Model\Log');
    }

	public function workingCopyArgs()
	{
        $root_dir = getenv('WORKING_COPY_ROOT_DIR');
        $branch = $this->branch;
        $repo = $branch->repo;

        $wc_dir = strtolower(preg_replace('/\W+/', '-', $repo->name . '-' . $branch->name));
        if (preg_match('#^([-\w]*-\w+-\d+)#', $wc_dir, $matches)) {
            // Shorten a working copy directory up until a ticket number
            $wc_dir = $matches[1];
        }

        return (object)[
            'script' => $repo->update_script,
            'args' => [
                'wc_branch' => $branch->name,
                'wc_repo' => $repo->name,
                'wc_ssh_clone_url' => $repo->ssh_clone_url,
                'wc_repos_root_dir' => getenv('REPOS_ROOT_DIR'),
                'wc_root_dir' => $root_dir,
                'wc_dir' => $wc_dir,
            ],
        ];
	}
}