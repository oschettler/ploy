<?php namespace Branches\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Branches\Model\Script;

class PloyScript extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ploy:script';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Output a Ploy Script.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$script = Script::where('name', $this->argument('script'))->firstOrFail();

        // Remove carriage returns. The shell can't handle them
        echo strtr($script->body, ["\r" => '']);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['script', InputArgument::REQUIRED, 'Name of a Ploy Script.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
