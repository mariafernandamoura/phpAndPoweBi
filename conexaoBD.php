<?php
    /*conexaoBD.php*/

    try {        
        // conexão PDO    // IP, nomeBD, usuario, senha    
        $db =  'mysql:host=localhost;dbname=cl202252;charset=utf8';
        $user = 'cl202252';
        $passwd = 'cl*28092006';
        $pdo = new PDO($db, $user, $passwd);
        
        // ativar o depurador de erros
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
    } catch (PDOException $e) {
        $output = 'Impossível conectar BD : ' . $e . '<br>';
        echo $output;
    }    
?>