<?php 
    class DatabaseService implements iJson{
        
        private $logic;
        private $context;

        public function __construct($directory = "../Database")
        {
            $this->logic = new logic();
           $this->context = new PokemonContext($directory);
        }

        function GetList()
        {
           $listPokemon = array();

           $stmt = $this->context->db->prepare("select * from pokemons");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows === 0){
                return $listPokemon;
            }else{
                while($row = $result->fetch_object()){
                        $pokemon = new pokemon();
                        $pokemon->id = $row->id;
                        $pokemon->img = $row->img;
                        $pokemon->name = $row->name;
                        $pokemon->type = $row->type;
                        $pokemon->region = $row->region;
                        $pokemon->mov1 = $row->mov1;
                        $pokemon->mov2 = $row->mov2;
                        $pokemon->mov3 = $row->mov3;
                        $pokemon->mov4 = $row->mov4;
                        array_push($listPokemon,$pokemon);
                }
            }
            $stmt->close();
            return $listPokemon;
        }

        function Add($entidad)
        {
           

            $stmt = $this->context->db->prepare("insert into pokemons (name,type,region,mov1,mov2,mov3,mov4) values (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss",$entidad->name,$entidad->type,$entidad->region,$entidad->mov1,$entidad->mov2,$entidad->mov3,$entidad->mov4);
            $stmt->execute();
            $stmt->close();
            $pokemonId = $this->context->db->insert_id;
            
            if(isset($_FILES['Pimg'])){
                $Pimg = $_FILES['Pimg'];

                if($Pimg['error'] == 4){
                    $entidad->img = "";
                }else {

                    $typeRemplace = str_replace("image/","",$_FILES['Pimg']['type']);
                    $type = $Pimg['type'];
                    $size = $Pimg['size'];
                    $name = $pokemonId.".".$typeRemplace;
                    $tmpName = $Pimg['tmp_name'];

                    $success = $this->logic->uploadIMG("../AddPages/",$name,$tmpName,$type,$size);

                    if($success){
                        $stmt = $this->context->db->prepare("Update pokemons set img = ? where id = ?");
                        $stmt->bind_param("si",$name,$pokemonId);
                        $stmt->execute();
                        $stmt->close();
                    }



                }
            }
        }

        function Delete($id)
        {
            $stmt = $this->context->db->prepare("Delete from pokemons where id = ?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $stmt->close();
        }

        function GetbyId($id)
        {
            $pokemon = new pokemon();
            $stmt = $this->context->db->prepare("select * from pokemons where id = ?");
            $stmt->bind_param("i",$id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows === 0){
                return null;
            }else{
                while($row = $result->fetch_object()){
                        
                        $pokemon->id = $row->id;
                        $pokemon->img = $row->img;
                        $pokemon->name = $row->name;
                        $pokemon->type = $row->type;
                        $pokemon->region = $row->region;
                        $pokemon->mov1 = $row->mov1;
                        $pokemon->mov2 = $row->mov2;
                        $pokemon->mov3 = $row->mov3;
                        $pokemon->mov4 = $row->mov4;
                   
                }
            }
            $stmt->close();
            return $pokemon;
        }
        
        function Update($id, $entidad)
        {   
            $element = $this->GetbyId($id);

            $stmt = $this->context->db->prepare("Update pokemons set name = ?,type = ?,region = ?,mov1 = ?,mov2 = ?,mov3 = ?,mov4 = ? where id = ?");
            $stmt->bind_param("sssssssi",$entidad->name,$entidad->type,$entidad->region,$entidad->mov1,$entidad->mov2,$entidad->mov3,$entidad->mov4,$id);
            $stmt->execute();
            $stmt->close();

            if(isset($_FILES['Pimg'])){
                $Pimg = $_FILES['Pimg'];

                if($Pimg['error'] == 4){
                    $entidad->img = $element->img;
                }else {

                    $typeRemplace = str_replace("image/","",$_FILES['Pimg']['type']);
                    $type = $Pimg['type'];
                    $size = $Pimg['size'];
                    $name = $id.".".$typeRemplace;
                    $tmpName = $Pimg['tmp_name'];

                    $success = $this->logic->uploadIMG("../AddPages/",$name,$tmpName,$type,$size);

                    if($success){
                        $stmt = $this->context->db->prepare("Update pokemons set img = ? where id = ?");
                        $stmt->bind_param("si",$name,$id);
                        $stmt->execute();
                        $stmt->close();
                    }



                }
            }
             
            
        }
    }

?>