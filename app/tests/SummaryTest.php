<?php

class SummaryTest extends TestCase {

    public function testProductSoldQuantity()
    {            
        // Asset
        
        $testProductId = 1;
        $expectedQuantity = 0;

        $arrOfHistory = array();
        for ($i=0; $i < 5; $i++) {

            $arrOfSoldItem=array();
            for ($j=0; $j < 3; $j++) { 
                $productId = $j+1;
                $quantity = $i+2;

                $product = Mockery::mock('ceddd\Product');
                $product->shouldReceive('get')->with('id')->andReturn($productId); // productId =1, 2, 3

                $solditem = Mockery::mock('ceddd\SoldItem');
                $solditem->shouldReceive('get')->with('product')->andReturn($product);
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
        $result = $topSell->getProductSoldQuantity($productId); // $productId = 1
        
        // Assert
        $this->assertEquals($expectedQuantity, $result);
        
    }

}
