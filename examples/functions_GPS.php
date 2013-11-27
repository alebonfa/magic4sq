<?php
    function distancia($p1LA, $p1LO, $p2LA, $p2LO) {
        $r = 6371.0;
        $p1LA = $p1LA * pi() / 180.0;
        $p1LO = $p1LO * pi() / 180.0;
        $p2LA = $p1LA * pi() / 180.0;
        $p2LO = $p1LO * pi() / 180.0;
        $dLat = $p2LA - $p1LA;
        $dLong = $p2LO - $p2LO;
        $a = sin($dLat / 2) * sin($dLat / 2) + cos($p1LA) * cos($p2LA) * sin($dLong / 2) * sin($dLong / 2);
        $c = 2 * atan2(sqrt($a), sqrt( 1 - $a));
        return round($r * $c * 1000);
    }
?>