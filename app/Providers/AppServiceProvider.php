<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Instituicao;
use Requests\Validators\CustomValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); // Correção de limite de string do banco em versões antigas

        // Dados compartilhados em todas as views
        $instituicao = Instituicao::get()->first();
        View::share('dadosInst', $instituicao);

        // regras de validação personalizadas
        Validator::extend('sex'       , 'App\Http\Requests\Validators\CustomValidator@sex');
        Validator::extend('timeAfter' , 'App\Http\Requests\Validators\CustomValidator@timeAfter');
        Validator::extend('timeBefore', 'App\Http\Requests\Validators\CustomValidator@timeBefore');
        Validator::extend('rg'        , 'App\Http\Requests\Validators\CustomValidator@rg');
        Validator::extend('cpf'       , 'App\Http\Requests\Validators\CustomValidator@cpf');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
