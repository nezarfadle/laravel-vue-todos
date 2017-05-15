# Yet Another Todos App

Using:

* Laravel
* Vuejs

# Installtion

* Create a new Mysql databsae and name it ```todos```, And then open the .env file and set the databsae crendetials.

* Create a database in Mysql and name it ```todos-dusk```, To override this name open the file ```bootstrap/app.php``` and go to the line no ```58``` and set the new database name, And then open the ```.env.dusk.local``` file and set the databsae crendetials.

* Run the installtion script:

```
git clone https://github.com/nezarfadle/laravel-vue-todos.git
cd laravel-vue-todos
chmod +x install.sh
./install.sh
```

* Visit ```http://localhost:8000/```

# How to run the tests

```
phpunit
php artisan dusk
```