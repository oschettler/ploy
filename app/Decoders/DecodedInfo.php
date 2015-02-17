<?php namespace Branches\Decoders;
    
class DecodedInfo
{
    public $ssh_clone_url;
    public $name;
    public $owner_name;
    public $owner_email;
    public $branch_name;

    public function __construct(array $data)
    {
        $this->ssh_clone_url = $data['ssh_clone_url'];
        $this->name = $data['name'];
        $this->owner_name = $data['owner_name'];
        $this->owner_email = $data['owner_email'];
        $this->branch_name = $data['branch_name'];
    }
}
