<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\Controller;
use Psr\Http\Message\ResponseInterface;
use PDO;
class HomeController extends Controller
{
   
    public function index():ResponseInterface
    {   
        return $this->render("home/index");
    }
}
