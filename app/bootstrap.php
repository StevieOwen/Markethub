<?php

declare(strict_types=1);
ini_set("display_errors",1);
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
define('URLROOT', $_ENV['URL_ROOT']);
define('SITENAME', $_ENV['APP_NAME']);
define('APPROOT', dirname(__FILE__));

use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthenticationController;
use App\Controllers\ShopController;
use App\Controllers\ProductsController;
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

    // Home controller route
    $router->get("/",[HomeController::class,"index"]);

    $router->get("/logout",[HomeController::class,"logout"]);
    $router->post("/logout",[HomeController::class,"logout"]);

    $router->get("/category",[HomeController::class,"category"]);
    $router->get("/categoryfilter",[HomeController::class,"filtercategory"]);
    $router->post("/categoryfilter",[HomeController::class,"filtercategory"]);
    // Authentication routes
    $router->get("/register",[AuthenticationController::class,"register"]);

    $router->get("/login",[AuthenticationController::class,"login"]);
    $router->get("/recoverpassword", [AuthenticationController::class,"recover"]);
    $router->get("/emailverify", [AuthenticationController::class,"emailverification"]);
    $router->get("/registration_process",[AuthenticationController::class,"registration_handling"]);
    $router->post("/registration_process",[AuthenticationController::class,"registration_handling"]);

    $router->get("/emailverification_process",[AuthenticationController::class,"emailverificationhandling"]);
    $router->post("/emailverification_process",[AuthenticationController::class,"emailverificationhandling"]);

    $router->get("/loginprocess",[AuthenticationController::class,"loginhandling"]);
    $router->post("/loginprocess",[AuthenticationController::class,"loginhandling"]);

    $router->get("/user_home",[AuthenticationController::class,"userindex"]);
    $router->get("/home_usershop",[AuthenticationController::class,"userwithshopindex"]);
    $router->get("/passwordrecovery",[AuthenticationController::class,"passwordrecovery"]);
    $router->post("/passwordrecovery",[AuthenticationController::class,"passwordrecovery"]);

    $router->get("/verificationemail",[AuthenticationController::class,"verificationemail"]);
    $router->post("/verificationemail",[AuthenticationController::class,"verificationemail"]);
    
    $router->get("/changepassword",[AuthenticationController::class,"changepassword"]);
    $router->post("/changepassword",[AuthenticationController::class,"changepassword"]);

    $router->get("/shopregistrationform",[ShopController::class,"shopcreationform"]);

    $router->post("/registerShop",[ShopController::class,"shopregistrationprocess"]);
    $router->get("/registerShop",[ShopController::class,"shopregistrationprocess"]);

    $router->get("/dashboard",[ShopController::class,"renderDashboard"]);

    $router->post("/renderShopInfos",[ShopController::class,"renderShopInfos"]);
    $router->get("/renderShopInfos",[ShopController::class,"renderShopInfos"]);

    $router->post("/addProduct",[ProductsController::class,"addProduct"]);
    $router->get("/addProduct",[ProductsController::class,"addProduct"]);

    $router->post("/renderproducts",[ProductsController::class,"renderProducts"]);
    $router->get("/renderproducts",[ProductsController::class,"renderProducts"]);

    $router->post("/deleteProduct",[ProductsController::class,"deleteProduct"]);
    $router->get("/deleteProduct",[ProductsController::class,"deleteProduct"]);

    $router->post("/editProduct",[ProductsController::class,"editProduct"]);
    $router->get("/editProduct",[ProductsController::class,"editProduct"]);

    $router->post("/showProductEdit",[ProductsController::class,"showProductEdit"]);
    $router->get("/showProductEdit",[ProductsController::class,"showProductEdit"]);

    $router->post("/checkshop",[ProductsController::class,"checkshop"]);
    $router->get("/checkshop",[ProductsController::class,"checkshop"]);


    $router->get("/renderedit",[ProductsController::class,"renderedit"]);

    try {
        $response=$router->dispatch($request);           
    } catch (Exception $e) {
    http_response_code(405);
    // $response = $response->withHeader('Allow', implode(', ', $e->getAllowedMethods()));
    var_dump($e);
    }
    $emitter=new SapiEmitter();

    $emitter->emit($response);


