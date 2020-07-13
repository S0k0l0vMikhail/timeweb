<?php

namespace App\Core;

/**
 * Класс маршрутизации
 */
class Router
{

  public static function Start()
  {
    $controller = 'index';
    $action = 'index';
    $routes = explode('/', $_SERVER['REQUEST_URI']);
    $params = null;

    // имя класса контроллера
    if (!empty($routes[1])) {
        $controller = $routes[1];
    }

    //имя метода
    if (!empty($routes[2])) {
        $action = $routes[2];
    }

    $controller = 'App\Controllers\\' . ucfirst(strtolower($controller)) . 'Controller';
    $action = strtolower($action) . 'Action';

    if (!class_exists($controller)) {
        echo 'Класс не найден';
        return;
    }

    if (!method_exists($controller,$action)) {
        echo 'Метод не найден';
        return;
    }

    $controller = new $controller();
    $controller->$action($params);
  }
}
