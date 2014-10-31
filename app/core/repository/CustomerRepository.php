<?php 
    namespace ceddd;
    class CustomerRepository implements Repository{

        public static function getRules(){
            return array('name' => 'required|min:3|unique:customers');
        }

        public function save($customer){
            if($customer->get('id')!=NULL)
                return false;
            $c = new \CustomerEloquent;
            $c->name = $customer->get('name');
            if($c->save()){
                $customer->set('id',$c->id);
                return true;
            }
            return false;
        }

        public function edit($customer){
            if($customer->get('id')){
                $ctm = \CustomerEloquent::find($customer->get('id'));
                $ctm->name = $customer->get('name');
                return $ctm->save();
            }
            return false;
        }

        public function delete($customer){
            if($customer->get('id')){
                $m = \CustomerEloquent::find($customer->get('id'));
                return $m->delete();
            }
            return false;
        }

        public static function getAll(){
            $all = \CustomerEloquent::all();
            if(count($all)==0)
                return NULL;

            foreach($all as $key => $val){
                $c=\App::make('ceddd\\Customer');
                $c->set('id',$val->id);
                $c->set('name',$val->name);
                $c->set('created_at',$val->created_at);
                $c->set('updated_at',$val->updated_at);
                $result[$key]=$p;
            }
            return $result;
        }

        public static function find($name){
            $ce = \CustomerEloquent::where('name', 'like', '%'.$name.'%');
            if(!$ce)
                return NULL;
            foreach($ce as $key => $val){
                $c=\App::make('ceddd\\Customer');
                $c->set('id',$val->id);
                $c->set('name',$val->name);
                $c->set('created_at',$val->created_at);
                $c->set('updated_at',$val->updated_at);
                $result[$key]=$p;
            }
            return $result;
        }

        public static function getById($id){
            $ce =\CustomerEloquent::find($id);
            if($ce){
                $customer=\App::make('ceddd\Customer');
                $customer->set('id',$ce->id);
                $customer->set('name',$ce->name);                
                $customer->set('created_at',$ce->created_at);
                $customer->set('updated_at',$ce->updated_at);
                return $customer;
            }
            return NULL;
        }

        public static function where($key,$value){
            return find($value);
        }
    }