<?php

namespace Hogus\LaravelSchemaMysqlExtend;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Illuminate\Support\ServiceProvider;

class GrammarServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blueprint::macro('tableComment', function ($index) {
            return $this->addCommand('tableComment', compact('index'));
        });

        /**
         * @example $table->tableComment('comment')
         *
         * Schema::table('example', function ($table) {
         *      $table->id();
         *      ......
         *      $table->tableComment('comment'); // Add Mysql Table Comments
         * })
         */
        Grammar::macro('compileComment', function ($blueprint, $command) {
            if ($blueprint instanceof MySqlGrammar) {
                return "alter table {$this->wrapTable($blueprint)} comment = '{$command->index}' ";
            } elseif ($blueprint instanceof PostgresGrammar) {
                return "comment on table {$this->wrapTable($blueprint)} is '{$command->index}' ";
            } else {
                throw new \Exception('Only supports mysql and postgres driver');
            }
        });
    }
}
