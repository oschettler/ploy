<?php

use Branches\Model\Update;

class UpdateTest extends TestCase
{

    public function testWorkingCopyArgs()
    {
        $update = Update::createFromInfo((object)[
            'name' => 'test',
            'owner_name' => 'Tester',
            'owner_email' => 'tester@ploy.rocks',
            'ssh_clone_url' => 'ssh://clone-url',
            'branch_name' => 'test-branch-TICKET-123-tralla-hudli',
        ]);
        $args = $update->workingCopyArgs();
        $this->assertEquals('test-test-branch-ticket-123', $args->args['wc_dir']);
    }
}
