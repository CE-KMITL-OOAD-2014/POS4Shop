<?php

class ShopTest extends TestCase {


    public function testCal()
    {
        
        // Asset
        $price=0;
        $quantity=0;
        $arrItem=array();       
        for ($i=1 ; $i < 5; $i++) { 
            $solditem = new SoldItem;
            $solditem->set('item',"item"+$i);
            $solditem->set('price',$i*10);
            $solditem->set('quantity',$i*2);
            $quantity += $i*2;
            $price += ($i*10)*($i*2); // cost * quantity
            $arrItem[$i] = $solditem;
        }

        // Act
        $customer=$this->getMock('Customer');
        $manager=$this->getMock('Manager');
        $shop = new Shop;
        $result=$shop->cal($arrItem,$customer,$manager);
        
        // Assert
        $this->assertEquals($price, $result,'price');
        
        
    }

}
