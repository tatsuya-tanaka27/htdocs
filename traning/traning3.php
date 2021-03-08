<?php 
    $array = [1,2,3,4];
    $array2 = array(0=>'tanaka',1=>'henmi',2=>'shioda',3=>'shimazu');
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>php</title>
    </head>
    <body>
        <?php 
            for($i = 0; $i < 4; $i++){
                echo $array[$i] . "<br>";
            }

            for($j = 0; $j < 4; $j++){
                echo $array2[$j] . "<br>";
            }
        ?>
    </body>
</html>