<?php

namespace Hogus\LaravelSchemaMysqlExtend;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Illuminate\Support\ServiceProvider;

class MySqlGrammarServiceProvider extends ServiceProvider
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
        Grammar::macro('compileComment', function ($blueprint, $command) {
            if ($blueprint instanceof MySqlGrammar) {
                return "alter table {$this->wrapTable($blueprint)} comment = '{$command->index}' ";
            } else {
                throw new \Exception('Only supports mysql driver');
            }
        });
    }
}
