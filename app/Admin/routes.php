<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('/topics', 'TopicsController');

    $router->resource('ancai_courses', AncaiCoursesController::class);

    $router->get('get_ancai_catalogs', 'AncaiCatalogsController@getCatalogs')->name('ancai_catalogs.getCatalogs');
    $router->resource('ancai_catalogs', AncaiCatalogsController::class);

    $router->resource('ancai_articles', AncaiArticlesController::class);

});
