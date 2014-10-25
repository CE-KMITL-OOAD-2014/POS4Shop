<?php 
    namespace ceddd;
    class ProductRepository implements Repository{
        
        public static function getRules(){
            return array('barcode' => 'required|min:4|unique:products',
                         'name'=>'required',
                         'file'=>'image',
                         'cost'=>'required|numeric',
                         'price'=>'required|numeric');
        }

        public function save($product){
            $p = new \ProductEloquent;
            if($p->id!=null)
                $p->id = $product->get('id');
            $p->barcode = $product->get('barcode');
            $p->name = $product->get('name');
            $p->name = $product->get('file');
            $p->detail = $product->get('detail');
            $p->cost = $product->get('cost');
            $p->price = $product->get('price');
            return $p->save();
        }
        
        public function edit($product){
            if($product->get('id')){ //TODO if not found -> how to handler?
                $p = \ProductEloquent::find($product->get('id'));
                if($p=NULL)
                    return false;
                $p->id = $product->get('id');
                $p->barcode = $product->get('barcode');
                $p->name = $product->get('name');
                $p->name = $product->get('file');
                $p->detail = $product->get('detail');
                $p->cost = $product->get('cost');
                $p->price = $product->get('price');
                return $p->save();                
            }
            return false;
        }
        
        public static function getAll(){
            $p = \ProductEloquent::all();
            return $p;
        }

        public static function getById($id){
            $p = \ProductEloquent::where('id', 'like', '%'.$id.'%');
            return $p;
        }

        public static function find($name){
            $p = \ProductEloquent::where('name', 'like', '%'.$name.'%');
            return $p;
        }
        
        public static function where($key,$value){

        }
    }