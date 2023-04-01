<?php

require_once "BaseServices.php";
require_once __DIR__."/../dao/UserDao.class.php";

class UserService extends BaseServices {
    public function __construct() {
        parent::__construct(new UserDao);
    }
}
?>