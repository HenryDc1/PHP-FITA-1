<?php
$n = 10;
$m = 10;
echo "<table border='1'>";
echo "<tr><td></td>"; 
for ($j = 1; $j <= $m; $j++) {
    echo "<td>" . chr(64 + $j) . "</td>"; 
}
echo "</tr>";
for ($i = 1; $i <= $n; $i++) {
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    for ($j = 1; $j <= $m; $j++) {
        echo "<td></td>"; 
    }
    echo "</tr>";
}
echo "</table>";
?>
