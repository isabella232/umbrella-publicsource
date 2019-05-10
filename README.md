## Setup instructions

This repository is designed to be set up in accordance with https://github.com/INN/docs/blob/master/projects/largo/umbrella-setup.md


Prompt | Text to enter 
------------ | -------------
Name of new site directory: | publicsource
Domain to use (leave blank for largo-umbrella.dev): | publicsource.test
Install as multisite? (y/N): | n

1. `cd` to the directory `publicsource/` in your VVV setup
2. `git clone git@github.com:INN/umbrella-publicsource.git`
3. Copy the contents of the new directory `umbrella-publicsource/` into `htdocs/`, including all hidden files whose names start with `.` periods.


## Notice of repository name change

Where this repository was once `INN/publicsource-umbrella` on Github, it is now `INN/umbrella-publicsource`. If you had previously cloned this repository, you will need to navigate to this directory on your computer and take the following steps:

1. Run `git remote -v` to list remotes. Make a note of the name that matches `git@github.com:INN/publicsource-umbrella.git`. It's probably `origin`.
2. Run `git remote set-url origin git@github.com:INN/umbrella-publicsource.git` where `origin` is the name of the remote you saw in the previous step.
3. Run `git fetch origin`
4. If you have any local working branches that track remote branches, you may need to:
	1. check out the local branch: `git checkout foo`
	2. update the local branch's upstream: `git branch -u origin/foo foo`
