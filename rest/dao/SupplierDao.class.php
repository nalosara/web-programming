<?php

require_once  "BaseDao.class.php";

class SupplierDao extends BaseDao{

    public function __construct(){
        parent::__construct("suppliers");
    }

    public function get_supplier_by_name($supplierName) {
        return $this->dao->query("SELECT * FROM suppliers WHERE name=".$supplierName);
    }
}

?>