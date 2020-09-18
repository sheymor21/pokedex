<?php
    class Type{
        public $id;
        public $name;
        
        public function initialize($id,$name){
            $this->id = $id;
            $this->name = $name;
        }

        public function set($data){
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }

?>