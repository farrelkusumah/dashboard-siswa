<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/siswa', 'Siswa::index');
$routes->post('/siswa/create', 'Siswa::create');
$routes->post('/siswa/update/(:num)', 'Siswa::update/$1');
    