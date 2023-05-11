<?php

require_once "BaseService.php";
require_once __DIR__."/../dao/SupplierDao.class.php";

class SupplierService extends BaseService {
    public function __construct() {
        parent::__construct(new SupplierDao);
    }
}
?>