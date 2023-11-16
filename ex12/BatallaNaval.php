<?php
function generarTablero($n, $m)
{
    $tablero = array();
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $m; $j++) {
            $tablero[$i][$j] = 0; // Inicializa todas las posiciones del tablero a 0
        }
    }
    return $tablero;
}

function colocarBarco(&$tablero, $fila, $columna, $longitud, $direccion, $tipo)
{
    // Verifica si hay espacio para colocar el barco en la dirección especificada
    $espacioSuficiente = true;
    if ($direccion == 'horizontal') {
        if ($columna + $longitud - 1 > count($tablero[1])) {
            $espacioSuficiente = false;
        } else {
            for ($j = $columna; $j < $columna + $longitud; $j++) {
                if ($tablero[$fila][$j] != 0) {
                    $espacioSuficiente = false;
                    break;
                }
            }
        }
    } elseif ($direccion == 'vertical') {
        if ($fila + $longitud - 1 > count($tablero)) {
            $espacioSuficiente = false;
        } else {
            for ($i = $fila; $i < $fila + $longitud; $i++) {
                if ($tablero[$i][$columna] != 0) {
                    $espacioSuficiente = false;
                    break;
                }
            }
        }
    }

    // Coloca el barco en el tablero si hay espacio suficiente
    if ($espacioSuficiente) {
        if ($direccion == 'horizontal') {
            for ($j = $columna; $j < $columna + $longitud; $j++) {
                $tablero[$fila][$j] = $tipo; // Usa el tipo como identificador del barco
            }
        } elseif ($direccion == 'vertical') {
            for ($i = $fila; $i < $fila + $longitud; $i++) {
                $tablero[$i][$columna] = $tipo; // Usa el tipo como identificador del barco
            }
        }
    }
}

function mostrarTablero($tablero)
{
    $n = count($tablero);
    $m = count($tablero[1]);

    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><td style='padding: 10px;'></td>";

    // Imprime las letras de las columnas
    for ($j = 1; $j <= $m; $j++) {
        echo "<td style='padding: 10px;'>" . chr(64 + $j) . "</td>";
    }
    echo "</tr>";

    // Imprime el tablero
    for ($i = 1; $i <= $n; $i++) {
        echo "<tr>";
        echo "<td style='padding: 10px;'>" . $i . "</td>";

        for ($j = 1; $j <= $m; $j++) {
            $color = getColor($tablero[$i][$j]);
            echo "<td style='padding: 10px; background-color: $color'></td>";
        }

        echo "</tr>";
    }
    echo "</table>";
}

function getColor($tipo)
{
    // Asigna un color diferente para cada tipo de barco
    switch ($tipo) {
        case 1: // Fragata
            return "#3498db"; // Azul
        case 2: // Submarino
            return "#e74c3c"; // Rojo
        case 3: // Destructor
            return "#2ecc71"; // Verde
        case 4: // Portaaviones
            return "#f39c12"; // Amarillo
        default:
            return "#ffffff"; // Blanco para posiciones vacías
    }
}

// Definir el tamaño del tablero
$n = 10;
$m = 10;

// Crear un tablero vacío
$tablero = generarTablero($n, $m);

// Crear una partida aleatoria
$barcos = array(
    array("tipo" => "fragata", "longitud" => 1),
    array("tipo" => "submarino", "longitud" => 2),
    array("tipo" => "destructor", "longitud" => 3),
    array("tipo" => "portaaviones", "longitud" => 4)
);

foreach ($barcos as $indice => $barco) {
    do {
        $fila = rand(1, $n);
        $columna = rand(1, $m);
        $direccion = rand(0, 1) == 0 ? 'horizontal' : 'vertical';
    } while ($columna + $barco['longitud'] - 1 > $m && $direccion == 'horizontal' || $fila + $barco['longitud'] - 1 > $n && $direccion == 'vertical');

    colocarBarco($tablero, $fila, $columna, $barco['longitud'], $direccion, $indice + 1);
}

// Mostrar el tablero con los barcos colocados
mostrarTablero($tablero);
?>