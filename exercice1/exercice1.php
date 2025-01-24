<?php

// Fetcher le mois et l'annee en cours
$mois = date('n');
$annee = date('Y');
$joursDansMois = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);

// Tableau pour activités
$activites = [];
$totalActivites = 0;
$maxActivites = 0;
$minActivites = 20;
$jourMax = 1;
$jourMin = 1;

for ($jour = 1; $jour <= $joursDansMois; $jour++) {
    $activites[$jour] = rand(0, 20);
    $totalActivites += $activites[$jour];

    if ($activites[$jour] > $maxActivites) {
        $maxActivites = $activites[$jour];
        $jourMax = $jour;
    }
    if ($activites[$jour] < $minActivites) {
        $minActivites = $activites[$jour];
        $jourMin = $jour;
    }
}

// Afficher rapport
echo "<h2>Rapport d'activités - " .date('F Y') ."</h2>";

// Tableau activités quotidiennes
echo "<table border='1'>
    <tr>
        <th>Jour</th>
        <th>Nombre d'activités</th>
    </tr>";

for ($jour = 1; $jour <= $joursDansMois; $jour++) {
    $date = date('Y-m-d', strtotime("$annee-$mois-$jour"));
    $nomJour = date('l', strtotime($date));

    echo "<tr>";
    echo "<td>$nomJour $jour</td>";

    // Mettre en gras si plus que 15 activités
    if ($activites[$jour] > 15) {
        echo "<td><strong>" . $activites[$jour] . "</strong></td>";
    } else {
        echo "<td>" . $activites[$jour] . "</td>";
    }
    echo"</tr>";
}

echo "</table>";


// Afficher statistiques
echo "<h3>Statistiques du mois</h3>";
echo "<ul>";
echo "<li>Total des activités: $totalActivites</li>";
echo "<li>Jour le plus actif: Jour $jourMax ($maxActivites activités)</li>";
echo "<li>Jour le moins actif: Jour $jourMin ($minActivites activités)</li>";
echo "</ul>";
?>