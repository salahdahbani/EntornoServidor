<?php
if(!isset($_POST['personas'])){
$personas= [['nombre'=>'Anita','sexo'=>'m','orientacion'=>'bis'],
['nombre'=>'Lolita','sexo'=>'m','orientacion'=>'bis'],
['nombre'=>'Pepito','sexo'=>'h','orientacion'=>'bis'],
['nombre'=>'Juanito','sexo'=>'h','orientacion'=>'bis'],
['nombre'=>'Roberto','sexo'=>'h','orientacion'=>'het'],
['nombre'=>'Antonio','sexo'=>'h','orientacion'=>'het'],
['nombre'=>'Manuela','sexo'=>'m','orientacion'=>'het'],
['nombre'=>'Isabel','sexo'=>'m','orientacion'=>'het'],
['nombre'=>'Jenifer','sexo'=>'m','orientacion'=>'hom'],
['nombre'=>'Susan','sexo'=>'m','orientacion'=>'hom'],
['nombre'=>'Peter','sexo'=>'h','orientacion'=>'hom'],
['nombre'=>'Mike','sexo'=>'h','orientacion'=>'hom']];
}else{
    $personas = @unserialize(base64_decode($_POST['personas']));
}

if(isset($_POST['formar'])){
            $sel = $_POST['idx'];
            $pareja = $_POST['idxPareja'];
            if(isset($_POST['name'])){
            $name = $_POST['name'];
            $name2 = $_POST['name2'];
            echo "<br><br>
        <h3>$name a formado pareja con $name2</h3>";
            }
        }

?>