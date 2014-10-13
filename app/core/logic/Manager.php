<?php
	class Manager extends User{
        function __construct($sth = null){
            $this->self['username']=NULL;
            $this->self['password']=NULL;
        }
	}