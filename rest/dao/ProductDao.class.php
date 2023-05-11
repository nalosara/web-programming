<?php
require_once "BaseDao.class.php";

class ProductDao extends BaseDao {

    public function __construct(){
        parent::__construct("products");
    }
}

?>