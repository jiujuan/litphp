<?php

use FastRoute\RouteCollector;

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->get("/hello", function () {
        echo "hello world";
    });
    $r->get('/', 'IndexController@Index');
    $r->get("/user/{name}", 'IndexController@Index');
    $r->get("/article", 'IndexController@getArticle');
    $r->get("/getTpl", 'TplDemoController@getTpl');
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:  //找不到路由
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];   //请求不同
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:  //找到路由
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        if ($handler instanceof Closure) {
            $handler();
        } else {
            $segments = explode("@", $handler);
            $className = NS_APP_CONTROLLERS . ($segments[0]);
            $controller = new $className;
            $controller->{$segments[1]}();
        }

        // ... call $handler with $vars
        break;
}
