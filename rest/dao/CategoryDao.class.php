<?php

require_once  "BaseDao.class.php";

class CategoryDao extends BaseDao{

    public function __construct(){
        parent::__construct("categories");
    }
}

?>