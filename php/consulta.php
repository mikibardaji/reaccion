<?php
// Conexión a la base de datos
require "conexion.php";


function escribirEcho($parametro1) {

    $tamanyo_letra = "<p style='font-size: 28px;'>";
    $fin_tamanyo_letra = "</p>";
    echo $tamanyo_letra . $parametro1 . $fin_tamanyo_letra;
}

/* funció que comproba si les lletres que estem mostrant son ja les totals de la paraula o més*/
function final_paraula($posicio1, $longitud1) {

    if ($posicio1 >= $longitud1)
                {
                    $revisada_final = 1;
                }
                else
                {
                    $revisada_final = 0;
                }
     return $revisada_final;
}
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}



// Consulta 1
//per trobar la primera cadena que te alguna sense acertar (revisada) pero que també en te alguna revisada.
$sql_cadena_toca = " select DISTINCT n_cadena from reaccion
where n_cadena =  ( select min(n_cadena) from reaccion where revisada = 0)
and n_cadena IN   ( select distinct (n_cadena) from reaccion where revisada = 1)";
$result = $conn->query($sql_cadena_toca);
        
 if ($result->num_rows > 0) 
   {
    $row = $result->fetch_assoc();
    $num_cadena = $row['n_cadena']; 
   }
 else
   {
    $num_cadena = 1;
   }

   /* aquesta part de sql, es per agafaar el primer registre no revisat
   de la cadena que estem tractant*/
$sql_final = " and n_cadena =  " . $num_cadena . " 
and ordre_secuencia =( select MAX(ordre_secuencia) + 1 
from reaccion where n_cadena = " . $num_cadena . " and revisada = 1)";

if (isset($_POST['consulta1']))  
    {
       // $buttonValue = $_POST['buttonValue'];
       // if ($buttonValue === 'consulta1') {
            $sql = "SELECT palabra FROM reaccion
            where revisada = 1  and n_cadena = ".
            $num_cadena .
            " order by ordre_secuencia desc
            LIMIT 1";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                // Mostrar el resultado de la consulta
                $row = $result->fetch_assoc();
                escribirEcho("Resultado de la consulta 1: " . $row["palabra"] . "<br>");
                //echo "Resultado de la consulta 1: " . $row["palabra"] . "<br>";
            } else {
                escribirEcho("No se encontraron resultados para la consulta 1.");
                //echo ;
            }
        

            $sql = "SELECT SUBSTR(palabra,1,pos) as palabra, palabra as toda, pos, length(palabra) as longitud  FROM reaccion 
                    where revisada = 0 " . $sql_final . " order by ordre_secuencia desc LIMIT 1 ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
                // Mostrar el resultado de la consulta
                $row = $result->fetch_assoc();
                escribirEcho("Resultado de la consulta 2: " . $row["palabra"]);
                //actualitzo la posicio per que si torno a apretar el boto 1, mostri una lletra més.
                $toda = $row["toda"];

                //comprobo si estic al final per passar de paraula perque no l'he encertat
                $revisada_final = final_paraula($row["pos"],$row["longitud"]);



                    $updateSql = "update reaccion set pos=pos+1, revisada=" . $revisada_final . 
                    " WHERE palabra = '$toda' and revisada = 0 " . $sql_final;
                    if ($conn->query($updateSql) === TRUE && $revisada_final=== 0) 
                        {
                            escribirEcho("Quina es!!!");
                        }
                    else if ($revisada_final === 0)
                        {
                            escribirEcho("Heu encertat!!! pero no s'ha pogut marcar la paraula com acertada");
                        }
                    else
                        {
                            escribirEcho("No heu encertat ko!!!");
                        }
            } else {
                escribirEcho("No se encontraron resultados para la consulta 2.");
            }
       // }


    }

    // Consulta 2, mira si has encertat la paraula
if (isset($_POST['consulta2']))     
    {
        $palabra_introducida = $_POST['buscar'];
        $texto = strtoupper($palabra_introducida);
        $sql = "SELECT palabra FROM reaccion 
        WHERE UPPER(palabra) = '$texto' and
        revisada = 0 ". $sql_final;
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $updateSql = "update reaccion set revisada = 1, pos=1
            WHERE UPPER(palabra) = '$texto' and
            revisada = 0 ". $sql_final;
            if ($conn->query($updateSql) === TRUE) {
                escribirEcho("Heu encertat!!!");
            }
            else
            {
                escribirEcho("Heu encertat!!! pero no s'ha pogut marcar la paraula com acertada");
            }
            
        } else {
            escribirEcho("El texto '$texto' no se encontró en la tabla.");
        }

    }


// Cerrar la conexión a la base de datos
$conn->close();
?>
