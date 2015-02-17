<?php namespace Branches\Http\Controllers;

use Illuminate\Http\Request;

use Branches\Model\Update;
use Branches\Commands\UpdateWorkingCopy;

use Branches\Decoders\GithubDecoder;
use Branches\Decoders\StashDecoder;

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

    public function webhook(Request $request)
    {
        error_log(strftime("%Y-%m-%d %H:%M:%S Webhook start\n"), 3, '/tmp/branches-log.log');
        
        file_put_contents('/tmp/branches.log', $request->getContent());
        
        if (stripos($_SERVER['HTTP_USER_AGENT'], 'github') === 0) {
            $decoder = new GithubDecoder;
        }
        else {
            $decoder = new StashDecoder;
        }
        $info = $decoder->decode(json_decode($request->getContent()));
        
        $this->dispatch(new UpdateWorkingCopy(Update::createFromInfo($info)));
        
        error_log(strftime("%Y-%m-%d %H:%M:%S Webhook finished\n"), 3, '/tmp/branches-log.log');        
        return 'OK';
    }
}
