<?php


function dameTarjeta($perfil){
    $tarjeta = [];

    if($perfil == "admin"){
    
        $tarjeta = [
            ['A'=>12,'B'=>34,'C'=>56,'D'=>78,'E'=>90],
            ['A'=>11,'B'=>22,'C'=>33,'D'=>44,'E'=>55],
            ['A'=>10,'B'=>20,'C'=>30,'D'=>40,'E'=>50],
            ['A'=>9,'B'=>8,'C'=>7,'D'=>6,'E'=>5],
            ['A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5]
        ];
    } else {
        $tarjeta = [
            ['A'=>5,'B'=>10,'C'=>15,'D'=>20,'E'=>25],
            ['A'=>30,'B'=>35,'C'=>40,'D'=>45,'E'=>50],
            ['A'=>55,'B'=>60,'C'=>65,'D'=>70,'E'=>75],
            ['A'=>80,'B'=>85,'C'=>90,'D'=>95,'E'=>100],
            ['A'=>105,'B'=>110,'C'=>115,'D'=>120,'E'=>125]
        ];
    }

    return $tarjeta;
}


function compruebaClave($tarjeta, $fila, $columna, $valor){
    $fila_index = intval($fila)-1; 
    if($fila_index < 0 || $fila_index > 4) return false;
    if(!isset($tarjeta[$fila_index][$columna])) return false;

    if($tarjeta[$fila_index][$columna] == intval($valor)){
        return true;
    } else {
        return false;
    }
}


function imprimeTarjeta($tarjeta){
    $html = "<table border='1' cellpadding='5' style='border-collapse:collapse;'>";
    $html .= "<tr><th></th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th></tr>";

    for($i=0;$i<5;$i++){
        $html .= "<tr>";
        $html .= "<td>".($i+1)."</td>";
        foreach(['A','B','C','D','E'] as $col){
            $html .= "<td>".$tarjeta[$i][$col]."</td>";
        }
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}
?>
