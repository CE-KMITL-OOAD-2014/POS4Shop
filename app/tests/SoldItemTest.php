<?php

class SoldItemTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testItem()
	{
		// S
		$item="ItemName";
		$quantity=5;
		$price=99.50;
		$solditem= new ceddd\SoldItem();
		
		// E
		$solditem->set("item",$item);
		$solditem->set("quantity",$quantity);
		$solditem->set("price",$price);
		
		// V
		$this->assertEquals($item, $solditem->get('item') , 'Get item');
		$this->assertEquals($quantity, $solditem->get('quantity') , 'Get quantity');
		$this->assertEquals($price, $solditem->get('price') , 'Get price');

		// T
		// $var = new Shop;	
		// $result = $var->add(5,5);
		// $this->assertTrue($result==10);
	}

}
