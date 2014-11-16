<?php

class SummaryTest extends TestCase {

    public function testProductSoldQuantity()
    {            
        // Asset
        
        $testProductId = 1;
        $expectedQuantity = 0;

        $arrOfHistory = array();
        for ($i=0; $i < 5; $i++) { // Mock History object and data

            $arrOfSoldItem=array();
            $quantity = $i+1;

            $product = Mockery::mock('ceddd\\Product');
            $product->shouldReceive('get')->with('id')->andReturn($testProductId);

            $solditem = Mockery::mock('ceddd\\SoldItem');
            $solditem->shouldReceive('get')->with('item')->andReturn($product);
            $solditem->shouldReceive('get')->with('quantity')->andReturn($quantity);    // quantity = 1, 2, 3
            $arrOfSoldItem[0]=$solditem;

            $expectedQuantity+=$quantity;

            $history = Mockery::mock('ceddd\\History');
            $history->shouldReceive('get')->with('item')->andReturn($arrOfSoldItem);
            $arrOfHistory[$i] = $history;
        }

        $historyRepository = Mockery::mock('ceddd\\HistoryRepository');
        $historyRepository->shouldReceive('getByProductId')->with($testProductId)->andReturn($arrOfHistory);

        // Act
        $topSell = new ceddd\Summary($historyRepository);
        $result = $topSell->getProductSoldQuantity($testProductId); // $productId = 1
        
        // Assert
        $this->assertEquals($expectedQuantity, $result);
        
    }
}
