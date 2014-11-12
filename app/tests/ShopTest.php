<?php

class ShopTest extends TestCase {

    public function testCal()
    {    
        
        // Asset
        $totalPrice=0;
        $arrItem=array();       
        for ($i=1 ; $i < 5; $i++) { // Mock 5 SoldItem object
            $quantity = $i*2;
            $price = ($i*10);
            $totalPrice += $price*$quantity; // price * quantity

            $solditem = Mockery::mock('ceddd\SoldItem');
            $solditem->shouldReceive('get')
                ->with('price')->andReturn($price);

            $solditem->shouldReceive('get')
                ->with('quantity')->andReturn($quantity);
         
            $arrItem[$i] = $solditem;
        }

        // Act
        $customer=$this->getMock('ceddd\\Customer',array('__construct'),array($this->getMock('ceddd\\CustomerRepository')));
        $manager=$this->getMock('ceddd\\Manager',array('__construct'),array($this->getMock('ceddd\ManagerRepository')));
        $shop = new ceddd\Shop;
        $result=$shop->cal($arrItem,$manager,$customer);
        
        // Assert
        $this->assertEquals($totalPrice, $result);
        
    }

}
