<?php

namespace Hogus\LaravelSchemaMysqlExtend;

use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\ServiceProvider;

class GrammarServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blueprint::macro('comment', function ($index) {
            return $this->addCommand('comment', compact('index'));
        });

        /**
         * @example $table->comment('comment')
         *
         * Schema::table('example', function ($table) {
         *      $table->id();
         *      ......
         *      $table->comment('comment'); // Add Mysql Table Comments
         * })
         */
        Grammar::macro('compileComment', function ($blueprint, $command, $connection) {
            if ($connection instanceof MySqlConnection) {
                return "alter table {$this->wrapTable($blueprint)} comment = '{$command->index}' ";
            } elseif ($connection instanceof PostgresConnection) {
                return "comment on table {$this->wrapTable($blueprint)} is '{$command->index}' ";
            } else {
                throw new \Exception('Only supports mysql and postgres driver');
            }
        });
    }
}
