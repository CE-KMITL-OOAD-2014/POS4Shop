<?php

class ProductTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());

		$var = new MyTestClass();	
		$result = $var->add(5,5); //10
		$this->assertTrue($result==11);
	}

}
