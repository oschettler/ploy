<?php namespace Branches\Http\Controllers;

use Branches\Http\Requests;
use Branches\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Branches\Model\Job;
use Branches\Http\Requests\JobRequest;

use Illuminate\Queue\Jobs\DatabaseJob;

class JobsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('jobs.index', [
    		'jobs' => Job::all(),
		]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function count()
	{
    	return response()->json(['count' => Job::count()]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($job)
	{
		$queueJob = new DatabaseJob($this->container, $this->database, $job, 'default');
		var_dump($queueJob);
	}

}
