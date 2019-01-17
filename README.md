# DDD Course Workshop

Repository demonstates DDD implementation, done during [DDD course](http://bit.ly/ddd-course).

### Implemented

* Aggregate `IssuedInovice` *(also an entity)*
* Value Objects `Item`, `Items`, `Number`, `Crown`
* Domain interface `Series`
* Repository `IssuedInvoices`
* PDO implementation of `Series`
* Doctrine implementation of `IssuedInvices`
* A reasonable amout of tests (code coverage almost 100)

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

## Demo resources

* [Implementation](http://bit.ly/ddd-implementation-materials)
* [Persistence](http://bit.ly/ddd-persistence-materials)
