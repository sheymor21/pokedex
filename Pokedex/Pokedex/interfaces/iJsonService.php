<?php 
interface iJson{

function GetList();
function Add($entidad);
function Update($id,$entidad);
function Delete($id);
function GetbyId($id);
}


?>