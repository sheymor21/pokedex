<?php 
    class DatabaseServiceType implements iJson{
        
        private $logic;
        private $context;

        public function __construct($directory = "../Database")
        {
            $this->logic = new logic();
           $this->context = new PokemonContext($directory);
        }

        function GetList()
        {
           $listtype = array();

           $stmt = $this->context->db->prepare("select * from type");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows === 0){
                return $listtype;
            }else{
                while($row = $result->fetch_object()){
                        $type = new Type();
                        $type->id = $row->id;
                        $type->name = $row->name; 
                        array_push($listtype,$type);
                }
            }
            $stmt->close();
            return $listtype;
        }

        function Add($entidad)
        {
           

            $stmt = $this->context->db->prepare("insert into type (name) values (?)");
            $stmt->bind_param("s",$entidad->name);
            $stmt->execute();
            $stmt->close();
            
        }

        function Delete($id)
        {
            $stmt = $this->context->db->prepare("Delete from type where id = ?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $stmt->close();
        }

        function GetbyId($id)
        {
            $type = new Type();
            $stmt = $this->context->db->prepare("select * from type where id = ?");
            $stmt->bind_param("i",$id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows === 0){
                return null;
            }else{
                while($row = $result->fetch_object()){
                        
                        $type->id = $row->id;
                        $type->name = $row->name;
                       
                   
                }
            }
            $stmt->close();
            return $type;
        }
        
        function Update($id, $entidad)
        {  

            $stmt = $this->context->db->prepare("Update type set name = ? where id = ?");
            $stmt->bind_param("si",$entidad->name,$id);
            $stmt->execute();
            $stmt->close();
             
            
        }
    }

?>