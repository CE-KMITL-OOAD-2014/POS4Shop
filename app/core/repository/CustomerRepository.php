<?php 
    namespace ceddd;
    class  CustomerRepository implements \Repository{
        public function save($customer){
            $c = new \CustomerEloquent;
            $c->id = $customer->get('id');
            $c->name = $customer->get('name');
            $c->save();
        }

        public function edit($customer){
            if($customer->get('id')){ //TODO if not found -> how to handler?
                $c = \CustomerEloquent::find($customer->get('id'));
                $c->id = $customer->get('id');
                $c->name = $customer->get('name');
                $c->save();
            }
        }

        public function getAll(){
            $c = \CustomerEloquent::all();
            return $c;
        }

        public function find($name){
            $c = \CustomerEloquent::where('name', 'like', '%'.$name.'%');
            return $c;
        }
    }