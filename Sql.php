<?php

try{
  $conn = new PDO("pgsql:host='pgsql03-farm70.uni5.net';dbname=shosp6","shosp6","13aNyLvDIlgGf");
    print "Conexão bem sucedida";
}catch(PDOException $e){
    echo $e->getMessenger();
}

?>



