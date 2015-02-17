<?php namespace Branches\Decoders;

use Branches\Decoders\DecodedInfo;

class GithubDecoder
{
    /**
     * @return DecodedInfo
     */
    public function decode($info)
    {
        $repository = $info->repository;
        $owner = $repository->owner;
        
        $branch_name = join('/',
            array_slice(
                explode('/', $info->ref),
                2
            )
        );

        return new DecodedInfo([
            'ssh_clone_url' => 'ssh://' . $repository->ssh_url,
            'name' => $repository->name,
            'owner_name' => $owner->name,
            'owner_email' => $owner->email,
            'branch_name' => $branch_name,
        ]);
    }
}
