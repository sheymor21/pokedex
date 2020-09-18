<?php 


class PokemonContext{

    public $db;

    private $json;
    
    public function __construct($directory)
    {
        $this->json = new JsonFile($directory,"configuracion");
        $configuracion = $this->json->ReadConfiguration();
        $this->db = new mysqli($configuracion->server,$configuracion->user,$configuracion->password,$configuracion->database);
        if($this->db->connect_error){
            exit('ERROR AL CONECTAR');
        }
    }
}




?>