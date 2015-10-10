## DVD-Rental


#### Install Dependencies

To install all the dependencies, Just run the command on your terminal

```
composer install
```

#### Database Configuration

Open app/config/database.php file then setup you database connection type, database hostname, username & password.

#### Email Configuration

Open app/config/mail.php file then setup your email username & password. Don't forget to add your SMTP host name & port number.

#### Database Migration
Run the command on your terminal

```
php artisan migrate
```

#### Database Seed

```
php artisan db:seed
```

#### Start Development Server

```
php artisan serve
```

#### Default Users

###### Admin

username: admin <br />
password: admin123

###### Employee

username: employee <br />
password: employee123

###### Member

username: member <br />
password: member123


#### Demo

[DVD Rental Demo](http://dvdrental.iftekhersunny.com)
