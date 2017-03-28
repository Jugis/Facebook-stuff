<?php

$myfile = fopen("cucc.txt", "w") or die("Unable to open file!");
$txt = "asd";
fwrite($myfile, $txt);
fclose($myfile);

?>