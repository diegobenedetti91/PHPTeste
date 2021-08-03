<?php
session_start();
require_once('../conexao.php');
require_once('../Interface/InterfaceDAO.php');


class UserDB implements InterfaceDAO {

    public function __construct(){
       
    }

    public function save(){
      try
      {
         return '';
      }
      catch(Exception $ex)
      {
         echo $e->getMessage();
      } 
    }

    public function update(){
      try
      {
         return '';
      }
      catch(Exception $ex)
      {
         echo $e->getMessage();
      } 
    }

    public function delete($id){
      try
      {
         return '';
      }
      catch(Exception $ex)
      {
         echo $e->getMessage();
      } 
    }

    public function getAll() : array{
      try
      {
         return '';
      }
      catch(Exception $ex)
      {
         echo $e->getMessage();
      } 
    }

    public function getForID($id){
      try
      {
         return '';
      }
      catch(Exception $ex)
      {
         echo $e->getMessage();
      } 
    }

    public function Login($name, $password){
        try
        {
            $host     = 'localhost';
            $user     = 'root';
            $password = '';
            $database = 'Kabum';

            $conexao =  mysqli_connect($host, $user, $password,$database)  or die ("html>script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)/script>/html>");
            if (!$conexao) {
               die('Nao conectou! - ' . mysql_error());
            }            	
            
            $query = "select * from user where name = '".$name."' and password = '" .$password."'";
            
            $result = mysqli_query($conexao,$query);
                  
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
        }
        catch(Exception $ex)
        {
            return $e->getMessage();
        }        
     }

   
     function Logout(){
        session_destroy();
        echo "OK";
     }
}

 function Login(){
   try
   {
       $host     = 'localhost';
       $user     = 'root';
       $password = '';
       $database = 'Kabum';

       $conexao =  mysqli_connect($host, $user, $password,$database)  or die ("html>script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)/script>/html>");
       if (!$conexao) {
          die('Nao conectou! - ' . mysql_error());
       }            	
       $name = $_POST['name'];
       $password = $_POST['password'];

       $query = "select * from user where name = '".$name."' and password = '" .$password."'";

       $result = mysqli_query($conexao,$query);

       if(mysqli_num_rows($result) == 1){        
          $response = array("success" => false,"msg" => "OK");
       }
       else{
           $response = array("success" => true,"msg" => "Acesso nao autorizado!");
       }
       
       mysqli_close($conexao);
       
       echo json_encode($response);
   }
   catch(Exception $ex)
   {
       return $e->getMessage();
   }        
}

if (isset($_POST['name']) && isset($_POST['password'])) {
   echo Login();
  }
?>