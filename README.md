# Simple School Admin, Teacher nas Studnet with laravel and PHP 7.


# Features
# Three User Based Login (3 Seprate Dashboard) with Middlware
# Admin 
- Add Teacher
- Add Student
- Add Subject
- Add Feedback or Update Detail
- Zoom Meeting Creat/Update/Delete and Meeting End
# Teacher
- Veiw Assignment
- Add Feedback and Approve
- View Zoom Meeting (Live and Upcoming)
# Student
- Add Assignment 
- Update and Veiw Assignment 
- View Zoom Meeting (Live and Upcoming)

# Limititaion
- Teacher should be accessable only realtive subject's assignment
- Zoom Free Version has many restrictions, so could't cover like create user, create group and other.

# Installation and use

- Import Dataabse which is icnluded on root directcory called (database.sql)

# OR

- Run migrate.

**Dependency**
- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- [hrshadhin/laravel-userstamps](https://github.com/hrshadhin/laravel-userstamps.git)
- NodeJS, npm, webpack


```
$ git clone https://github.com/hrshadhin/school-management-system.git

```
```
$ cd demo_school_with_zoom_meeting_api
```
```
$ cp .env.example .env
```
**Change configuration according to your need in ".env" file and create Database**
```

```
**Please for Zoom Meeting go to marketplace and create JWT app then get** (https://marketplace.zoom.us/)
ZOOM_CLIENT_KEY
ZOOM_CLIENT_SECRET 

And add to .env file with above key.

```

```
```
$ composer install and composer update
```
```

```
**Clear cache**
```
$ sudo php artisan cache:clear
```
```
$ npm install
```
```
$ npm run dev
```
```
$ php artisan storage:link
```
```
$ php artisan serve
```

**Demo(Admin)**\
username: admin@gmail.com\
password: password

**Demo(Teacher)**\
username: teacher@gmail.com\
password: password\

**Demo(Student)**\
username: student@gmail.com\
password: password\


# Issues

If you discover a issues within Simple School with Zoom API, please send an e-mail to (dreamsagar25@gmail.com).

# License

Simple School is open-sourced software licensed under the AGPL-3.0 license. Frameworks and libraries has it own licensed.
