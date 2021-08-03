<?php
require_once('../conexao.php');
require_once('../Interface/InterfaceDAO.php');
require_once('../Model/Client.php');

    class ClientDB implements InterfaceDAO {

        public function __construct(){
            //$conn = new conexao();
        }

        public function save(){
            try
            {

            }
            catch(Exception $ex)
            {
                return $e->getMessage();
            }  
        }

        public function update(){
            try
            {
                $query = mysqli_query(" update  client set name = '" .$name . "', birthDate = " .$birthDate .", CPF = '" .$CPF."', RG = '" .$RG ."',telephone = '". $telephone."' where id = ". $idClient);
                      
                if(mysqli_num_rows($query) > 0){                
                    return "OK";
                }else{
                    $error = "Não foi possível alterar o cliente!";
                    return $error;
                }
            }
            catch(Exception $ex)
            {
                return $e->getMessage();
            }  
        }

        public function delete($id){
            try
            {
                $query = mysqli_query(" delete from client where id = ". $idClient);
                      
                if(mysqli_num_rows($query) > 0){                
                    return "OK";
                }else{
                    $error = "Não foi possível excluir o cliente!";
                    return $error;
                }
            }
            catch(Exception $ex)
            {
                return $e->getMessage();
            }  
        }

        public function getAll() : array{
            try
            {
                $query = mysqli_query(" select * from clients ");
                      
                if(mysqli_num_rows($query) > 0){                
                    return "OK";
                }else{
                    $error = "Não foi encontrado nenhum cliente!";
                    return $error;
                }
            }
            catch(Exception $ex)
            {
                return $e->getMessage();
            }  
        }

        public function getForID($id){
            try
            {
                $query = mysqli_query(" select * from clients where id = " . $idClient);
                      
                if(mysqli_num_rows($query) == 1){                
                    return "OK";
                }else{
                    $error = "Não foi encontrado nenhum cliente!";
                    return $error;
                }
            }
            catch(Exception $ex)
            {
                return $e->getMessage();
            }  
        }
    }

    function save(){
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
            $birthDate = $_POST['dtbirth'];  
            $CPF = $_POST['CPF'];  
            $RG = $_POST['RG'];  
            $telephone = $_POST['Telefone'];  
                  
            $query = " INSERT INTO  clients(name,dtbirth,CPF,RG,telephone,dtcreate) VALUES('" .$name . "', '" .$birthDate ."', '" .$CPF."', '" .$RG ."','". $telephone."',NOW())";
  
            $result = mysqli_query($conexao,$query);
         
            if(mysqli_affected_rows($conexao) > 0){                
                $response = array("success" => true,"msg" => "Cliente inserido com sucesso!");    
            }
            else{
                $response = array("success" => true,"msg" => "Não foi possível incluir o cliente!");    
            }

            mysqli_close($conexao);

            echo json_encode($response);
        }
        catch(Exception $ex)
        {
            return $e->getMessage();
        }  
    }

    function update(){
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

            $id = $_POST['idCliente'];            
            $name = $_POST['name'];  
            $birthDate = $_POST['dtbirth'];  
            $CPF = $_POST['CPF'];  
            $RG = $_POST['RG'];  
            $telephone = $_POST['Telefone'];  
                  
            $query = " update  clients set name = '" .$name . "', dtbirth = '" .$birthDate ."', CPF = '" .$CPF."', RG = '" .$RG ."',telephone = '". $telephone."' where id = ". $id;
           // echo $query;
            $result = mysqli_query($conexao,$query);
         
            if(mysqli_affected_rows($conexao) > 0){                
                $response = array("success" => true,"msg" => "Cliente alterado com sucesso!");    
            }
            else{
                $response = array("success" => true,"msg" => "Não foi possível alterar o cliente!");    
            }

            mysqli_close($conexao);

            echo json_encode($response);
        }
        catch(Exception $ex)
        {
            return $e->getMessage();
        }  
    }

    function delete(){
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

            $id = $_POST['idCliente'];
            
            $query = " delete from clients where id = ". $id;
            
            $result = mysqli_query($conexao,$query);
         
            if(mysqli_affected_rows($conexao) > 0){                
                $response = array("success" => true,"msg" => "Cliente excluído com sucesso!");    
            }
            else{
                $response = array("success" => true,"msg" => "Não foi excluir o cliente!");    
            }

            mysqli_close($conexao);

            echo json_encode($response);
        }
        catch(Exception $ex)
        {
            $response = array("success" => true,"msg" => $e->getMessage());   
            echo json_encode($response);
        }  
    }

    function getForID(){
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

            $id = $_GET['id'];

            $query = " select * from clients where id = " . $id;
            
            $result = mysqli_query($conexao,$query);

            if(mysqli_num_rows($result) > 0){                
                $response = array();
                while($row = mysqli_fetch_array($result)){                    
                    $client = new Client();   
                    $client->id =  $row["id"];
                    $client->name =  $row["name"];
                    $client->dtbirth =  $row["dtbirth"];
                    $client->CPF =  $row["CPF"];
                    $client->RG =  $row["RG"];
                    $client->telephone =  $row["telephone"];
                    $response['Clientes'][] = $client;
                };
            }else{
                $response = array("success" => true,"msg" => "Não foi encontrado nenhum cliente!");                
            }

            mysqli_close($conexao);

            echo json_encode($response);
        }
        catch(Exception $ex)
        {
            $response = array("success" => true,"msg" => $e->getMessage());   
            echo json_encode($response);
        }  
    }
 

    function getAll(){
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

            $query = " select * from clients ";
            
            $result = mysqli_query($conexao,$query);

            if(mysqli_num_rows($result) > 0){   
                $response = array();
                while($row = mysqli_fetch_array($result)){  
                    $client = new Client();   
                    $client->id =  $row["id"];
                    $client->name =  $row["name"];
                    $client->dtbirth =  $row["dtbirth"];
                    $client->CPF =  $row["CPF"];
                    $client->RG =  $row["RG"];
                    $client->telephone =  $row["telephone"];
                    $response['Clientes'][] = $client;
                };
                            
            }else{
                $response = array("success" => true,"msg" => "Não foi encontrado nenhum cliente!");                
            }

            mysqli_close($conexao);

            echo json_encode($response);
        }
        catch(Exception $ex)
        {
            $response = array("success" => true,"msg" => $e->getMessage());   
            echo json_encode($response);
        }  
    }

    if(isset($_GET['getClient'])){
        echo getAll();
    }

    if(isset($_GET['getClientForID'])){
        echo getForID();
    }

    if(isset($_POST['deleteClient'])){
        echo delete();
    }

    if(isset($_POST['updateClient'])){
        echo update();
    }

    if(isset($_POST['saveClient'])){
        echo save();
    }
?>