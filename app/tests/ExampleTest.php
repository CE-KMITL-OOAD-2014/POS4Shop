<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');
		$this->assertTrue($this->client->getResponse()->isOk());

		// Home
		    // Index
		$crawler = $this->client->request('GET', 'home');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Top
		$crawler = $this->client->request('GET', 'home/top');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Search
		$crawler = $this->client->request('GET', 'home/add');
		$this->assertTrue($this->client->getResponse()->isOk());

		//--Manager
		    // Add manager
		$crawler = $this->client->request('GET', 'manager/add');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Del manager
		$crawler = $this->client->request('GET', 'manager/add');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Shop cal
		$crawler = $this->client->request('GET', 'manager/shop');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Shop setting
		$crawler = $this->client->request('GET', 'manager/setting');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Shop history
		$crawler = $this->client->request('GET', 'manager/history');
		$this->assertTrue($this->client->getResponse()->isOk());

		//--Customer
		    // Add customer
		$crawler = $this->client->request('GET', 'customer/add');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // del
		$crawler = $this->client->request('GET', 'customer/del');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // history
		$crawler = $this->client->request('GET', 'customer/history');
		$this->assertTrue($this->client->getResponse()->isOk());

		//--Product
		    // Add
		$crawler = $this->client->request('GET', 'product/add');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Del
		$crawler = $this->client->request('GET', 'product/del');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // Edit
		$crawler = $this->client->request('GET', 'product/edit');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // View
		$crawler = $this->client->request('GET', 'product/view');
		$this->assertTrue($this->client->getResponse()->isOk());
		    // TopSell
		$crawler = $this->client->request('GET', 'product/top');
		$this->assertTrue($this->client->getResponse()->isOk());
	}

}
