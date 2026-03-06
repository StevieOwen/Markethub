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

    public function logout():ResponseInterface
    { 
        if(isset($_POST['logout'])){
            
            // 1. You must start or resume the session to access it
            session_start();

            // 2. Unset all session variables
            $_SESSION[]= array();

            // 3. If you want to kill the session, also delete the session cookie.
            // This is often overlooked but important for security.
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // 4. Finally, destroy the session on the server
            session_destroy();

            // 5. Redirect the user to the login or home page
            return $this->render("Auth/login");
            exit;
        }
        
        return $this->render("Auth/login");
    }
    public function category(){
        $pdo = \App\Framework\DB::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM category order by cat_name");
        $query = $_GET['query'] ?? '';
            try{
                $stmt->execute();

            }catch(\PDOException $e){
                $err=$e->getMessage();
                exit;
            }  

            $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(["category"=>$category]);
            exit;
    }

    public function filtercategory()
    {
        $json = file_get_contents('php://input');
        // 2. Decode it into a PHP array
        $data = json_decode($json, true);

        $categories = $data['categories'];
        $categoryList = "'" . implode("', '", $categories) . "'";

        $pdo = \App\Framework\DB::getConnection();
        $stmt = $pdo->prepare(" SELECT img_name, item_name, item_price, 
                               item_seller from publication join item on 
                               publication.item_id=item.item_id join customer 
                               on publication.seller_id=customer.cust_id join image 
                               on publication.img_id=image.img_id where item_category in ($categoryList) ");
         try{
                $stmt->execute();

            }catch(\PDOException $e){
                $err=$e->getMessage();
                exit;
            }  
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

             echo json_encode(["category"=>$items]);
            exit;
    }
}
