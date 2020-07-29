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
    public function prepareCheckout()
    {
      $productsId = $_POST['product_id'];
      $productsCount = $_POST['item_count'];
      $productsColors = $_POST['product_color']; 

      $connector = new Connector();
      $objectsArr = Array();
      foreach($productsId as $id) {
        $objectsArr[] = $connector->getProduct($id);
      }
      
      $count = count($objectsArr);
      $result = Array();
      for($i = 0; $i < $count; $i++) {
        $result[$i]['product'] = $objectsArr[$i];
        $result[$i]['count'] = $productsCount[$i];
        $result[$i]['color'] = $productsColors[$i];
      }
      $date = date('Y-m-d H:i:s');
      $orderId = $connector->saveOrder($date);
      foreach($result as $item) {
        $productId = $item['product']->getId();
        $count = $item['count'];
        $color = $item['color'];
        $connector->saveOrderItems($orderId, $productId, $count, $color);
      }
      
      return ['items' => $result, 'orderId' => $orderId];
    }
    public function checkout()
    {
      $connector = new Connector();
      $delivery = $_POST['delivery'];
      $orderId = $_POST['order_id'];
      $price = $_POST['total_price'];
      switch ($delivery) {
        case 'Office':
          if($connector->updateOrder($orderId, 'office', 'complete', $price)) {
            unset($_COOKIE['cart']);
            setcookie('cart', '', time() - 3600, '/');
            echo 'Success' . '<br>';
          } else {
            echo 'Failed' . '<br>';
          }
        break;
        case 'Omniva':
          $terminal = $_POST['omniva_select1'];
          if($connector->updateOrder($orderId, $terminal, 'complete', $price)) {
            unset($_COOKIE['cart']);
            setcookie('cart', '', time() - 3600, '/');
            echo 'Success' . '<br>';
          } else {
            echo 'Failed' . '<br>';
          }
        break;

      }
    }
}