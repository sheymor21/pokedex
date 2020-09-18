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
            $newRegion = new Region();
            $servicios = new DatabaseServiceregion();

            if(isset($_POST['Rnombre']) && isset($_POST['Rcolor'])){
             $newRegion->initialize(0,$_POST['Rnombre'],$_POST['Rcolor']);
              $servicios->Add($newRegion);
              header('Location: ../index.php?ord=1');
              exit();
            }

      ?>
    <nav class="navbar navbar-light bg-danger">
        <a class="navbar-brand text-white font-weight-bold" href="../index.php?ord=1" style="margin-left: 45%;">Pokedex</a>
    </nav>

    <div class="container mt-5">
        <form action="addRegion.php" method="post">
        <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Nombre</span>
  </div>
  <input type="text" class="form-control" placeholder="Nombre de Region" aria-label="Username" aria-describedby="basic-addon1" name="Rnombre">
</div>
<div class="input-group mb-3" style="padding-right: 50%;">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Color de Region</span>
  </div>
  <input type="color" class="form-control" name="Rcolor" value="#e2db03">
</div>
<button type="submit" class="btn btn-success">Crear</button>
    </div>
        </form>
    
   

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>