<?php

require_once "BaseService.php";
require_once __DIR__."/../dao/ProductDao.class.php";

class ProductService extends BaseService {

    public function __construct() {
        parent::__construct(new ProductDao);
    }

    public function get_all_with_filters($category = null, $supplier = null, $order = null) {
        if ($category == null && $supplier == null && $order == null) {
            return $this->dao->get_all();
        } else if ($category != null && $supplier == null && $order == null) {
            return $this->dao->get_by_category_id($category);
        } else if ($category == null && $supplier != null && $order == null) {
            return $this->dao->get_by_supplier_id($supplier);
        } else if ($category == null && $supplier == null && $order != null) {
            if ($order == "asc") return $this->dao->get_by_price_asc();
            if ($order == "desc") return $this->dao->get_by_price_desc();
        } else if ($category != null && $supplier != null && $order == null) {
            return $this->dao->get_by_category_and_supplier($category, $supplier);
        } else if ($category == null && $supplier != null && $order != null) {
            if ($order == "asc") return $this->dao->get_by_supplier_and_price_asc($supplier);
            if ($order == "desc") return $this->dao->get_by_supplier_and_price_desc($supplier);
        } else if ($category != null && $supplier == null && $order != null) {
            if ($order == "asc") return $this->dao->get_by_category_and_price_asc($category);
            if ($order == "desc") return $this->dao->get_by_category_and_price_desc($category);
        } else {
            if ($order == "asc") return $this->dao->get_by_category_and_supplier_price_asc($category, $supplier);
            if ($order == "desc") return $this->dao->get_by_category_and_supplier_price_desc($category,$supplier);
        }
    }

    public function get_by_product_name($name) {
        return $this->dao->get_by_product_name($name);
    }

    public function get_by_category_id($category_id) {
        return $this->dao->get_by_category_id($category_id);
    }

    public function get_by_supplier_id($supplier_id) {
        return $this->dao->get_by_supplier_id($supplier_id);
    }

    public function get_by_price_asc() {
        return $this->dao->get_by_price_asc();
    }
    public function get_by_price_desc() {
        return $this->dao->get_by_price_desc();
    }

    public function get_by_category_and_supplier($category_id, $supplier_id) {
        return $this->dao->get_by_category_and_supplier($category_id, $supplier_id);
    }

    public function get_by_category_and_supplier_price_asc($category_id, $supplier_id) {
        return $this->dao->get_by_category_and_supplier_price_asc($category_id, $supplier_id);
    }

    public function get_by_category_and_supplier_price_desc($category_id, $supplier_id) {
        return $this->dao->get_by_category_and_supplier_price_desc($category_id, $supplier_id);
    }

    public function get_by_category_and_price_asc($category_id) {
        return $this->dao->get_by_category_and_price_asc($category_id);
    }

    public function get_by_category_and_price_desc($category_id) {
        return $this->dao->get_by_category_and_price_desc($category_id);
    }

    public function get_by_supplier_and_price_asc($supplier_id) {
        return $this->dao->get_by_supplier_and_price_asc($supplier_id);
    }

    public function get_by_supplier_and_price_desc($supplier_id) {
        return $this->dao->get_by_supplier_and_price_desc($supplier_id);
    }
}
?>