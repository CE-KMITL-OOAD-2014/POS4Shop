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
            if($product->get('id')!=null)
                return false; // old product should edit
            $p->barcode = $product->get('barcode');
            $p->name = $product->get('name');
            $p->file = $product->get('file');
            $p->detail = $product->get('detail');
            $p->cost = $product->get('cost');
            $p->price = $product->get('price');
            return $p->save();
        }
        
        public function edit($product){
            if($product->get('id')){ //TODO if not found -> how to handler?
                $p = \ProductEloquent::find($product->get('id'));
                if($p==NULL)
                    return false;
                $p->barcode = $product->get('barcode');
                $p->name = $product->get('name');
                $p->file = $product->get('file');
                $p->detail = $product->get('detail');
                $p->cost = $product->get('cost');
                $p->price = $product->get('price');
                return $p->save();
            }
            return false;
        }

        public function delete($product){
            if($product->get('id')){
                $m = \ProductEloquent::find($product->get('id'));
                return $m->delete();
            }
            return false;
        }
        
        public static function getAll(){
            $all = \ProductEloquent::all();
            if(count($all)==0)
                return NULL;
            foreach($all as $key => $val){
                //$result[$key]=$val;
                $p = new Product(new ProductRepository);
                $p->set('id',$val->id);
                $p->set('barcode',$val->barcode);
                $p->set('name',$val->name);
                $p->set('file',$val->file);
                $p->set('detail',$val->detail);
                $p->set('cost',$val->cost);
                $p->set('price',$val->price);
                $p->set('created_at',$val->created_at);
                $p->set('updated_at',$val->updated_at);
                $result[$key]=$p;
            } 
           return $result;
        }

        public static function getById($id){
            $product = \ProductEloquent::find($id);
            if($product){
                $p = new Product(new ProductRepository);
                $p->set('id',$product->id);
                $p->set('barcode',$product->barcode);
                $p->set('name',$product->name);
                $p->set('file',$product->file);
                $p->set('detail',$product->detail);
                $p->set('cost',$product->cost);
                $p->set('price',$product->price);
                $p->set('created_at',$product->created_at);
                $p->set('updated_at',$product->updated_at);
                return $p;
            }
            return NULL;
        }

        public static function find($name){
            $p = \ProductEloquent::where('name', 'like', '%'.$name.'%');
            return $p;
        }
        
        public static function where($key,$value){
            $product = \ProductEloquent::where($key, 'like', '%'.$name.'%');
            if($all==NULL)
                return NULL;
            foreach($all as $key => $val){
                $result[$key]=$val;
            }
            return $result;
        }
    }