<?php
class Product
{
    private $id;
    private $name;
    private $price;
    private $colors;
    private $image;
    private $description;

    protected function clearData($data)
    {
        $result = trim(stripslashes(strip_tags($data)));
        return $result;
    }

    public function __construct($name, $price, $colors, $image, $description)
    {
        $this->name = $this->clearData($name);
        $this->price = $this->clearData($price);
        $this->colors = $colors;
        $this->image = $this->clearData($image);
        $this->description = $this->clearData($description);
    }
//////////////// GETTERS    
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getColors()
    {
        return $this->colors;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getDescription()
    {
        return $this->description;
    }
//////////////// SETTERS 
    public function setId($id)
    {
        $this->id = $id;
    }  
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }  
    public function setColor($color)
    {
        $this->color = $color;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }    
    public function setDescription($description)
    {
        $this->description = $description;
    } 

}
