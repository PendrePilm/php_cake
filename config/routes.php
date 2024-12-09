<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
        $builder->connect('/pages/*', 'Pages::display');
        $builder->connect('/menus', ['controller' => 'Menus', 'action' => 'index']);
        $builder->connect('/menus/add', ['controller' => 'Menus', 'action' => 'add']);
        $builder->connect('/menus/edit/:id', ['controller' => 'Menus', 'action' => 'edit'], ['pass' => ['id'], 'id' => '\d+']);
        $builder->connect('/menus/view/:id', ['controller' => 'Menus', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
        $builder->connect('/menus/delete/:id', ['controller' => 'Menus', 'action' => 'delete'], ['pass' => ['id'], 'id' => '\d+']);
        $builder->connect('/menus/update-order', ['controller' => 'Menus', 'action' => 'updateOrder']);
        $builder->fallbacks();
    });
};
