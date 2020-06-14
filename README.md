<h1 align="center"> laravel-schema-extend </h1>

<p align="center"> laravel schema table comments extend.</p>


## Installing

```shell
$ composer require hogus/laravel-schema-mysql-extend -vvv
```

## Usage

### 1.0
```php
Schema::table('example', function ($table) {
   $table->id();
    //......
   $table->comment('comment'); // Add Mysql Table Comments
 });
```

### 2.0
```php
# support mysql and postgres
Schema::table('example', function ($table) {
   $table->id();
    //......
   $table->tableComment('comment'); // Add Table Comments
 });
```

## License

MIT
