<?php

require_once "BaseServices.php";
require_once __DIR__."/../dao/OrderDao.class.php";

class OrderService extends BaseServices {
    public function __construct() {
        parent::__construct(new OrderDao);
    }
}
?>