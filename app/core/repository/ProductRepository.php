<?php 
    namespace ceddd;
    class ProductRepositoryEloquent implements Repository{
        public function save($product){
            $p = new ProductEloquent;
            $p->id = $product->get('id');
            $p->barcode = $product->get('barcode');
            $p->name = $product->get('name');
            $p->detail = $product->get('detail');
            $p->cost = $product->get('cost');
            $p->price = $product->get('price');
            $p->save();
        }
        
        public function edit($product){
            if($product->get('id')){ //TODO if not found -> how to handler?
                $p = ProductEloquent::find($product->get('id'));
                if($p=NULL)
                    return false;
                $p->id = $product->get('id');
                $p->barcode = $product->get('barcode');
                $p->name = $product->get('name');
                $p->detail = $product->get('detail');
                $p->cost = $product->get('cost');
                $p->price = $product->get('price');
                $p->save();
                
            }
        }
        
        public function getAll(){
            $p = ProductEloquent::all();
            return $p;
        }

        public function getById($id){
            $p = ProductEloquent::where('id', 'like', '%'.$id.'%');
            return $p;
        }

        public function find($name){
            $p = ProductEloquent::where('name', 'like', '%'.$name.'%');
            return $p;
        }
        
        public function where($key,$value){

        }
    }