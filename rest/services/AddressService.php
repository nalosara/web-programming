<?php

require_once "BaseService.php";
require_once __DIR__."/../dao/AddressDao.class.php";

class AddressService extends BaseService {
   


    public function __construct() {
        parent::__construct(new AddressDao);
    }

    public function get_address_by_user_id($user_id) {
        return $this->dao->get_address_by_user_id($user_id);
    }
}
?>