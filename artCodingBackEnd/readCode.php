<?php
    $codeUrl = $_GET['q'];
    $codeFile = fopen($codeUrl,"r") or die("Unable to open file!");
    echo fread($codeFile,filesize($codeUrl));
    fclose($codeFile);
