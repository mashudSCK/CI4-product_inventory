<?php   
namespace Config;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// CRUD routes for ProductController
$routes->get('/', 'ProductController::index');
$routes->get('products', 'ProductController::index');
$routes->post('products/update/(:num)', 'ProductController::update/$1');
$routes->post('products/bulk_action', 'ProductController::bulk_action');
$routes->get('products/delete/(:num)', 'ProductController::delete/$1');
$routes->post('products/create', 'ProductController::create');


