<?php namespace Branches\Commands;

use Branches\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use Branches\Model\Update;
use Branches\Model\Log;

class UpdateWorkingCopy extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	/** @var Update */
	protected $update;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Update $update)
	{
		$this->update = $update;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $dir = $this->update->workingCopyDirectory();
		$cmd = "cd {$dir} && git pull 2>&1";

		$log = new Log;
		$log->message = "Command: {$cmd}";
		$log->save();

		$log = new Log;
        $log->message = shell_exec($cmd);
        $log->save();
	}

}
