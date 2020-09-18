<!doctype html>
<html lang="en">
  <head>
    <title>Pokedex</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <?php
       require_once "../interfaces/iServicePokemons.php";
       require_once "../interfaces/iJsonService.php";
        require_once "../interfaces/iJsonImplement.php";
        require_once "../Logic/Logic.php";
       require_once "../Logic/JsonService/JsonImplement.php";
        require_once "../OtherObject/Region.php";
        require_once "../OtherObject/Type.php";
        require_once "../Pokemons/pokemons.php";
        require_once "../Database/PokemonContext.php";
        require_once "../Logic/DatabaseService/DatabaseService.php";
        require_once "../Logic/DatabaseService/DatabaseServiceType.php";
        require_once "../Logic/DatabaseService/DatabaseServiceRegion.php";

        $servicionDataB = new DatabaseService();
        $serviciosRegion = new DatabaseServiceregion();
       $serviciosTypes = new DatabaseServiceType();
        $listTypes = $serviciosTypes->GetList();
        $listRegion = $serviciosRegion->GetList();
        $listPokemon = $servicionDataB->GetList();
        $updatePokemon = new pokemon();
        $id;
        $img;
        $name;
        $type;
        $region;
        $mov1;
        $mov2;
        $mov3;
        $mov4; 
        $id = $_GET['ID'];
        foreach($listPokemon as $pokemon){
            if($pokemon->id == $id){
                $name = $pokemon->name;
                $type = $pokemon->type;
                $region = $pokemon->region;
                $mov1 = $pokemon->mov1;
                $mov2 = $pokemon->mov2;
                $mov3 = $pokemon->mov3;
                $mov4 = $pokemon->mov4;
                $img = $pokemon->img;
            }

        }
        if(isset($_POST['Pname']) && isset($_POST['mov1']) && isset($_POST['mov2']) && isset($_POST['mov3']) && isset($_POST['mov4']) && isset($_POST['Pregion']) && isset($_POST['tipo1']) && isset($_POST['tipo2'])){
            
          $id = $_POST['id'];
          
          if($_POST['tipo2'] == '-----'){
              $tipo = $_POST['tipo1'];
            }else{
              $tipo = $_POST['tipo1']."/".$_POST['tipo2'];
            }
            $updatePokemon->initialize($id,$_FILES['Pimg'],$_POST['Pname'],$tipo,$_POST['Pregion'],$_POST['mov1'],$_POST['mov2'],$_POST['mov3'],$_POST['mov4']);
           $servicionDataB->Update($id,$updatePokemon);
          header('Location: ../index.php?ord=1');
          exit();
          }
      ?>
    <nav class="navbar navbar-light bg-danger">
        <a class="navbar-brand text-white font-weight-bold" href="../index.php?ord=1" style="margin-left: 45%;">Pokedex</a>
    </nav>

    <div class="container mt-5">
    <form enctype="multipart/form-data" action="update.php" method="post">
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="id" value="<?php echo $id;?>" hidden>
  <div class="form-group">
    <label for="exampleInputEmail1"  class="font-weight-bold">Nombre</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Pname" value="<?php echo $name;?>">
  </div>
  <div class="form-group">
  <label for="exampleInputEmail1" class="font-weight-bold">Movimientos</label>
  <div class="form-row">
      
    <div class="col">
      <input type="text" class="form-control" placeholder="Primer movimiento" name="mov1" value="<?php echo $mov1;?>">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Segundo movimiento" name="mov2" value="<?php echo $mov2;?>">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Tercer movimiento" name="mov3" value="<?php echo $mov3;?>">
    </div>
    <div class="col">
      <input type="text" class="form-control" placeholder="Cuarto movimiento" name="mov4" value="<?php echo $mov4;?>">
    </div>
  </div>
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"  class="font-weight-bold">Region</label>
    <select class="form-control" name="Pregion">
      <?php foreach($listRegion as $Region):?>
          <option><?php echo $Region->name; ?></option>
      <?php endforeach;?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"  class="font-weight-bold">Tipo</label>
    <div class="row">
      <div class="col">
      <select class="form-control" name="tipo1">
      <?php foreach($listTypes as $Type):?>
          <option><?php echo $Type->name; ?></option>
      <?php endforeach;?>
    </select>
       </div>
       <div class="col">
       <select class="form-control" name="tipo2">
       <option>-----</option>
      <?php foreach($listTypes as $Type):?>
          <option><?php echo $Type->name; ?></option>
      <?php endforeach;?>
    </select>
       </div>
    </div>
    
  </div>
  <!--  -->
  <div class="form-group">
         <label for="" class="font-weight-bold">img</label>
         <input type="file" class="form-control-file" name="Pimg"  aria-describedby="fileHelpId">
       </div>
<!--  -->
  <button type="submit" class="btn btn-success">Crear</button>
</form>
    </div>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>