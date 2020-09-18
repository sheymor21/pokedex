<?php 
    class DatabaseServiceregion implements iJson{
        
        private $logic;
        private $context;

        public function __construct($directory = "../Database")
        {
            $this->logic = new logic();
           $this->context = new PokemonContext($directory);
        }

        function GetList()
        {
           $listRegion = array();

           $stmt = $this->context->db->prepare("select * from region");
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows === 0){
                return $listRegion;
            }else{
                while($row = $result->fetch_object()){
                        $region = new Region();
                        $region->id = $row->id;
                        $region->name = $row->name; 
                        $region->color = $row->color;
                        array_push($listRegion,$region);
                }
            }
            $stmt->close();
            return $listRegion;
        }

        function Add($entidad)
        {
           

            $stmt = $this->context->db->prepare("insert into region (name,color) values (?,?)");
            $stmt->bind_param("ss",$entidad->name,$entidad->color);
            $stmt->execute();
            $stmt->close();
            
        }

        function Delete($id)
        {
            $stmt = $this->context->db->prepare("Delete from region where id = ?");
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $stmt->close();
        }

        function GetbyId($id)
        {
            $region = new Region();
            $stmt = $this->context->db->prepare("select * from region where id = ?");
            $stmt->bind_param("i",$id);
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows === 0){
                return null;
            }else{
                while($row = $result->fetch_object()){
                        
                        $region->id = $row->id;
                        $region->name = $row->name;
                        $region->color = $row->color;
                }
            }
            $stmt->close();
            return $region;
        }
        
        function Update($id, $entidad)
        {  

            $stmt = $this->context->db->prepare("Update region set name = ?,color = ? where id = ?");
            $stmt->bind_param("ssi",$entidad->name,$entidad->color,$id);
            $stmt->execute();
            $stmt->close();
             
            
        }
    }

?>