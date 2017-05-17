# Yet Another Todos App #

### Using 

* Laravel
* Vuejs

### Installtion

* I will assume that ```npm``` and ```composer``` already installed on your compouter.

* Create a new Mysql databsae and name it ```todos``` and set the databsae crendetials in ```.env``` file .

* Create a new database in Mysql ( for dusk tests ) and name it ```todos-dusk``` and set the databsae crendetials in ```.env.dusk.local``` file, To overwrite this name open the ```bootstrap/app.php``` file and go to the line no ```58``` and set the new database name.  

* Run the installation script:

```
git clone https://github.com/nezarfadle/laravel-vue-todos.git
cd laravel-vue-todos
chmod +x install.sh
./install.sh
```

* Visit ```http://localhost:8000/```

### How to run the tests

```
phpunit
php artisan dusk
```

### License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

### Credit

Template by [Sindre Sorhus](http://sindresorhus.com) 
Template on Github [https://github.com/tastejs/todomvc-app-template/](https://github.com/tastejs/todomvc-app-template/) 
