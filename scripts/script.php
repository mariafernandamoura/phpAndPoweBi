<?php
    function generateFiles(){
        $pathdir = "../files/";
        $zipcreated = "filesForPowerBi.zip";
        $newzip = new ZipArchive;
        if($newzip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
            $dir = opendir($pathdir);
            while($file = readdir($dir)) {
               if(is_file($pathdir.$file)) {
                  $newzip -> addFile($pathdir.$file, $file);
               }
            }
            $newzip ->close();
         }
    }

    function prepareContent($file){
        try {
            include('../connection/conexaoBD.php');

            switch ($file) {
                case "user":
                    $stmt = $pdo->prepare("SELECT * FROM users");
                    break;
                case "tagExpense":
                    $stmt = $pdo->prepare("SELECT * FROM tagExpense");
                    break;
                case "expense":
                    $stmt = $pdo->prepare("SELECT * FROM Expense");
                    break;
                case "asset":
                    $stmt = $pdo->prepare("SELECT * FROM Asset");
                    break;
                case "tagAsset":
                    $stmt = $pdo->prepare("SELECT * FROM tagAsset");
                    break;
            }
            $stmt->execute();
            $f = fopen('../files/'.$file.'.csv', 'w');
            $colunasTitulo = [];
            $colCount = $stmt->columnCount();
            for ($i = 0; $i < $colCount; $i++) {
                $colMeta = $stmt->getColumnMeta($i);
                $colunasTitulo[] = $colMeta['name'];
            }
            
            fputcsv($f, $colunasTitulo);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($f, $row);
            }
            fclose($f);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            exit;
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $selectedFiles = $_POST['fileOp'];

        if($selectedFiles == ""){
            echo "escolha";
        }else{
            if(in_array('user', $selectedFiles)){   
                prepareContent("user");     
            }
            if(in_array('expense', $selectedFiles)){
                prepareContent("expense");     
            }
            if(in_array('tagExpense', $selectedFiles)){
                prepareContent("tagExpense");     
            }
            if(in_array('asset', $selectedFiles)){
                prepareContent("asset");     
            }
            if(in_array('tagAsset', $selectedFiles)){
                prepareContent("tagAsset");     
            }
        }
        generateFiles();
        include('download.php');
    }
