<?php namespace Branches\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Branches\Model\Repo;

class WelcomeController extends Controller
{

  const STASH_REPO_URL = 'https://{stash_user}:{stash_password}@jira.chefkoch.de/stash/rest/api/1.0/projects/{project_key}/repos/{repo_slug}';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}
	
	private function decodeInfo($info)
	{	
  	$repository = $info->repository;
  	$project = $repository->project;
  	$owner = $project->owner;

		$branch_name = join('/',
			array_slice(
				explode('/', $info->refChanges[0]->refId),
				2
			)
		);
		
		$repo_url = strtr(self::STASH_REPO_URL, [
  		'{stash_user}' => getenv('STASH_USER'),
  		'{stash_password}' => getenv('STASH_PASSWORD'),
  		'{project_key}' => $project->key,
  		'{repo_slug}' => $repository->slug,
		]);
		$repo_info = json_decode(file_get_contents($repo_url));
		
		$ssh_clone_url = null;
		foreach ($repo_info->links->clone as $url) {
  		if ($url->name == 'ssh') {
    		$ssh_clone_url = $url->href;
  		}
		}

		return [
			'ssh_clone_url' => $ssh_clone_url,
			'name' => $repository->name,
			'owner_name' => $owner->displayName,
			'owner_email' => $owner->emailAddress,
			'branch_name' => $branch_name,
		];
	}

	public function webhook(Request $request)
	{
		$info = $this->decodeInfo(json_decode($request->getContent()));
    
		return 'OK';
	}

	public function t()
	{
    $info = $this->decodeInfo(json_decode(file_get_contents('/tmp/branches.log')));
    
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
      $branch = Branch::where('name', '=', $info->branch_name);
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
    
    $update = new Update;
    $update->branch_id = $branch->id;
    $update->save();
    
    /*
     * Log
     */ 
    
    $log = new Log;
    $log->update_id = $update->id;
    $log->message = "Branch {$repo->name}.{$branch->name} updated";
    $log->save();
    
    
	}
}
