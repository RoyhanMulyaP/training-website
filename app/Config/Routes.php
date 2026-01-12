<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\FilmController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'FilmController::index');

$routes->group('film', function ($routes) {
    $routes->get('/', 'FilmController::index');
    $routes->post('store', 'FilmController::store');
    $routes->get('get/(:num)', 'FilmController::get/$1');
    $routes->post('update/(:num)', 'FilmController::update/$1');
    $routes->delete('delete/(:num)', 'FilmController::delete/$1');
});
