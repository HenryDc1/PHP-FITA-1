
<?php
$n = 10;
$m = 0;

echo "<table border='1'>";

for ($i = $m; $i <= $n; $i++) {
    echo "<tr>";
    for ($j = $m; $j <= $n; $j++) {
        echo "<td>" . ($i + $j) . "</td>";
    }
    echo "</tr>";
}

echo "</table>";

