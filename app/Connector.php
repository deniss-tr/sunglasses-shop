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
    public function saveOrder($date)
    {
        $stmt = $this->connect()->prepare("INSERT INTO orders(status, date) VALUES(?, ?)");
        $stmt->execute(['waiting', $date]);
        $orderId = $this->connect()->lastInsertId();
        return $orderId;
    }
    public function saveOrderItems($orderId, $productId, $count, $color)
    {
        $stmt = $this->connect()->prepare("INSERT INTO orders_items(count, color, order_id, product_id) VALUES(?, ?, ?, ?)");
        return $stmt->execute([$count, $color, $orderId, $productId]);
    }
    public function updateOrder($orderId, $address, $status, $price)
    {
        $sql = "UPDATE orders SET status = '$status', address = '$address', price = '$price' WHERE id = $orderId";
        $data = $this->connect()->query($sql);
        return $data;
    }
    public function checkUser($login, $password)
    {
        $stmt = $this->connect()->prepare("SELECT login, status FROM users WHERE login = ? AND password = ?");
        $stmt->execute([$login, $password]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
    public function getAllOrders()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM orders");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;        
    }

    public function editProduct($id, $description, $price, $image, $colors)
    {
        ///// COLORS
        $sql = "PRAGMA table_info(colors)";
        $colorColumns = $this->connect()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $availableColors = Array();
        foreach($colorColumns as $column) {
            if($column['name'] == 'id') {
                continue;
            }
            $availableColors[] = $column['name'];
        }

        foreach($colors as $color) {
            if(!in_array($color, $availableColors) ) {
                $sql = "ALTER TABLE colors ADD $color INTEGER";
                $this->connect()->query($sql);    
            }
        }
        $colorsString = '(' . implode(', ', $colors) . ')';
        $colorValuesOnes = array_map(function($item) {
            return 1;
        }, $colors);
        $colorValuesString = '(' . implode(', ', $colorValuesOnes) . ')';

        $sql = "INSERT INTO colors $colorsString  VALUES $colorValuesString";
        $this->connect()->query($sql); 
        $colorId = $this->connect()->lastInsertId();
        ///// PRODUCT

        $sql = "UPDATE products
                SET description = '$description', price = $price, colors_id = $colorId, image = '$image'
                WHERE id = $id";
        $result = $this->connect()->query($sql);
        return $result;
    }
}



