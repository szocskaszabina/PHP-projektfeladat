<?php
require '../vendor/autoload.php';

use Project\Clothes\Clothes as Clothes;
use Project\TwigRenderer\TwigRenderer as TwigRenderer;
use Project\Clothes\Save\SaveController as Controller;
use Project\Database\SqlSaveClothes as SqlSaver;
use Project\Clothes\Lister\ListController as ListController;
use Project\Database\SqlSortClothes as SqlLister;
use Project\Clothes\ById\ByIdController as ByIdController;
use Project\Database\SqlClothesById as SqlByIdGetter;
use Project\Clothes\Update\UpdateController as UpdateController;
use Project\Database\SqlUpdateClothes as SqlUpdater;
use Project\Clothes\Deleter\DeleteController as DeleteController;
use Project\Database\SqlDeleteClothes as SqlDeleter;
use Project\Clothes\GetSum\Controller as SumController;
use Project\Database\SqlGetSum as SqlGetSum;
use Project\Clothes\GetDistinctValues\Controller as ValuesController;
use Project\Database\SqlGetDistinctValues as SqlGetValues;

$dispatcher = \FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    //Home
    $r->get('/', function ($vars) {
        try {
        echo (new TwigRenderer())->render('home.html', []);
        } catch (Error $err) {
            echo (new TwigRenderer())->render('error.twig', []);
        };
    });
    //Új termék form
    $r->get('/new', function ($vars) {
        try {
        echo (new TwigRenderer())->render('new-item.html', []);
        } catch (Error $err) {
            echo (new TwigRenderer())->render('error.twig', []);
        }
    });
    //Új termék mentése
    $r->post('/new',function ($vars, $body, $query)  {
        try {
            $item = (new Controller(new SqlSaver()))->saveItem($body);
            header('Location: /');
        } catch (Error $err) {
            echo (new TwigRenderer())->render('error.twig', []);
         };
    });
    //Listázó oldal
    $r->get('/clothes', function ($vars) {
        try {
            $names = (new ValuesController(new SqlGetValues()))->getValues('name');
            $sizes = (new ValuesController(new SqlGetValues()))->getValues('size');
            echo (new TwigRenderer())->render('search.twig', ['names' => $names, 'sizes' => $sizes]);
            } catch (Error $err) {
               echo (new TwigRenderer())->render('error.twig', []);
            };
    });
    //Termék részletei
    $r->get('/item/{id:\d+}', function ($vars, $body, $query) {
       try {
        
        $singleItem = (new ByIdController(new SqlByIdGetter()))->getById($vars['id']);
        echo (new TwigRenderer())->render('single.twig', ['clothes' => $singleItem]);

       } catch (Error $err) {
                echo (new TwigRenderer())->render('error.twig', []);
            };
    });
    //Termék update
    $r->post('/update-item/{id:\d+}', function ($vars, $body, $query) {
        try {
        (new UpdateController(new SqlUpdater()))->updateItem($body);
        header('Location: /clothes');
        } catch (Error $err) {
            echo (new TwigRenderer())->render('error.twig', []);
        };
        
     });
     //Termék törlése
     $r->post('/delete-item/{id:\d+}', function ($vars, $body, $query) {
         try {
        (new DeleteController(new SqlDeleter()))->deleteClothes($vars['id']);
        header('Location: /clothes');
         }
         catch (Error $err) {
            echo (new TwigRenderer())->render('error.twig', []);
        };
        
     });
     //Listázó oldalon termékek szűrése
    $r->get('/results', function ($vars, $body, $query) {
        try {
            $names = (new ValuesController(new SqlGetValues()))->getValues('name');
            $sizes = (new ValuesController(new SqlGetValues()))->getValues('size');
            $clothes = (new ListController(new SqlLister()))->getClothes($query);
            $match = count($clothes);
            echo (new TwigRenderer())->render('results.twig', ['array' => $clothes, 'query' => $query, 'match' => $match, 'names' => $names, 'sizes' => $sizes]);
            } catch (Error $err) {
                echo (new TwigRenderer())->render('error.twig', []);
            };
    });
    //Termékek árainak összege
    $r->get('/sum', function ($vars, $body, $query) {
        try {
        $sum = (new SumController(new SqlGetSum()))->getSum();
        echo (new TwigRenderer())->render('sum.twig', ['sum' => $sum[0]]);
        } catch (Error $err) {
            echo (new TwigRenderer())->render('error.twig', []);
        };
    });

});


// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404";
        http_response_code(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "Method not allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        call_user_func($handler, $vars, $_POST, $_GET);

        break;
}

