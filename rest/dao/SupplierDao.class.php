<?php

require_once  "BaseDao.class.php";

class SupplierDao extends BaseDao{

    public function __construct(){
        parent::__construct("suppliers");
    }
}

?>