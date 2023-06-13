<?php
require_once "BaseDao.class.php";

class AddressDao extends BaseDao {

    public function __construct(){
        parent::__construct("addresses");
    }

    public function get_address_by_user_id($user_id) {
        return $this->query("SELECT * FROM addresses WHERE user_id=:user_id", ['user_id' => $user_id]);
        
    }
}

?>