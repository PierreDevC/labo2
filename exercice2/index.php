<?php
// Obtenir le mois et l'année actuel
$month = date('n');
$year = date('Y');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Tableau des événements
$events = [];
if (file_exists('events.txt')) {
    $events = file('events.txt', FILE_IGNORE_NEW_LINES);
}

// traiter le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $event = $_POST['event'];
    file_put_contents('events.txt', "$date: $event\n", FILE_APPEND);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier Simple</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?php echo date('F Y'); ?></h1>
    
    <table>
        <tr>
            <th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th>
            <th>Ven</th><th>Sam</th><th>Dim</th>
        </tr>
        <?php
        $firstDay = date('N', strtotime("$year-$month-01"));
        $day = 1;
        echo "<tr>";
        
        // Cases vides jusqu'au 1er jour du mois
        for ($i = 1; $i < $firstDay; $i++) {
            echo "<td></td>";
        }
        
        // Remplir les jours du mois
        while ($day <= $daysInMonth) {
            if ($firstDay > 7) {
                echo "</tr><tr>";
                $firstDay = 1;
            }
            
            $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
            $isWeekend = ($firstDay == 6 || $firstDay == 7);
            
            echo "<td class='" . ($isWeekend ? 'weekend' : '') . "'>";
            echo $day;
            
            // Afficher les événements du jour
            foreach ($events as $event) {
                if (strpos($event, $date) === 0) {
                    echo "<div class='event'>" . substr($event, 11) . "</div>";
                }
            }
            
            echo "</td>";
            
            $day++;
            $firstDay++;
        }
        echo "</tr>";
        ?>
    </table>

    <h2>Ajouter un événement</h2>
    <form method="post">
        <input type="date" name="date" required>
        <input type="text" name="event" placeholder="Description" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>