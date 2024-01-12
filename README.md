Project Setup Steps: 

1- git clone https://github.com/jamtechdev/laravel-10-roles-permissions.git
2- composer i / composer update
3- copy .env.example .env 
4- Set DATABASE configuration in .env file
5- php artisan key:generate
6- php artisan migrate
7- artisan permission:create-permission-route
9- php artisan db:seed
10- php artisan serve