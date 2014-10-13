<?php 
    interface Repository{
        function save();
        function edit();
        function getAll();
        function find();
    }