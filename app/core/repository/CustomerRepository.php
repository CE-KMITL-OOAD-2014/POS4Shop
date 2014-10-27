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
            return $c->save();
        }

        public function edit($customer){
            if($customer->get('id')){
                $c = \CustomerEloquent::find($customer->get('id'));
                if($c){
                    $c->id = $customer->get('id');
                    $c->name = $customer->get('name');
                    return $c->save();
                }
            }
            return false;
        }

        public static function getAll(){
            $all = \CustomerEloquent::all();
            if(count($all)==0)
                return NULL;

            foreach($all as $key => $val){
                $c = new Customer(new CustomerRepository);
                $c->set('id',$val->id);
                $c->set('name',$val->name);
                $c->set('created_at',$val->created_at);
                $c->set('updated_at',$val->updated_at);
                $result[$key]=$p;
            }
            return $result;
        }

        public static function find($name){
            $find = \CustomerEloquent::where('name', 'like', '%'.$name.'%');
            if(!$find)
                return NULL;
            foreach($find as $key => $val){
                $c = new Customer(new CustomerRepository);
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
                return $customer;
            }
            return NULL;
        }

        public static function where($key,$value){
            return find($value);
        }
    }