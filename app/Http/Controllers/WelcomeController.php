<?php namespace Branches\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

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

	public function webhook(Request $request)
	{
		$info = json_decode($request->getContent());

		$repo_url = parse_url($info->changes->values[0]->links->self[0]->href);
		$repo_path = join('/',
			array_slice(
				explode('/', $repo_url['path']),
				0, -2
			)
		);

		$branch = join('/',
			array_slice(
				explode('/', $info->refChanges->refId),
				2
			)
		);

		$repo = [
			'url' => $repo_url['schema'] . '://' . $repo_url['host'] . $repo_path,
			'name' => $info->repository->name,
			'slug' => $info->repository->slug,
			'ownerSlug' => $info->repository->project->owner->slug,
			'ownerName' => $info->repository->project->owner->displayName,
			'email' => $info->repository->project->owner->emailAddress,
			'branch' => $branch,
		];



		return 'OK';
	}

	public function t()
	{

	}
}
