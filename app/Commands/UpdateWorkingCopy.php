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
        $args = $this->update->workingCopyArgs();
        foreach ($args->args as $name => $value) {
            putenv(strtoupper($name) . '=' . $value);
        }

        // Remove carriage returns. The shell can't handle them
        $script = strtr($args->script, ["\r" => '']);

        Log::say($this->update->id, "Script:\n{$script}");

        $fname = tempnam(sys_get_temp_dir(), 'ploy');
        file_put_contents($fname, $script);

        exec("/bin/bash $fname 2>&1", $output, $status);

        unlink($fname);

        Log::say($this->update->id, join("\n", $output) . "\nStatus: {$status}");
        
        $status = ($status == 0) ? 'success' : "error status-{$status}";
        $this->update->status = $status;
        $this->update->save();
	}

}
