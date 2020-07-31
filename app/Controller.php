<?php
require_once "app/Dbh.php";
require_once "app/Product.php";
require_once "app/Auth.php";
require_once "app/Connector.php";

class Controller {
    protected $connector;
    protected $auth;

    public function __construct()
    {
      $this->auth = new Auth();
      $this->connector = new Connector();
    }

    //// return all products on index page
    public function index()
    {

      return $this->connector->getAllProducts();
    }

    public function product()
    {
      $id = $_GET['id'];

      return $this->connector->getProduct($id);
    }
    public function addInCart()
    {

      if($productId = $_POST['product_id']) {
        $color = $_POST['color'];
        if(isset($_COOKIE['cart'])) {
          $cartArr = json_decode($_COOKIE['cart'], true);
          $cartArr[] = ['productId' => $productId, 'color' => $color];
          $cart = json_encode($cartArr);
        } else {
          $cart = json_encode([['productId' => $productId, 'color' => $color]], true);
        }
        setcookie("cart", $cart);
        header("Location: product.php?id=$productId");
        die();
      }   
    }
    public function getCart()
    {
      if(isset($_COOKIE['cart'])) {
        return json_decode($_COOKIE['cart'], true);
      }
      return [];
    }
    public function prepareCheckout()
    {
      $productsId = $_POST['product_id'];
      $productsCount = $_POST['item_count'];
      $productsColors = $_POST['product_color']; 

      $objectsArr = Array();
      foreach($productsId as $id) {
        $objectsArr[] = $this->connector->getProduct($id);
      }
      
      $count = count($objectsArr);
      $result = Array();
      for($i = 0; $i < $count; $i++) {
        $result[$i]['product'] = $objectsArr[$i];
        $result[$i]['count'] = $productsCount[$i];
        $result[$i]['color'] = $productsColors[$i];
      }
      $date = date('Y-m-d H:i:s');
      $orderId = $this->connector->saveOrder($date);
      foreach($result as $item) {
        $productId = $item['product']->getId();
        $count = $item['count'];
        $color = $item['color'];
        $this->connector->saveOrderItems($orderId, $productId, $count, $color);
      }
      
      return ['items' => $result, 'orderId' => $orderId];
    }
    public function checkout()
    {

      $delivery = $_POST['delivery'];
      $orderId = $_POST['order_id'];
      $price = $_POST['total_price'];
      switch ($delivery) {
        case 'Office':
          if($this->connector->updateOrder($orderId, 'office', 'complete', $price)) {
            unset($_COOKIE['cart']);
            setcookie('cart', '', time() - 3600, '/');
            echo 'Success' . '<br>';
          } else {
            echo 'Failed' . '<br>';
          }
        break;
        case 'Omniva':
          $terminal = $_POST['omniva_select1'];
          if($this->connector->updateOrder($orderId, $terminal, 'complete', $price)) {
            unset($_COOKIE['cart']);
            setcookie('cart', '', time() - 3600, '/');
            echo 'Success' . '<br>';
          } else {
            echo 'Failed' . '<br>';
          }
        break;
      }
    }

    public function currentUser()
    {
      return $this->auth;
    }

    public function login()
    {
      global $message;
      $message ='';
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = $_POST['login'];
        $pass = $_POST['password'];
        $user = $this->connector->checkUser($login, $pass);
        if(!$user) {
          $message ='Wrong login or password!';
          return;
        }
        $this->auth->setUser($user['login'], $user['status']);
        header("Location: /");
        die();
      } 
    }

    public function orders()
    {
      if($this->auth->checkAdmin()) {
        return $this->connector->getAllOrders();
      } else {
        header("Location: /");
        die();        
      }
      
    }

    public function edit()
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['product_id'];
        $discription = $_POST['discription'];
        $price = $_POST['price'];
        $colors = $_POST['colors'];
        $colors = array_filter($colors, function($color) {
          return strlen($color) > 0;
        });

        if(strlen($_FILES["photo"]["name"]) > 0) {
          $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
          $filename = $_FILES["photo"]["name"];
          $filetype = $_FILES["photo"]["type"];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
          
          if(file_exists("upload/" . $filename)){
            echo $filename . " is already exists.";
          } else{
              move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . $filename);
              echo "Your file was uploaded successfully.";
          }

          $file = "images/" . $filename;

          } else {
            $file = $_POST['oldImage'];
          }
          $this->connector->editProduct($id, $discription, $price, $file, $colors);
          header("Location: /");
          die(); 
       }
       
     }

}