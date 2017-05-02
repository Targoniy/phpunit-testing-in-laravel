<?php

use App\Order;
use App\Product;

class OrderTest extends PHPUnit_Framework_TestCase
{
    /** @test */    
    public function an_order_consists_of_products()
    {
        $order = $this->createOrderWithProducts();
        
        $this->assertCount(2, $order->products());
    }

    /** @test */    
    public function an_order_can_determine_the_total_cost_off_all_its_prooducts()
    {
        $order = $this->createOrderWithProducts();
        
        $this->assertEquals(948, $order->total());
    }
    protected function createOrderWithProducts()
    {
        $order = new Order;

        $product = new Product('Fall 4', 89);
        $product2= new Product('Block', 859);

        $order->add($product);
        $order->add($product2);

        return $order;
        
    }

}
