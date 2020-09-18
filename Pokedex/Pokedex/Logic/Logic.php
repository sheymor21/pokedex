<?php 
class logic{
    
    function __construct()
    {


    }
    function avisar(){
        $aviso = <<<EOF
        
    EOF;
        echo $aviso;
    }

    function verificar($list1,$list2){
        $validacion = false;
        

        if(!empty($list1)){
            if(!empty($list2)){
                $validacion = true;
            }
          
        }
        return $validacion;
    }

    public function color($list,$value){
        $color =false;
        foreach($list as $element){
            if($element->name == $value){
                $color = $element->color;
            }
        }
        return $color;
    }

    public function GetcookieTime(){
        return time() + 60*60*24*30;
    }

    public function uploadIMG($directory,$name,$tmpFile,$type,$size){

        $isSucces =false;
        if
        (
            ($type == "image/gif")
           || ($type == "image/jpeg")
           || ($type == "image/png")
           || ($type == "image/jpg")
           || ($type == "image/JPG")
            ||($type == "image/pjpeg") && ($size<1000000)
        ){
            if(!file_exists($directory)){
                mkdir($directory,0777,true);

                if(file_exists($directory)){
                   
                    $this->uploadFile($name,$tmpFile);
                    $isSucces = true;
                }

            }else{
                $this->uploadFile($name,$tmpFile);
                $isSucces = true;
            }
        }else {
            $isSucces = false;
        }
        return $isSucces;
    }
    public function uploadFile($name,$tmpFile){
        if(file_exists($name)){
            unlink($name);
        }

        move_uploaded_file($tmpFile,$name);
    }
    public function cont($list){
        $count = count($list);
        $element = $list[$count - 1];
            
        return $element;
            
        }
        
        public  function seleccion($select){
                $id = 0;
                if(is_numeric($select)){
                    $id = $select - 1;    
                }else{
                    $id = -1;
                }
            return $id;
         }
        
         public function filtrado($list,$propiedad,$value){
            $filtro = [];
            foreach ($list as $item) {
                if($item->$propiedad == $value){
                    array_push($filtro,$item);
                }
            }
            return $filtro;
         }
         public function index($list,$propiedad,$value){
            $index = 0;
            foreach ($list as $key => $item) {
                if($item->$propiedad == $value){
                    $index = $key;
                }
            }
            return $index;
         }

        


        }




?>