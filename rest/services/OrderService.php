<?php

require_once "BaseService.php";
require_once "OrderProductService.php";
require_once __DIR__."/../dao/OrderDao.class.php";

class OrderService extends BaseService {

    private $order_product_service; 
    public function __construct() {
        parent::__construct(new OrderDao);
        $this->order_product_service = new OrderProductService();
    }

    public function get_by_user_id($user_id){
        return $this->dao->get_by_user_id($user_id);
    }

    public function add($entity) {
        $order = $entity;
        unset($order['product_id']);
        unset($order['quantity']);
        $added_order = $this->dao->add($order);

        $order_product = $entity;
        unset($order_product['user_id']);
        unset($order_product['order_date']);
        $order_product['order_id'] = $added_order['id'];

        return $this->order_product_service->add($order_product);
        
    }
}
?>