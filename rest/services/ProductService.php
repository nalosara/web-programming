<?php

require_once "BaseService.php";
require_once __DIR__."/../dao/ProductDao.class.php";

class ProductService extends BaseService {
    private $categoryService;
    private $supplierService; 

    public function __construct() {
        parent::__construct(new ProductDao);
        $this->categoryService = new CategoryService();
        $this->supplierService = new SupplierService();
    }

    public function get_all_with_filters($category = null, $supplier = null, $order = null) {
        $categoryId = $this->categoryService->get_category_by_name($category)['id'];
        $supplierId = $this->supplierService->get_supplier_by_name($supplier)['id'];

        if ($category == null && $supplier == null && $order == null) {
            return $this->dao->get_all();
        } else if ($category != null && $supplier == null && $order == null) {
            return $this->dao->get_by_category_id($categoryId);
        } else if ($category == null && $supplier != null && $order == null) {
            return $this->dao->get_by_supplier_id($supplierId);
        } else if ($category == null && $supplier == null && $order != null) {
            if ($order == "asc") return $this->dao->get_by_price_asc();
            if ($order == "desc") return $this->dao->get_by_price_desc();
        } else if ($category != null && $supplier != null && $order == null) {
            return $this->dao->get_by_category_and_supplier($categoryId, $supplierId);
        } else if ($category == null && $supplier != null && $order != null) {
            if ($order == "asc") return $this->dao->get_by_supplier_and_price_asc($supplierId);
            if ($order == "desc") return $this->dao->get_by_supplier_and_price_desc($supplierId);
        } else if ($category != null && $supplier == null && $order != null) {
            if ($order == "asc") return $this->dao->get_by_category_and_price_asc($categoryId);
            if ($order == "desc") return $this->dao->get_by_category_and_price_desc($categoryId);
        } else {
            if ($order == "asc") return $this->dao->get_by_category_and_supplier_price_asc($categoryId, $supplierId);
            if ($order == "desc") return $this->dao->get_by_category_and_supplier_price_desc($categoryId,$supplierId);
        }
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