<?php 
class conexao{	
	public function __construct(){
		$this->ConnectDB();
	}

	public function ConnectDB() : mysqli{
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
			else{
				return $conexao;
			}			
		}
		catch(Exception $ex)
        {
            return $e->getMessage();
        }   
	}
}
?>