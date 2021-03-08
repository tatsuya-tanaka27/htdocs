<?php 
    $array = [1,2,3,4];
    $array2 = array(1=>'tanaka',2=>'henmi',3=>'shioda',4=>'shimazu');

    for($i = 0; $i < 4; $i++){
        echo $array[$i] . "<br>";
    }

    for($j = 0; $j < 4; $j++){
        echo $array2[$j] . "<br>";
    }
?>