<?php
require_once "BaseDao.class.php";

class AddressDao extends BaseDao {

    public function __construct(){
        parent::__construct("addresses");
    }
}

?>