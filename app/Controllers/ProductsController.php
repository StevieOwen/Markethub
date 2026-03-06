<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\Controller;
use Psr\Http\Message\ResponseInterface;
use PDO;

class ProductsController extends Controller
{
    // public function index1():ResponseInterface
    // {   
    //     return $this->render("home/index1");
    // }

    public function addProduct()
    {   
        $dber="";
        //since we are using formData in javascript, here we get the data from $_POST
        $pdo = \App\Framework\DB::getConnection();
        $labels=["item_id","item_name","item_price","item_quantity",
                  "item_seller","item_brand","item_category",
                "item_material","item_size","item_forgender","item_description"];

        $items=["item_id"=>"","item_name"=>"","item_price"=>"","item_quantity"=>"",
                "item_seller"=>"","item_brand"=>"","item_category"=>"",
                "item_material"=>"","item_size"=>"","item_forgender"=>"","item_description"=>""];

        $images=["img_id"=>"","img_name"=>"","item_id"=>""];

        $publications=["publication_id"=>"","item_id"=>"","seller_id"=>"","img_id"=>""];

        foreach($labels as $label){
            if ($label!="item_image" || $label!="'item_id'"){
                $items[$label]=$_POST[$label] ?? "";
            }
            
        }
        
        $images['img_id']="img_".random_int(100000, 999999);
        $items['item_id']="item_".random_int(100000, 999999);
        $images['item_id']=$items['item_id'];
        $publications['publication_id']="pub_".random_int(100000, 999999);;
        $publications['item_id']=$items['item_id'];
        $publications['seller_id']=$items['item_seller'];
        $publications['img_id']= $images['img_id'];

        //handle shop image
        $imagePath = null;
        if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = dirname(APPROOT). "/Public/uploads/items/";
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = $items["item_id"] . "_" . basename($_FILES['item_image']['name']);
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['item_image']['tmp_name'], $targetFilePath)) {
                $imagePath = $targetFilePath; 
            }
            $images['img_name']=$fileName;
        }     
            
        //inserting the item in the database
         $stm="INSERT INTO item(item_id, item_name, item_price, item_quantity, item_seller, item_brand, item_category, item_material, item_size, item_forgender, item_description, item_createdat ) 
                VALUES(:item_id, :item_name, :item_price, :item_quantity, :item_seller, :item_brand, :item_category, :item_material, :item_size, :item_forgender, :item_description,Now())";
         $stmt=$pdo->prepare($stm);    
         $stm1=" INSERT INTO image(img_id,img_name,item_id) values(:img_id,:img_name,:item_id) ";
         $stmt1=$pdo->prepare($stm1);

         $stm2=" INSERT INTO publication(publication_id,item_id, seller_id, img_id, publication_createdat) values(:publication_id,:item_id, :seller_id, :img_id, Now()) ";
         $stmt2=$pdo->prepare($stm2);

            try{
                $stmt->execute($items);
                $stmt1->execute($images);
                $stmt2->execute($publications);

                echo json_encode(["status"=>"Successfully added"]);
                exit;
                
            }catch (\PDOException $e) {
                global $dber;
                $dber=   $e->getMessage();
                    echo json_encode(["status"=>$e]);
                exit;
            }  
        
                 
    }


    public function renderProducts(){
        $pdo = \App\Framework\DB::getConnection();
        
        $stm=$pdo->prepare(" SELECT item_name,img_name, item.item_id, cust_firstname, item_category, item_price, item_quantity, item_status from item
               join customer on customer.cust_id=item.item_seller join image on image.item_id=item.item_id order by item_name");

        $stm->execute();
        $items= $stm->fetchAll(PDO::FETCH_ASSOC);

        if(!$items){
                    echo json_encode("nothing found");
                    exit;
                }else{
                    echo json_encode(["items"=>$items]);
                    exit;
        }

    }

    public function deleteProduct(){
        $pdo = \App\Framework\DB::getConnection();

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $item_id = $data['item_id'];

        $stm=$pdo->prepare("DELETE from `image` where item_id=:item_id");
        
        $stm1=$pdo->prepare("DELETE from item where item_id=:item_id");

        $stm2=$pdo->prepare("DELETE from publication where item_id=:item_id");

        try{
                    
            $stm2->execute(["item_id"=>$item_id]);
            $stm->execute(["item_id"=>$item_id]);       
            $stm1->execute(["item_id"=>$item_id]);

            echo json_encode(["status"=>"Successfully delete"]);
            exit;
                    
        }catch (\PDOException $e) {
            global $dber;
            $dber=   $e->getMessage();
                echo json_encode(["status"=>$e]);
            exit;
        }  
    }

    public function renderedit():ResponseInterface{
        return $this->render("shop/editProduct");
    }

    public function showProductEdit(){
        $pdo = \App\Framework\DB::getConnection();

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $item_id = $data['item_id'];

        $stm=$pdo->prepare(" SELECT item_name,img_name, item_brand, item_material, item_description, item_category, item_price, item_quantity, item_status from item
               join  image on image.item_id=item.item_id where item.item_id=:item_id");

        $stm->execute(["item_id"=>$item_id]);
        $item= $stm->fetch();

        if(!$item){
                    echo json_encode("nothing found");
                    exit;
                }else{
                    echo json_encode(["item"=>$item]);
                    exit;
        }
    }


    public function editProduct(){
        //since we are using formData in javascript, here we get the data from $_POST
        $pdo = \App\Framework\DB::getConnection();
        $labels=["item_id","item_name","item_price","item_quantity",
                 "item_brand","item_category",
                "item_material","item_size","item_forgender","item_description"];

        $items=["item_id"=>"","item_name"=>"","item_price"=>"","item_quantity"=>"",
                "item_brand"=>"","item_category"=>"",
                "item_material"=>"","item_size"=>"","item_forgender"=>"","item_description"=>""];

        $images=["img_id"=>"","img_name"=>"","item_id"=>""];

        
        foreach($labels as $label){
            if ($label!="item_image"){
                $items[$label]=$_POST[$label] ?? "";
            }
            
        }

        $imagePath = null;
        if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = dirname(APPROOT). "/Public/uploads/items/";
            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = $items["item_id"] . "_" . basename($_FILES['item_image']['name']);
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['item_image']['tmp_name'], $targetFilePath)) {
                $imagePath = $targetFilePath; 
            }
            $images['img_name']=$fileName;
        }     


        $stm="UPDATE item set  item_name=:item_name, item_price=:item_price, item_quantity=:item_quantity, item_brand=:item_brand, item_category=:item_category, item_material=:item_material, item_size=:item_size, item_forgender=:item_forgender, item_description=:item_description, item_createdat=Now() where item_id=:item_id ";
        $stmt=$pdo->prepare($stm); 
           
        $stm1=" UPDATE image set img_name=:img_name where item_id=:item_id";
        $stmt1=$pdo->prepare($stm1);
        
        try{        

            $stmt->execute($items);       
            $stmt1->execute(["img_name"=>$images['img_name'],"item_id"=>$items["item_id"]] );

            echo json_encode(["status"=>"Successfully edited"]);
            exit;
                    
        }catch (\PDOException $e) {
            global $dber;
            $dber=   $e->getMessage();
                echo json_encode(["status"=>$e]);
            exit;
        }  

    }

    public function checkshop(){
        $pdo = \App\Framework\DB::getConnection();

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $cust_id = $data['cust_id'];

        $stm=$pdo->prepare(" SELECT cust_hasshop from customer where cust_id=:cust_id");

        $stm->execute(["cust_id"=>$cust_id]);
        $hasshop= $stm->fetch();

        if(!$hasshop){
                    echo json_encode("nothing found");
                    exit;
                }else{
                    echo json_encode(["hasshop"=>$hasshop]);
                    exit;
        }
    }

}