# Localization App

## Project Structure

* 📁 [app](./app)
  * 📁 [Http](./app/Http)
    * 📁 [Controllers](./app/Http/Controllers)
      * 📄 [Controller.php](./app/Http/Controllers/Controller.php)
      * 📄 [GreetingController.php](./app/Http/Controllers/GreetingController.php)
      * 📄 [ProductController.php](./app/Http/Controllers/ProductController.php)
      * 📄 [WelcomeController.php](./app/Http/Controllers/WelcomeController.php)
  * 📁 [Models](./app/Models)
    * 📄 [Product.php](./app/Models/Product.php)
    * 📄 [User.php](./app/Models/User.php)
  * 📁 [Providers](./app/Providers)
    * 📄 [AppServiceProvider.php](./app/Providers/AppServiceProvider.php)
* 📁 [bootstrap](./bootstrap)
* 📁 [config](./config)
* 📁 [database](./database)
  * 📁 [factories](./database/factories)
    * 📄 [ProductFactory.php](./database/factories/ProductFactory.php)
    * 📄 [UserFactory.php](./database/factories/UserFactory.php)
  * 📁 [migrations](./database/migrations)
    * 📄 [0001_01_01_000000_create_users_table.php](./database/migrations/0001_01_01_000000_create_users_table.php)
    * 📄 [0001_01_01_000001_create_cache_table.php](./database/migrations/0001_01_01_000001_create_cache_table.php)
    * 📄 [0001_01_01_000002_create_jobs_table.php](./database/migrations/0001_01_01_000002_create_jobs_table.php)
    * 📄 [2025_06_18_123707_create_products_table.php](./database/migrations/2025_06_18_123707_create_products_table.php)
  * 📁 [seeders](./database/seeders)
    * 📄 [DatabaseSeeder.php](./database/seeders/DatabaseSeeder.php)
    * 📄 [ProductSeeder.php](./database/seeders/ProductSeeder.php)
* 📁 [public](./public)
  * 📄 [index.php](./public/index.php)
* 📁 [resources](./resources)
  * 📁 [css](./resources/css)
    * 📄 [app.css](./resources/css/app.css)
  * 📁 [js](./resources/js)
    * 📄 [app.js](./resources/js/app.js)
    * 📄 [bootstrap.js](./resources/js/bootstrap.js)
  * 📁 [lang](./resources/lang)
    * 📁 [en](./resources/lang/en)
      * 📄 [messages.php](./resources/lang/en/messages.php)
    * 📁 [uk](./resources/lang/uk)
      * 📄 [messages.php](./resources/lang/uk/messages.php)
  * 📁 [views](./resources/views)
    * 📄 [greeting.blade.php](./resources/views/greeting.blade.php)
    * 📄 [products.blade.php](./resources/views/products.blade.php)
    * 📄 [welcome.blade.php](./resources/views/welcome.blade.php)
* 📁 [routes](./routes)
  * 📄 [console.php](./routes/console.php)
  * 📄 [web.php](./routes/web.php)
* 📁 [screenshots](./screenshots)
* 📄 [composer.json](./composer.json)
* 📄 [package.json](./package.json)
## Screenshots

![1.1.png](./screenshots/1.1.png)

![1.2.png](./screenshots/1.2.png)

![1.3.png](./screenshots/1.3.png)

![1.4.png](./screenshots/1.4.png)