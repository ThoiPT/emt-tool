<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\EmailGroupController;
use App\Admin\Controllers\EmailCustomerController;
use App\Jobs\SendMailJob;
use App\Admin\Controllers\EmailTemplateController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('email-groups', EmailGroupController::class);
    $router->resource('email-customers', EmailCustomerController::class);
    $router->resource('email-templates', EmailTemplateController::class);

    $router->get('/send-mail-by-template/{id}', [EmailGroupController::class,'sendMailByTemplate'])->name('send-mail-by-template');

    // $router->get('send/email', function(){

    //     $send_mail = 'lephatloc2016@gmail.com';

    //     dispatch(new SendMailJob($send_mail));

    //     dd('send mail successfully !!');
    // });
});
