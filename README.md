# coding-test-laravel [![Build Status](https://api.travis-ci.org/samundrak/coding-test-laravel.svg?branch=master)](https://travis-ci.org/samundrak/coding-test-laravel)
Simple Laravel app data manupulation from CSV

# Context
This is a simple coding task not a coding challenge. This has only Create and Read of the small CRUD part for the client section of the application.

# Task
Things to do 
Create a form to get
```
Name
Gender
Phone
Email
Address
Nationality
Date of birth
Education background
Preferred mode of contact (select one from email, phone, none)
```
You can be creative with the fields.
Add relevant validation to the form both frontend (js) and backend (php)
After form submission, if fields are valid save to a csv file
Show all clients pulled in from the CSV as another page

### Software used
* **PHP**
* **Laravel** [ PHP Framework ] for backend stuff 
* **BootStrap** for simple layouts
*  **Jquery** as dependency of bootstrap
*  **AngularJS** for frontend stuff like routing,validation, api calls
*  **Bower** to install frontend dependecies 
*  **Gulp** to autmate some build task like for **PHPunit**
*  **PaceJS** for displaying loading bar on ajax calls

### Installation 
 First clone this repo and then from root of this app in your command line enter 
* ```composer self-update``` [Optional]
* ```composer install --prefer-source --no-interaction```
* ```cp .env.example .env```
* ```php artisan key:generate```
* ```npm install -g bower``` if you dont have already installed bower file
* ```npm install``` [Optional] for all gulp dependency ,Not needed if gulp is not used
* ```bower install``` for all frontend depedency to make design and behavior work it is needed

### Run
If this app is going to run on Linux OS then enter ```sh server.sh``` or ```./server.sh``` from your command line at root of app .

***OR*** 

```php -S localhost:3000 -t ./```

***OR***

```php artisan serve```

***OR***

You can put this file on xamp's htdocs or  wamp's www folder
#Demo
 http://mansalu.herokuapp.com/#/
# Misc
* No Any external php dependecy has been added
