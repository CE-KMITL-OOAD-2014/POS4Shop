<?php

class SummaryTest extends TestCase {

    public function testCountProductSoldQuantity()
    {            
        // Asset
        
        $testProductId = 1;
        $expectedQuantity = 0;

        $arrOfHistory = array();
        for ($i=0; $i < 5; $i++) { // Mock History object and data

            $arrOfSoldItem=array();
            for ($j=0; $j < 3; $j++) { // Mock SoldItem object for use in History object
                $productId = $j+1;
                $quantity = $i+2;

                $product = Mockery::mock('ceddd\Product');  // Mock Product object 
                $product->shouldReceive('get')->with('id')->andReturn($productId); // productId =1, 2, 3

                $solditem = Mockery::mock('ceddd\SoldItem');
                $solditem->shouldReceive('get')->with('item')->andReturn($product);
                $solditem->shouldReceive('get')->with('quantity')->andReturn($quantity);    // quantity = 2, 3, 4
                $arrOfSoldItem[$i]=$solditem;

                if($productId == $testProductId) 
                    $expectedQuantity+=$quantity;
            }

            $history = Mockery::mock('ceddd\History');
            $history->shouldReceive('get')->with('item')->andReturn($solditem);

            $arrOfHistory[$i] = $history;
        }

        $historyRepository = Mockery::mock('ceddd\HistoryRepository');
        $historyRepository->shouldReceive('getAll')->andReturn($arrOfHistory);

        // Act
        $topSell = new Summary($historyRepository);
        $result = $topSell->countProductSoldQuantity($productId); // $productId = 1
        
        // Assert
        $this->assertEquals($expectedQuantity, $result);
        
    }

}
