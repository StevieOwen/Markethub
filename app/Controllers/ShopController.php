<?php

declare(strict_types=1);

namespace App\Controllers;
use Framework\Controller;
use Psr\Http\Message\ResponseInterface;
use PDO;

class ShopController extends Controller{

    public function shopcreationform():ResponseInterface
    { 
       
        return $this->render("shop/registerShop");
        
    }
    public function renderDashboard():ResponseInterface
    {
        return $this->render("shop/dashboard");
    }

    public function shopregistrationprocess()
    {
        //since we are using formData in javascript, here we get the data from $_POST

        $pdo = \App\Framework\DB::getConnection();
        $shop=["shop_id"=>"","shop_name"=>"","shop_description"=>"","shop_owner"=>"","shop_logo"=>"","shop_contact"=>""];
        
        $shop['shop_name']=$_POST['name'] ?? [];
        $shop['shop_description']=$_POST['description'] ?? [];
        $shop['shop_contact']=$_POST['shopcontact'] ?? [];
        $shop['shop_owner']=$_POST['seller'] ?? [];
        $shop['shop_id']="shop_". random_int(100000, 999999) ;

        //handle logo
        $logoPath = null;
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = dirname(APPROOT). "/Public/uploads/logos/";
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = $shop["shop_id"] . "_" . basename($_FILES['logo']['name']);
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFilePath)) {
                $logoPath = $targetFilePath; 
            }
            $shop['shop_logo']=$fileName;
        }        

        $stm="INSERT INTO shop(shop_id,shop_name,shop_description,shop_owner,shop_logo,shop_contact) 
                       VALUES(:shop_id,:shop_name,:shop_description,:shop_owner,:shop_logo,:shop_contact)";
                $stmt=$pdo->prepare($stm);    
                try{
                    $stmt->execute($shop);
                    $hasshop="yes";
                    $stm1="UPDATE customer set cust_hasshop=:hasshop where cust_id=:id";
                    $stmt1=$pdo->prepare($stm1); 
                    $stmt1->execute([":hasshop"=>$hasshop,":id"=> $shop['shop_owner']]);
                    echo json_encode(["status"=>"Successfully created"]);
                    exit;
                }catch (\PDOException $e) {
                    $dber=   $e->getMessage();
                     echo json_encode(["status"=>$e]);
                    exit;
                }    
    

    }


    function renderShopInfos(){
        $pdo = \App\Framework\DB::getConnection();
        $json = file_get_contents('php://input');
        // 2. Decode it into a PHP array
        $data = json_decode($json, true);
        $customer = $data['id'];
        $shop=["shop_owner"=>"","shop_name"=>"","shop_logo"=>"","shop_description"=>"","shop_contact"=>""];

        $stmt = $pdo->prepare("SELECT cust_firstname, shop_name, shop_logo, shop_description, shop_contact from customer join shop on customer.cust_id=shop.shop_owner where cust_id=:cust_id");
                $stmt->execute(['cust_id' => $customer]);
                $shop = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if(!$shop){
                    echo json_encode("Errors, you don't have a shop, please create first one");
                    exit;
                }else{
                    echo json_encode(["shop"=>$shop]);
                    exit;
                }
    }


}