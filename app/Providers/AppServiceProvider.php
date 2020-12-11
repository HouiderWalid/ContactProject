<?php

namespace App\Providers;

use App\billing\BankPaymentGateway;
use App\billing\CreditPaymentGateway;
use App\billing\PaymentGatewayContract;
use App\PostCardSendingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGatewayContract::class, function($app){
            if(request()->has('credit')){
                return new CreditPaymentGateway('euro');
            }else{
                return new BankPaymentGateway('euro');
            }
        });
    }
}
