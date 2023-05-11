<?php

require_once "BaseServices.php";
require_once __DIR__."/../dao/CategoryDao.class.php";

class CategoryService extends BaseServices {
    public function __construct() {
        parent::__construct(new CategoryDao);
    }
}
?>