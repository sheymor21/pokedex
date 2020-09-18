<!doctype html>
<html lang="en">
  <head>
    <title>Pokedex</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
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
        $logic = new logic();
        $listRegion = $serviciosRegion->GetList();
        $listPokemon = $servicionDataB->GetList();
        $nombre = $_GET['N'];
        $tipo = $_GET['T'];
        $region = $_GET['R'];
        $id = $_GET['ID'];
        $color = $_GET['C'];
        $mov1 = "no tiene";
        $mov2 = "no tiene";
        $mov3 = "no tiene";
        $mov4 = "no tiene";
       $color = $logic->color($listRegion,$region);

        

        foreach($listPokemon as $pokemon){
          if($pokemon->id == $id){
             $mov1 = $pokemon->mov1;
             $mov2 = $pokemon->mov2;
             $mov3 = $pokemon->mov3;
             $mov4 = $pokemon->mov4;
          }

        }

    
    ?>
  <nav class="navbar navbar-light bg-danger">
        <a class="navbar-brand text-white font-weight-bold" href="../index.php?ord=1" style="margin-left: 45%;">Pokedex</a>
    </nav>
    <div class="container">
    <div class="card mb-3 mt-5 text-white" id="CardDetalle" style="background-color: <?php echo $color;?>;">
    <h4 class="card-title text-center">Region: <?php echo $region;?></h4>
  <img src="../Pokemons/img/maxresdefault.jpg" class="card-img-top" alt="..." id="imgw">
  <div class="card-body text-center">
    <div class="row">
      <div class="col">
      <h4 class="card-title text-right">Nombre: <?php echo $nombre;?></h4>
      </div>
      <div class="col">
      <h4 class="card-title text-left">Tipo: <?php echo $tipo;?></h4>
      </div>
    </div>
    
    <div class="row">
      <div class="col">
        <a href="#" class="btn btn-secondary disabled btn-block" role="button"><?php echo  $mov1; ?></a>
      </div>
      <div class="col">
      <a href="#" class="btn btn-secondary disabled btn-block" role="button"><?php echo  $mov2; ?></a>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col">
        <a href="#" class="btn btn-secondary disabled btn-block" role="button"><?php echo  $mov3; ?></a>
      </div>
      <div class="col">
      <a href="#" class="btn btn-secondary disabled btn-block" role="button"><?php echo  $mov4; ?></a>
      </div>
    </div>
  </div>
</div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>