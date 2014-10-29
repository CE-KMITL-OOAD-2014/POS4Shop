<?php 
    namespace ceddd;
    class HistoryRepository implements Repository{

        
        public static function getRules(){
            return array('barcode' => 'required|min:4|unique:products',
                         'name'=>'required',
                         'file'=>'image',
                         'cost'=>'required|numeric',
                         'price'=>'required|numeric');
        }

        public function save($history){
            $h = new \HistoryEloquent;
            if($history->get('id')!=null)
                return false; // old product should edit
            $h->barcode = $history->get('barcode');
            $h->name = $history->get('name');
            $h->file = $history->get('file');
            $h->detail = $history->get('detail');
            $h->cost = $history->get('cost');
            $h->price = $history->get('price');
            return $h->save();
        }
        
        public function edit($history){
            if($history->get('id')){ //TODO if not found -> how to handler?
                $h = \HistoryEloquent::find($history->get('id'));
                if($h==NULL)
                    return false;
                $h->barcode = $history->get('barcode');
                $h->name = $history->get('name');
                $h->file = $history->get('file');
                $h->detail = $history->get('detail');
                $h->cost = $history->get('cost');
                $h->price = $history->get('price');
                return $h->save();
            }
            return false;
        }

        public function delete($history){
            if($history->get('id')){
                $m = \HistoryEloquent::find($history->get('id'));
                return $m->delete();
            }
            return false;
        }
        
        public static function getAll(){
            $all = \HistoryEloquent::all();
            if(count($all)==0)
                return NULL;
            $result=array();
            foreach($all as $key => $val){
                $h = \App::make('ceddd\History');
                $h->set('id',$val->id);
                $h->set('barcode',$val->barcode);
                $h->set('name',$val->name);
                $h->set('file',$val->file);
                $h->set('detail',$val->detail);
                $h->set('cost',$val->cost);
                $h->set('price',$val->price);
                $h->set('created_at',$val->created_at);
                $h->set('updated_at',$val->updated_at);
                $result[$key]=$h;
            } 
            return $result;
        }

        public static function getById($id){
            $history = \HistoryEloquent::find($id);
            if($history){
                $h = \App::make('ceddd\History');
                $h->set('id',$history->id);
                $h->set('barcode',$history->barcode);
                $h->set('name',$history->name);
                $h->set('file',$history->file);
                $h->set('detail',$history->detail);
                $h->set('cost',$history->cost);
                $h->set('price',$history->price);
                $h->set('created_at',$history->created_at);
                $h->set('updated_at',$history->updated_at);
                return $h;
            }
            return NULL;
        }

        public static function find($value){
            $where = \HistoryEloquent::where('barcode', 'like', '%'.$value.'%')->orWhere('name', 'like', '%'.$value.'%')->get();
            if(count($where)==0)
                return NULL;
            $result=array();
            foreach($where as $key => $val){
                $h = \App::make('ceddd\History');
                $h->set('id',$val->id);
                $h->set('barcode',$val->barcode);
                $h->set('name',$val->name);
                $h->set('file',$val->file);
                $h->set('detail',$val->detail);
                $h->set('cost',$val->cost);
                $h->set('price',$val->price);
                $h->set('created_at',$val->created_at);
                $h->set('updated_at',$val->updated_at);
                $result[$key]=$h;
            } 
            return $result;
        }
        
        public static function where($col,$value){
            $where = \HistoryEloquent::where($col, 'like', '%'.$value.'%')->get();
            if(count($where)==0)
                return NULL;
            $result=array();
            foreach($where as $key => $val){
                $h = \App::make('ceddd\History');
                $h->set('id',$val->id);
                $h->set('barcode',$val->barcode);
                $h->set('name',$val->name);
                $h->set('file',$val->file);
                $h->set('detail',$val->detail);
                $h->set('cost',$val->cost);
                $h->set('price',$val->price);
                $h->set('created_at',$val->created_at);
                $h->set('updated_at',$val->updated_at);
                $result[$key]=$h;
            } 
            return $result;
        }
    }