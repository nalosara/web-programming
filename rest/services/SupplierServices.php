<?php

require_once "BaseServices.php";
require_once __DIR__."/../dao/SupplierDao.class.php";

class SupplierService extends BaseServices {
    public function __construct() {
        parent::__construct(new SupplierDao);
    }
}
?>