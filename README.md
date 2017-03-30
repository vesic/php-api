# php-api

## About

Simple PHP RESTful service.

## Online

[http://php-vesic.rhcloud.com/employees](http://php-vesic.rhcloud.com/employees)

## Getting Started

```
$ git clone https://github.com/vesic/php-api
$ cd php-api
$ composer install
```

Serve application.

Install, configure and run MySql server.

Modify config.php file with your options.

Import employee.sql file.

## Routes

GET /employees # return all employees

GET /employees/{id} # return single employee

POST /employees # post employee

json payload example 
```
{
    "name" : "some name",
    "department" : "some department",
    "salary" : "salary"
}
```

POST /employees/{id} # update employee

json payload example
```
{
    "id" : id,
    "name" : "some name",
    "department" : "some department",
    "salary" : "salary"
}
```

DELETE /employees/{id} # delete employee

## Libraries

[Klein. A fast & flexible router](https://github.com/klein/klein.php)

## Todo

Set proper status codes for all verbs.

Add CORS support.
