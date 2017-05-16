# Yet Another Todos App

Using:

* Laravel
* Vuejs

# Installtion

* Create a new Mysql databsae and name it ```todos``` and set the databsae crendetials in ```.env``` file .

* Create a database in Mysql and name it ```todos-dusk``` and set the databsae crendetials in ```.env.dusk.local``` file.
To overwrite this name open the ```bootstrap/app.php``` file and go to the line no ```58``` and set the new database name.  

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