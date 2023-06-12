<?php

require_once  "BaseDao.class.php";

class CartDao extends BaseDao{

    public function __construct(){
        parent::__construct("carts");
    }

    public function get_by_user_id($user_id) {
        return $this->query("SELECT * FROM carts WHERE user_id=:user_id", ['user_id' => $user_id]);
    
    }

    public function delete_by_user_id($user_id) {
        return $this->query("DELETE FROM carts WHERE user_id=:user_id", ['user_id' => $user_id]);
    }

    public function delete_by_user_and_product($user_id, $product_id) {
        return $this->query("DELETE FROM carts WHERE user_id=:user_id" . 
                            " AND product_id=:product_id", ['user_id' => $user_id, 'product_id' => $product_id]);
    }

    public function delete_by_product_id($product_id) {
        return $this->query("DELETE FROM carts WHERE product_id=:product_id",['product_id' => $product_id]);
    }
}

?>