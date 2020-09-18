<?php
    class pokemon{
        public $id;
        public $img;
        public $name;
        public $type;
        public $region;
        public $mov1;
        public $mov2;
        public $mov3;
        public $mov4;

        public function initialize($id,$img,$name,$type,$region,$mov1,$mov2,$mov3,$mov4){
            $this->id = $id;
            $this->img = $img;
            $this->name = $name;
            $this->type = $type;
            $this->region = $region;
            $this->mov1 = $mov1;
            $this->mov2 = $mov2;
            $this->mov3 = $mov3;
            $this->mov4 = $mov4;
        }

        public function set($data){
            foreach($data as $key => $value) $this->{$key} = $value;
        }
    }

?>