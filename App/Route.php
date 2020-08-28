<?php 

namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap {

    protected function initRoutes(){

        $routes['index'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['salvarArquivo'] = array(
            'route' => '/salvarArquivo',
            'controller' => 'indexController',
            'action' => 'salvarArquivo'
        );

        $routes['salvarDB'] = array(
            'route' => '/salvarDB',
            'controller' => 'indexController',
            'action' => 'salvarDB'
        );

        $routes['getAll'] = array(
            'route' => '/getAll',
            'controller' => 'indexController',
            'action' => 'getAll'
        );

        $this->setRoutes($routes);
    }

}

?>