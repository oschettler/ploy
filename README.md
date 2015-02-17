# Deploy Branches

This is the initial release of an application that you use as follows:

* Create a repository in Atlassian Stash 
* Register startpage of this application as Post-Receive WebHook in Stash
* Work in your repository. Push something
* Stash will POST some info about the changes to your startpage
* The startpage will extract some information from these post data and will call Stash for further information
* With this, it will update its database and queue a job to update the working copy of the affected branch

## Use Cases

*  Deploy each branch as a working copy, in the guise of https://platform.sh/
*  Automatically deploy code updates to a production server, possibly after running a set of automatic tests 

## Setup

After cloning this repository and setting the document root of a web server (e.g. http://branches.example.com) to the web directory, create a file .env and set the following variables:

````
APP_ENV = production
APP_DEBUG = false
APP_KEY = 32char secret key

STASH_REPO_URL = https://{stash_user}:{stash_password}@stash.example.com/stash/rest/api/1.0/projects/{project_key}/repos/{repo_slug}
STASH_USER = your-stash-user
STASH_PASSWORD = your-stash-password

DB_HOST = localhost
DB_DATABASE = branches
DB_USERNAME = branches
DB_PASSWORD = database-password

REPOS_ROOT_DIR = /path/to/your/repos/
WORKING_COPY_ROOT_DIR = /path/to/your/working-copies/
````

Now, create a database `branches` and load it with `database/schema.sql`.

Push once. You should now have an entry for your repository in the database.

Access the startpage, and register yourself an account. On the startpage, your repository should now be listed. Click on the edit button and enter the following script.

On the command line, run the Laravel queue manually:

````
php artisan queue:work
````

In your `WORKING_COPY_ROOT_DIR`, there will now be a clone of the branch you pushed. Point a webserver at it.

## Example Deployment Recipe

````
# This script gets invoked with the following environment variables:
# - WC_BRANCH
# - WC_REPO
# - WC_SSH_CLONE_URL
# - WC_REPOS_ROOT_DIR
# - WC_ROOT_DIR
# - WC_DIR

set -x

cd $WC_ROOT_DIR

if [ -d $WC_DIR ]
then
  # Working copy already there. Update it
  cd $WC_DIR
  git pull 2>&1
  
else
  # Working copy not there yet
  
  repo_dir="$WC_REPOS_ROOT_DIR$WC_REPO"

  if [ ! -d $repo_dir ]
  then
    # First time a branch from this repository is checked out
    git clone $WC_SSH_CLONE_URL $repo_dir 2>&1
  fi

  # Make sure the branch is in the repo
  cd $repo_dir
  git fetch origin $WC_BRANCH:$WC_BRANCH 2>&1

  # Now we have the repo, clone it into the actual working copy
  cd $WC_ROOT_DIR
  git clone --single-branch --branch $WC_BRANCH $repo_dir $WC_DIR 2>&1

  # Fix up the remote URL to point to the original one
  cd $WC_DIR
  git remote set-url origin $WC_SSH_CLONE_URL 2>&1
fi
````
