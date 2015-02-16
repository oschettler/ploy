<?php namespace Branches\Http\Controllers;

use Illuminate\Http\Request;

use Branches\Model\Update;
use Branches\Commands\UpdateWorkingCopy;

class WelcomeController extends Controller
{
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

        $stash_repo_url = getenv('STASH_REPO_URL');

        $repo_url = strtr($stash_repo_url, [
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

        return (object)[
            'ssh_clone_url' => $ssh_clone_url,
            'name' => $repository->name,
            'owner_name' => $owner->displayName,
            'owner_email' => $owner->emailAddress,
            'branch_name' => $branch_name,
        ];
    }

    public function webhook(Request $request)
    {
        error_log(strftime("%Y-%m-%d %H:%M:%S Webhook start\n"), 3, '/tmp/branches-log.log');
        $info = $this->decodeInfo(json_decode($request->getContent()));
        
        $this->dispatch(new UpdateWorkingCopy(Update::createFromInfo($info)));
        
        error_log(strftime("%Y-%m-%d %H:%M:%S Webhook finished\n"), 3, '/tmp/branches-log.log');        
        return 'OK';
    }

    public function t()
    {
        $info = $this->decodeInfo(json_decode(file_get_contents('/tmp/branches.log')));
        Update::createFromInfo($info);

    }
}
