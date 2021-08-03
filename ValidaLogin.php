<?php
require_once "conexao.php";

$host     = 'localhost';
			$user     = 'root';
			$password = '';
			$database = 'Kabum';

			$conexao =  mysqli_connect($host, $user, $password,$database)  or die ("html>script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)/script>/html>");

$name = $_POST['name'];
$password = $_POST['password'];

$query = "select * from user where name = '".$name."' and password = '" .$password."'";
$result = mysqli_query($conexao,$query) or die(error());

                  
if(mysqli_num_rows($result) == 1){
   $result = mysqli_fetch_array($result);
   header("Location: dirname(__FILE__)/../welcome.php");
   $response = array("success" => false,"msg" => "OK");
}
else{
    $response = array("success" => true,"msg" => "Acesso nao autorizado!");
}

mysqli_close($conexao);

echo json_encode($response);
?>