<?php 
    namespace ceddd;
    class Summary{
        private $self;

        function __construct(HistoryRepository $repository){
            $this->self['repository']=$repository;
            $this->self['topSell']=NULL;
            $this->self['item']=NULL;
        }

        public function get($key){
            return $this->self[$key];
        }

        public function set($key,$value){
            $this->self[$key]=$value;            
        }

        public function getProductSoldQuantity($productId){
            $result=0;
            $history=$this->self['repository']->getByProductId($productId);
            $size=count($history);

            for ($i=0; $i < $size; $i++) { 
                $result+=$history[$i]->get('item')[0]->get('quantity');
            }

            return $result;
        }

        public function getTopSell(){

            $arrayOfProductQuantity=array();
            $arrayOfHistory = $this->self['repository']->getAll();
            $size = count($arrayOfHistory);

            for($i=0;$i<$size;$i++){
                $productId=$arrayOfHistory[$i]->get('item')->get('id');
                $arrayOfProductQuantity[strval($productId)]=getProductSoldQuantity($productId);
            }

            //Sort
            function cmp($a, $b)
            {
                if ($a == $b) {
                    return -1;
                }
                return ($a < $b) ? -1 : 1;
            }
            usort($arrayOfProductQuantity, "cmp");

            $this->self['topSell']=$arrayOfProductQuantity;
            Session::put('topSell', $arrayOfSoldItem);

            return $this->self['topSell'];
        }
    }