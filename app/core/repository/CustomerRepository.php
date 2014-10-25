<?php 
    namespace ceddd;
    class CustomerRepository implements Repository{

        public static function getRules(){
            return array('name' => 'required|min:3|unique:customers');
        }

        public function save($customer){
            $c = new \CustomerEloquent;
            //$c->id = $customer->get('id');
            $c->name = $customer->get('name');
            return $c->save();
        }

        public function edit($customer){
            if($customer->get('id')){                  
                $c = \CustomerEloquent::find($customer->get('id'));
                if($c=NULL)
                    return false;
                $c->id = $customer->get('id');
                $c->name = $customer->get('name');
                return $c->save();
            }
            return false;
        }


        public static function getAll(){
            $all = \CustomerEloquent::all();
            if($all==NULL)
                return NULL;
            foreach($all as $key => $val){
                $result[$key]=$val;
            }
            return $result;
        }

        public static function find($name){
            $ce = \CustomerEloquent::where('name', 'like', '%'.$name.'%');
            if($ce){
                $customer=\App::make('ceddd\Customer');
                $customer->set('id',$ce->id);
                $customer->set('name',$ce->name);
                return $customer;
            }
            return NULL;
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

        }
    }