<?php 
    namespace ceddd;
    class HistoryRepository implements \Repository{
        public function save($history){
            $h = new \HistoryEloquent;
            $h->id = $history->get('id');
            $h->item = $history->get('item');
            $h->customerId = $history->get('customerId');
            $h->save();
        }

        public function edit($history){
            if($history->get('id')){ //TODO if not found -> how to handler?
                $h = \HistoryEloquent::find($history->get('id'));
                $h->id = $history->get('id');
                $h->name = $history->get('item');
                $h->username = $history->get('customerId');
                $h->save();
            }
        }

        public function getAll(){
            $h = \HistoryEloquent::all();
            return $h;
        }

        public function find($id){
            $h = \HistoryEloquent::where('id', 'like', '%'.$id.'%');
            return $h;
        }
    }