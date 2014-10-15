<?php
    namespace ceddd;
	class Manager extends User{

        function __construct($sth = null){
            $this->self['username']=NULL;
            $this->self['password']=NULL;
        }
        public function setPassword($oldPw,$newPw,$confPw){
            if($newPw == $confPw){
                if(Hash::check($oldPw,$this->self['password'])){
                    $this->self['password'] = $newPw;
                }else{
                    //TODO error handler
                }
            }else{
                //TODO error handler
            }
        }
    }