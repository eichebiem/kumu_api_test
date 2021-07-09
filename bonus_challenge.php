<?php
    function hammingDistance($num1, $num2) {
        $distance = 0;
        $n = $num1 ^ $num2;
        
        while ($n > 0) {
            if (($n&1) == 1) {
                $distance++;
            }
            $n = $n >> 1;
        }
        
        return $distance;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonus Challenge</title>
</head>
<body>
    <?= hammingDistance(1, 4); ?>
</body>
</html>