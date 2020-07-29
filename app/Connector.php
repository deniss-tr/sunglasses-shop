<?php

class Connector extends Dbh {
    ////////////////////////////////////////////////////////////////////
    // createObjects return array of objects
    ////////////////////////////////////////////////////////////////////
    private function createObjects($array)
    {
        $result = Array();
        foreach($array as $item) {
            // create a separate objects
            $product = new Product($item['name'], $item['price'], $item['colors'], $item['image'], $item['description']);
            $product->setId($item['id']);
            $result[] = $product;
        }
        return $result;
    }

    private function connectTables($products) 
    {
        $fullProducts = array_map(function($product){
            $id = $product['colors_id'];
            $sql = "SELECT * FROM colors WHERE $id = id";
            $colors = $this->connect()->query($sql)->fetch(PDO::FETCH_ASSOC); 
            $colors = array_filter($colors, function($color, $key) {
                if($color != null and $key != 'id') {
                    return $color;
                }
            }, ARRAY_FILTER_USE_BOTH);
            $colorsArr = Array();
            foreach($colors as $color => $bool) {
                $colorsArr[] = $color;
            }
            $product['colors'] = $colorsArr;
            return $product;
        }, $products);
        return $fullProducts;
    }
    public function getAllProducts()
    {  
        $sql = "SELECT * FROM products";
        $products = $this->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $fullProducts = $this->connectTables($products);
        
        $result = $this->createObjects($fullProducts);
        return array_reverse($result); 
    }

    public function getProduct($id)
    {
        $sql = "SELECT * FROM products WHERE $id = id";
        $data = $this->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $fullProduct = $this->connectTables($data);
        $result = $this->createObjects($fullProduct);
        return $result[0];
    }
}