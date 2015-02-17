<?php namespace Branches\Decoders;
    
use Branches\Decoders\DecodedInfo;
    
class StashDecoder
{
    /**
     * @return DecodedInfo
     */
    public function decode($info)
    {
        $repository = $info->repository;
        $project = $repository->project;
        
        if (isset($project->owner)) {
            $owner = $project->owner;
            $owner_name = $owner->displayName;
            $owner_email = $owner->emailAddress;
        }
        else {
            $owner_name = null;
            $owner_email = null;
        }

        $branch_name = join('/',
            array_slice(
                explode('/', $info->refChanges[0]->refId),
                2
            )
        );

        $ssh_clone_url = null;

        // Only try to get the ssh_clone_url if STASH_REPO_URL is configured         
        if (getenv('STASH_REPO_URL')) {
            $stash_repo_url = getenv('STASH_REPO_URL');
    
            $repo_url = strtr($stash_repo_url, [
                '{stash_user}' => getenv('STASH_USER'),
                '{stash_password}' => getenv('STASH_PASSWORD'),
                '{project_key}' => $project->key,
                '{repo_slug}' => $repository->slug,
            ]);
            $repo_info = json_decode(file_get_contents($repo_url));
    
            foreach ($repo_info->links->clone as $url) {
                if ($url->name == 'ssh') {
                    $ssh_clone_url = $url->href;
                }
            }
        }

        return new DecodedInfo([
            'ssh_clone_url' => $ssh_clone_url,
            'name' => $repository->name,
            'owner_name' => $owner_name,
            'owner_email' => $owner_email,
            'branch_name' => $branch_name,
        ]);
    }
}