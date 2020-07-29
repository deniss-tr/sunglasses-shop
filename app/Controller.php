<?php
require_once "app/Dbh.php";
require_once "app/Product.php";
require_once "app/Connector.php";

class Controller {

    //// return all products on index page
    public function index()
    {
      $connector = new Connector();
      return $connector->getAllProducts();
    }

    public function product()
    {
      $id = $_GET['id'];
      $connector = new Connector();
      return $connector->getProduct($id);
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

}