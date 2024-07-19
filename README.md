Clone the repository: git clone https://github.com/Sreerajnr2212/dynamic-forms.git
or download the zip folder using: https://github.com/Sreerajnr2212/dynamic-forms

Run the command "cp .env.example .env"

Set up your environment variables database and mail configuration in .env file

Delete composer.lock file

Run the command "composer install"

Run the command "php artisan key:generate"

Run the command "php artisan migrate"

Run the command "php artisan db:seed --class=UsersTableSeeder"

Run the command "php artisan serve"

Please change the email in App/Jobs/SendFormCreatedNotification

Run the command "php artisan queue:work"

admin credential Email: "admin@gmail.com",Password:"password123"

admin url: your_localhost or yourlocalhost/admin

user url: your_localhost/users
