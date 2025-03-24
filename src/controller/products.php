<?php

class ControllerProduct
{
    private $connexion;
    private $product;

    public function __construct($connexion, Products $product)
    {
        $this->connexion = $connexion;
        $this->product = $product;
    }

    public function getCount()
    {
        $product = $this->product;
        return $product->getCount();
    }

    public function getAll($offset, $limit)
    {
        $product = $this->product;
        return $product->getAllQ("es", $offset, $limit);
    }
}
