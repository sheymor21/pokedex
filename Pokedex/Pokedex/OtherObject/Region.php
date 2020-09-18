<?php
    class Region{
        public $id;
        public $name;
        public $color;
        
        public function initialize($id,$name,$color){
            $this->id = $id;
            $this->color = $color;
            $this->name = $name;
        }

        public function set($data){
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }

?>