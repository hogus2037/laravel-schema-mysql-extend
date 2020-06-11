<h1 align="center"> laravel-schema-mysql-extend </h1>

<p align="center"> laravel schema mysql extend.</p>


## Installing

```shell
$ composer require hogus/laravel-schema-mysql-extend -vvv
```

## Usage

```php
Schema::table('example', function ($table) {
   $table->id();
    //......
   $table->comment('comment'); // Add Mysql Table Comments
 });
```

## License

MIT
