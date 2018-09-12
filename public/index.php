<?php

chdir(dirname(__DIR__));

if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

require_once 'MyCode/autoload.php';

$route = $_SERVER['REQUEST_URI'];

MyCode\Core\Router::createRoute("/do", function() {
    $p = new \MyCode\Core\HelloWorld();
    $p->doSomething();
});
MyCode\Core\Router::createRoute("/else", function() {
    $p = new \MyCode\Core\HelloWorld();
    $p->doSomethingElse();
});
MyCode\Core\Router::createRoute("/autor", function() {
    echo "by: Pedro Henrique Masato Enju";
});
MyCode\Core\Router::createRoute("/zero", function() {

    $conn = MyCode\Services\Singleton::getInstance()->getPDO();
    
    $dao = new MyCode\Dao\DaoUser($conn);
    $dao->getAllUsers();
    
    echo "Everbody!!!";
});

MyCode\Core\Router::executeRoute($route);


require_once 'MyApp/autoload.php';
  $rota = $_SERVER['REQUEST_URI'];
 
  MyApp\Core\Router::createRoute("/doo", function(){
      $f = new MyApp\Core\HelloWorld();
      $f->doSomething();
  });
  
  MyApp\Core\Router::createRoute("/elsee", function(){
      $f = new MyApp\Core\HelloWorld();
      $f->doSomethingElse();
  });
  
  MyApp\Core\Router::createRoute("/blah", function(){
      echo "Oi eu sou outra rota!";
  });
  
  MyApp\Core\Router::createRoute("/", function(){
      
    $conn = \MyApp\Services\Singleton::getInstance()->getPdo();
      
      $dao = new MyApp\Dao\DaoUser($conn);
      $dao->getAllUsers();
      echo "Wellcome";
  });
  
  MyApp\Core\Router::executeRoute($rota);
