<?php

require_once "BaseServices.php";
require_once __DIR__."/../dao/ProductDao.class.php";

class ProductService extends BaseServices {
    public function __construct() {
        parent::__construct(new ProductDao);
    }
}
?>