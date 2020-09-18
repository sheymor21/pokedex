<!doctype html>
<html lang="en">
  <head>
    <title>Pokedex</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      <?php;
          require_once "interfaces/iServicePokemons.php";
         require_once "interfaces/iJsonService.php";
          require_once "interfaces/iJsonImplement.php";
          require_once "Logic/Logic.php";
         require_once "Logic/JsonService/JsonImplement.php";
          require_once "OtherObject/Region.php";
          require_once "OtherObject/Type.php";
          require_once "Pokemons/pokemons.php";
          require_once "Database/PokemonContext.php";
          require_once "Logic/DatabaseService/DatabaseService.php";
          require_once "Logic/DatabaseService/DatabaseServiceType.php";
          require_once "Logic/DatabaseService/DatabaseServiceRegion.php";


          $buttonDisabled = 'disabled';
          $logic = new logic();
          $servicionDataB = new DatabaseService("Database");
          $servicioTipo = new DatabaseServiceType("Database");
          $serviciosRegion = new DatabaseServiceregion('Database');
          $listPokemon = $servicionDataB->GetList();
          $listType = $servicioTipo->GetList();
         $listRegion = $serviciosRegion->GetList();

         $validacion = $logic->verificar($listRegion,$listType);

         if($validacion){
           $buttonDisabled = " ";
         }
          
      ?>
    <nav class="navbar navbar-light bg-danger">
        <a class="navbar-brand text-white font-weight-bold" href="index.php?ord=1" style="margin-left: 45%;">Pokedex</a>
    </nav>
    <div class="container mt-5 ">
        <a href="AddPages/addRegion.php" class="btn btn-primary" style="margin-left:25%;">Crear una region</a>
        <a href="AddPages/addType.php" class="btn btn-primary">Crear un tipo de pokemon</a>
        <!--orden  -->
        <div class="btn-group">
            <?php if($_GET['ord'] == 2): ?>
            <a href="index.php?ord=1" class="btn btn-secondary">Thumbnails</a>
            <a href="index.php?ord=2" class="btn btn-dark">Tabla</a>
            <a href="index.php?ord=3" class="btn btn-secondary">Regiones</a>
            <a href="index.php?ord=4" class="btn btn-secondary">Tipos</a>
            <?php endif;?>
            <?php if($_GET['ord'] == 1):?>
            <a href="index.php?ord=1" class="btn btn-dark">Thumbnails</a>
            <a href="index.php?ord=2" class="btn btn-secondary">Tabla</a>
            <a href="index.php?ord=3" class="btn btn-secondary">Regiones</a>
            <a href="index.php?ord=4" class="btn btn-secondary">Tipos</a>
            <?php endif;?>
            <?php if($_GET['ord'] == 3): ?>
            <a href="index.php?ord=1" class="btn btn-secondary">Thumbnails</a>
            <a href="index.php?ord=2" class="btn btn-secondary">Tabla</a>
            <a href="index.php?ord=3" class="btn btn-dark">Regiones</a>
            <a href="index.php?ord=4" class="btn btn-secondary">Tipos</a>
            <?php endif;?>
            <?php if($_GET['ord'] == 4):?>
            <a href="index.php?ord=1" class="btn btn-secondary">Thumbnails</a>
            <a href="index.php?ord=2" class="btn btn-secondary">Tabla</a>
            <a href="index.php?ord=3" class="btn btn-secondary">Regiones</a>
            <a href="index.php?ord=4" class="btn btn-dark">Tipos</a>
            <?php endif;?>
        </div>
        <!-- endOrden -->
    </div>
    <div class="container">
      <a name="" id="contaner" class="btn btn-primary <?php echo $buttonDisabled;?>" href="AddPages/addPokemon.php" role="button">Crear Pokemon</a>
      <!--table-->
      <?php if($_GET['ord'] == 2):?>
      <table class="table table-hover table-dark mt-2 table-bordered">
  <thead>
    <tr>
      <th scope="col-1">Id</th>
      <th scope="col-2">Img</th>
      <th scope="col-2">Nombre</th>
      <th scope="col-2">Tipo</th>
      <th scope="col-2">Region</th>
      <th scope="col-1">Detalles</th>
      <th scope="col-1">Eliminar</th>
      <th scope="col-1">Editar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($listPokemon as $pokemon):?>
      <?php $color = $logic->color($listRegion,$pokemon->region)?>
      <tr style="background-color: <?php echo $color;?>;">
      <th scope="row" class="bg-dark"><?php echo $pokemon->id; ?></th>
      <td class="bg-dark"><img src="AddPages/<?php echo $pokemon->img;?>" alt="cover"srcset="" id="imgI"></td>
      <td class="bg-dark"><?php echo  $pokemon->name; ?></td>
      <td class="bg-dark"><?php echo  $pokemon->type; ?></td>
      <td><?php echo  $pokemon->region; ?></td>
      <td class="bg-dark"><a href="OtherPages/DetallesPage.php?N=<?php echo  $pokemon->name; ?>&T=<?php echo  $pokemon->type; ?>&R=<?php echo  $pokemon->region; ?>&ID=<?php echo $pokemon->id; ?>">Ver Detalles</a></td>
      <td class="bg-dark"><a name="" id="" class="btn btn-outline-danger btn-sm" href="OtherPages/Delete.php?eliminarId=<?php echo $pokemon->id;?>" role="button">eliminar</a></td>
      <td class="bg-dark"><a name="" id="" class="btn btn-outline-secondary <?php echo $buttonDisabled?>" href="AddPages/update.php?ID=<?php echo $pokemon->id;?>" role="button">editar</a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
      <?php endif;?>
      <!--endTable-->
      <!-- table region -->
      <?php if($_GET['ord'] == 3):?>
      <table class="table table-hover table-dark mt-2 table-bordered">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Eliminar</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($listRegion as $Region):?>
      <?php $color = $logic->color($listRegion,$Region->color)?>
      <tr style="background-color: <?php echo $color;?>;">
      <th scope="row" class="bg-dark"><?php echo $Region->id; ?></th>
      <td class="bg-dark"><?php echo $Region->name;?></td>
      <td class="bg-dark"><a name="" id="" class="btn btn-outline-danger btn-sm" href="OtherPages/DeleteRegion.php?eliminarId=<?php echo $Region->id;?>" role="button">eliminar</a></td>
      <td class="bg-dark"><a name="" id="" class="btn btn-outline-secondary" href="OtherPages/updateRegion.php?ID=<?php echo $Region->id;?>" role="button">editar</a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
      <?php endif;?>
      <!-- end table region -->
      <!-- tabla de tipos -->
      <?php if($_GET['ord'] == 4):?>
      <table class="table table-hover table-dark mt-2 table-bordered">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Eliminar</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($listType as $Type):?>
      <tr>
      <th scope="row" class="bg-dark"><?php echo $Type->id; ?></th>
      <td class="bg-dark"><?php echo $Type->name;?></td>
      <td class="bg-dark"><a name="" id="" class="btn btn-outline-danger btn-sm" href="OtherPages/DeleteType.php?eliminarId=<?php echo $Type->id;?>" role="button">eliminar</a></td>
      <td class="bg-dark"><a name="" id="" class="btn btn-outline-secondary" href="OtherPages/updateType.php?ID=<?php echo $Type->id;?>" role="button">editar</a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
      <?php endif;?>
      <!-- end tabla de tipos -->
      <!-- thumbnails  -->
      <?php if($_GET["ord"] == 1):?>
        <div class="row">
        <?php foreach($listPokemon as $pokemon):?>
          <div class="col-4">
          <div class="card mt-3 bg-dark" style="width: 18rem;">
      
      <img src="AddPages/<?php echo $pokemon->img;?>" class="card-img-top \" alt="...">
      <div class="card-body">
    <h2 class="card-title text-center text-white"><?php echo $pokemon->name;?></h2>
    <a name="" id="buton-delete" class="btn btn-outline-danger btn-sm" href="OtherPages/Delete.php?eliminarId=<?php echo $pokemon->id;?>" role="button">eliminar</a>
  </div>
</div>

          </div>
        <?php endforeach;?>
        </div>
      <?php endif; ?>
      <!-- Endthumbnails  -->
    </div>

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>