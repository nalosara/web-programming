<?php

require_once  "BaseDao.class.php";

class OrderDao extends BaseDao{

    public function __construct(){
        parent::__construct("orders");
    }
}

?>