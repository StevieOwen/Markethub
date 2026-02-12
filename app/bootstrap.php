<?php

declare(strict_types=1);
ini_set("display_errors",1);
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
define('URLROOT', $_ENV['URL_ROOT']);
define('SITENAME', $_ENV['APP_NAME']);

use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthenticationController;
use Framework\Template\PlatesRenderer;
use Framework\Template\RendererInterface;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\ResponseFactoryInterface;
use League\Route\Strategy\ApplicationStrategy;



    ini_set("display_errors",1);

    require dirname(__DIR__)."/vendor/autoload.php";

    $request=ServerRequest::fromGlobals();
    $builder=new DI\ContainerBuilder;
    $builder->addDefinitions(
        [ResponseFactoryInterface::class=>DI\create(HttpFactory::class),
         RendererInterface::class=>DI\create(PlatesRenderer::class)
        
        ]
    );
    
    $builder->useAttributes(true);    
    $container=$builder->build();
    
    $router=new Router;
    $strategy=new ApplicationStrategy;
    $strategy->setContainer($container);
    $router->setStrategy($strategy);

    $router->get("/",[HomeController::class,"index"]);

    $router->get("/register",[AuthenticationController::class,"register"]);

    $router->get("/login",[AuthenticationController::class,"login"]);
    $router->get("/recover", [AuthenticationController::class,"recover"]);
    $router->get("/emailverify", [AuthenticationController::class,"emailverification"]);


    $response=$router->dispatch($request);           

    $emitter=new SapiEmitter();

    $emitter->emit($response);


