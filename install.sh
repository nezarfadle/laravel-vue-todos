echo "Installing the required packages"
composer install
npm install

echo "Migrating the database"
mkdir ./database/sqlite/
touch ./database/sqlite/database.test.sqlite
php artisan migrate
php artisan dusk:install

echo "Running the server the server"
php artisan serve

