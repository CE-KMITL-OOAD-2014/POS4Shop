<?php 
    namespace ceddd;
    class HistoryRepository implements Repository{

        
        public static function getRules(){
            return array('hid' => 'required|integer',
                         'product_id'=>'required|exists:products,id',
                         'quantity'=>'required|numeric',
                         'price'=>'required|numeric',
                         'customer_id'=>'exists:customers,id');
        }

        public function save($history){
            if($history->get('id')!=null)
                return false; // old id should edit
            $arrItem = $history->get('item');
            $count = count($arrItem);
            for($i=0;$i < $count;$i++){
                $rules = $this->getRules();
                //$data = array('hid','product_id','quantity','price','customer_id');
                $data['hid'] = $history->get('hid');
                $data['product_id'] = $arrItem[$i]->get('product_id');
                $data['quantity'] = $arrItem[$i]->get('quantity');
                $data['price'] = $arrItem[$i]->get('price');
                $data['customer_id'] = $history->get('customer_id');
                $validator = Validator::make($data, $rules);
                if ($validator->passes()) {
                    $h = new \HistoryEloquent;
                    $h->hid = $data['hid'];
                    $h->product_id = $data['product_id'];
                    $h->quantity = $data['quantity'];
                    $h->price = $data['price'];
                    $h->customer_id = $data['customer_id'];
                    if(!$h->save()){
                       return false;
                    }
                }else{
                    return false;
                }
            }
            return true;
        }
        
        public function edit($history){
            if($history->get('id')){ //TODO if not found -> how to handler?
                $h = \HistoryEloquent::find($history->get('id'));
                if($h==NULL)
                    return false;
                $h->hid = $history->get('hid');
                $h->product_id = $history->get('product_id');
                $h->quantity = $history->get('quantity');
                $h->price = $history->get('price');
                $h->customer_id = $history->get('customer_id');
                return $h->save();
            }
            return false;
        }

        public function delete($history){
            if($history->get('hid')){
                $m = \HistoryEloquent::find($history->get('id'));
                return $m->delete();
            }
            return false;
        }
        
        public static function getAll(){
            $all = \HistoryEloquent::all();
            $count = count($all);
            if($count == 0)
                return NULL;
            $i = 0;
            $arrCount = 0;
            $product = App::make('ceddd\Product');
            $soldItem = App::make('ceddd\SoldItem');
            $h = \App::make('ceddd\History');
            $h->set('id',$all[$i]->id);
            $h->set('hid',$all[$i]->hid);
            $h->set('customer_id',$all[$i]->customer_id);
            $h->set('created_at',$all[$i]->created_at);
            $h->set('updated_at',$all[$i]->updated_at);
            $result = array();
            $soldArr = array();
            while($i < $count){
                if($h->id == $all[$i]->id){
                    $soldItem->set('item',$product->getById($all[$i]->product_id));
                    $soldItem->set('quantity',$all[$i]->quantity);
                    $soldItem->set('price',$all[$i]->price);
                    $soldArr[$arrCount] = $soldItem;
                    $arrCount++;
                }else{
                    $h->set('id',$all[$i]->id);
                    $h->set('hid',$all[$i]->hid);
                    $h->set('item',$soldArr);
                    $h->set('customer_id',$all[$i]->customer_id);
                    $h->set('created_at',$all[$i]->created_at);
                    $h->set('updated_at',$all[$i]->updated_at);
                    $soldArr = array();
                    $arrCount = 0;
                }
            }
            return $result;
        }

        public static function getById($id){
            $history = \HistoryEloquent::find($id);
            if($history){
                $h = \App::make('ceddd\History');
                $h->set('id',$history->id);
                $h->set('hid',$history->hid);
                $h->set('product_id',$history->product_id);
                $h->set('quantity',$history->quantity);
                $h->set('price',$history->price);
                $h->set('customer_id',$history->customer_id);
                $h->set('created_at',$history->created_at);
                $h->set('updated_at',$history->updated_at);
                return $h;
            }
            return NULL;
        }

        public static function find($value){

        }

        public static function where($col,$value){
            $where = \HistoryEloquent::where($col, 'like', '%'.$value.'%')->get();
            if(count($where)==0)
                return NULL;
            $result=array();
            foreach($where as $key => $val){
                $h = \App::make('ceddd\History');
                $h->set('id',$val->id);
                $h->set('hid',$val->hid);
                $h->set('product_id',$val->product_id);
                $h->set('quantity',$val->quantity);
                $h->set('price',$val->price);
                $h->set('customer_id',$val->customer_id);
                $h->set('created_at',$val->created_at);
                $h->set('updated_at',$val->updated_at);
                $result[$key]=$h;
            } 
            return $result;
        }
    }