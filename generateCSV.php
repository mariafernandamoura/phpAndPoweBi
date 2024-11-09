<?php

    include('conexaoBD.php');

    try{

        $stmt = $pdo->prepare("select * from users");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "erro".$e->getMessage();
    }



    $filename = "users.csv";
    $delimiter = ";";
    $f = fopen('php://memory', 'w'); // cria ponteiro
    $fields = array_keys(current($users)); // pega os nomes das colunas
    fputcsv($f, $fields, $delimiter); // escreve o nome das colunas no csv

    foreach ($users as $user) {
        fputcsv($f, $user, $delimiter);
    }

    fseek($f, 0);

    // Set the HTTP headers to download the CSV file rather than displaying it
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    // Output all the remaining data on a file pointer
    fpassthru($f);


    fclose($f);
    $pdo = null;
    exit;

?>