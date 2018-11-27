# DDD Course Workshop

Repository ready to doing implementing the DDD.

## Run locally with Docker
- There is only one container, called app. It contains PHP 7.2 with the Apache server.
- SSH access is provided into the container.
- Other services can be added via ```docker-compose.yml```
- HTTP application listens on port *8080*
- SSH for outside connections listens on port *2222*
### Prerequisites
 - Newest stable ```docker```
 - Newest stable ```docker-compose```
### How to run it
 - clone repo
 - cd into ```.docker``` directory
 - ```docker-compose up``` **OR** you can run ```docker-compose up -d``` to start docker in the background
 - ```docker-compose exec --user=appuser app bash```
 - ```composer install```
 - ```composer check```
### How to use it
 - get to shell: in the ```.docker``` directory, run: ```docker-compose exec --user=appuser app bash```
 - in the shell you can run the usual ```composer``` commands
 - when you get tired of container awesomeness, you can stop it with ```docker-compose down``` in the ```.docker``` directory
### Extra goodies
 - SSH is set up in the container, so you can connect from PHPStorm and run the test in their fancy test runner
    - Private key that gets inserted into the container is in the .docker directory

## Run
```bash
git clone git@github.com:simara-svatopluk/ddd-course-workshop.git
cd ddd-course-workshop
composer install
composer check
```

We don't live in caves, so always run tests, check PSR-2 and run static analysis.  
Command `composer check` does all of it.

## Workshop resources

* [Language](https://github.com/simara-svatopluk/ddd-course/blob/master/2-language/workshop/workshop.md)
* [Model](https://github.com/simara-svatopluk/ddd-course/blob/master/3-model/workshop/workshop.md)
