<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
$routes->group('admin', function ($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('products', 'DashboardController::productsIndex');
    $routes->post('products/create', 'ProductController::create');
    $routes->post('products/update', 'ProductController::update');
    $routes->get('products/delete/(:num)', 'ProductController::delete/$1');

    $routes->get('companies', 'DashboardController::companiesIndex');
    $routes->post('companies/create', 'CompanyController::create');
    $routes->post('companies/update', 'CompanyController::update');
    $routes->get('companies/delete/(:num)', 'CompanyController::delete/$1');
    
    $routes->get('invoices', 'DashboardController::invoicesIndex');
    $routes->post('invoices/create', 'InvoiceController::create');
    $routes->get('invoices/detail/(:num)', 'InvoiceController::getById/$1');
    $routes->get('invoices/delete/(:num)', 'InvoiceController::delete/$1');
});
