<?php 
    namespace ceddd;
    class ManagerRepository implements \Repository{
        public function save($manager){
            $m = new \ManagerEloquent;
            $m->id = $manager->get('id');
            $m->name = $manager->get('name');
            $m->username = $manager->get('username');
            $m->password = $manager->get('password');
            $m->save();
        }

        public function edit($manager){
            if($manager->get('id')){ //TODO if not found -> how to handler?
                $m = \ManagerEloquent::find($manager->get('id'));
                $m->id = $manager->get('id');
                $m->name = $manager->get('name');
                $m->username = $manager->get('username');
                $m->password = $manager->get('password');
                $m->save();
            }
        }

        public function getAll(){
            $m = \ManagerEloquent::all();
            return $m;
        }

        public function find($name){
            $m = \ManagerEloquent::where('name', 'like', '%'.$name.'%');
            return $m;
        }
    }