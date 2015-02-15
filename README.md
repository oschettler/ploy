# Branches as Working Copies

Now at http://branches.schettler.net/

## Example Repository Script

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
  
  if [ ! -d $WC_REPOS_ROOT_DIR ]
  then
    # First time a branch from this repository is checked out
    git clone $WC_SSH_CLONE_URL $WC_REPOS_ROOT_DIR 2>&1
  fi

  # Make sure the branch is in the repo
  cd $WC_REPOS_ROOT_DIR$WC_REPO
  git fetch origin $WC_BRANCH:$WC_BRANCH 2>&1

  # Now we have the repo, clone it into the actual working copy
  cd $WC_ROOT_DIR
  git clone --single-branch --branch $WC_BRANCH $WC_REPOS_ROOT_DIR$WC_REPO $WC_DIR 2>&1

  # Fix up the remote URL to point to the original one
  cd $WC_DIR
  git remote set-url origin $WC_SSH_CLONE_URL 2>&1
fi
````