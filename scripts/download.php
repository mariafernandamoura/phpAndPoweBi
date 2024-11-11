<?php

function unlinkRecursive($dir, $deleteRootToo) 
{ 
    unlink("filesForPowerBi.zip");
    if(!$dh = @opendir($dir)) 
    { 
        return; 
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 

        if (!@unlink($dir . '/' . $obj)) 
        { 
            unlinkRecursive($dir.'/'.$obj, true); 
        } 
    } 
    closedir($dh); 
    if ($deleteRootToo) 
    { 
        @rmdir($dir); 
    } 
    return; 
} 


$arquivo = "filesForPowerBi.zip";
      header("Content-Type: application/zip");
      header("Content-Length: ".filesize($arquivo));
      header("Content-Disposition: attachment; filename=".basename($arquivo));
      readfile($arquivo);
      unlinkRecursive( '../files', false );
      exit; // aborta 


