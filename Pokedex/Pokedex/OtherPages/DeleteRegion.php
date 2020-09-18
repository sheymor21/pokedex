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
 
 

$servicio = new DatabaseServiceregion();

$isId = isset($_GET['eliminarId']);

if($isId){
    $RegionId = $_GET['eliminarId'];
    $servicio->Delete($RegionId);
}
header("Location: ../index.php?ord=3");
exit();

?>