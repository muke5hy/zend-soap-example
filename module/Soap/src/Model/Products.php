<?php
namespace Soap\Model;

class Products
{
    public $id;
    public $title;
    public $shortdesc;
    public $price;
    public $quantity;

    public function exchangeArray($data)
    {
        $this->id           = (!empty($data['id'])) ? $data['id'] : null;
        $this->shortdesc    = (!empty($data['shortdesc'])) ? $data['shortdesc'] : null;
        $this->title        = (!empty($data['title'])) ? $data['title'] : null;
        $this->price        = (!empty($data['price'])) ? $data['price'] : null;
        $this->quantity     = (!empty($data['quantity'])) ? $data['quantity'] : null;
    }
}
