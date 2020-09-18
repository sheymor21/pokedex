<?php 
    class JsonFile implements iJsonImplement{

       public $directory;
       public $fileName;

       public function __construct($directory,$fileName)
       {
           $this->directory = $directory;
           $this->fileName = $fileName;
       }

        public function CreateDirectory($path)
        {
            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
        }

       public  function SaveFile($value)
        {
            $this->CreateDirectory($this->directory);
            $path = $this->directory."/".$this->fileName.".json";

            $serializeData = json_encode($value);

            $file = fopen($path,"w+");
            fwrite($file,$serializeData);
            fclose($file);
        }

        public function ReadFile()
        {
            $this->CreateDirectory($this->directory);
            $path = $this->directory."/".$this->fileName.".json";

            if(file_exists($path)){
                $file = fopen($path,"r");
                $content = fread($file,filesize($path));
                fclose($file);
                return json_decode($content);
            }else{
                return false;
            }
        }

        public function ReadConfiguration()
        {
            
            $path = $this->directory."/".$this->fileName.".json";

            if(file_exists($path)){
                $file = fopen($path,"r");
                $content = fread($file,filesize($path));
                fclose($file);
                return json_decode($content);
            }else{
                return false;
            }
        }
    }


?>