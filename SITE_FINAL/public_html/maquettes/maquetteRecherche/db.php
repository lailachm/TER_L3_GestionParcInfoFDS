
<?php
class DB{

private $host = 'localhost';
private $username='id12901849_parcinfofds';
private $password = '';
private $database = 'id12901849_gestion_parcinfofds'; 

public function construct($host = null, $username = null, $password = null, $database = null){
if($host != null){
 $this->host = $host;
 $this->username = $username ;
 $this->password = $password;
 $this->database = $database;
}
try{
$db = new PDO('mysql:host=localhost;dbname=id12901849_gestion_parcinfofds',
'id12901849_parcinfofds','',
array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
}catch(PDOException $e){
 die('<h1>Impossible de se connecter à la base de données</h1>');
}

?>
