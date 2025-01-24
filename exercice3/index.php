<?php


// Tableau des tâches
$planning = [];
if (file_exists('planning.txt')) {
    $planning = file('planning.txt', FILE_IGNORE_NEW_LINES);
}

// Prendre variables POST (date de départ + date de fin + tâche +duration)
// 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateDebut = new DateTime($_POST['date_debut']);
    $dateFin = new DateTime($_POST['date_fin']);
    $duree = $POST['duree'];
}






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- ... 
    Formulaire HTML
    date de départ
    date de fin

    Tache 1 (textarea) (duration number max 24 heures)

    submit

    -->
    <form method="POST">
        Date de début : <input type="date" name="date_debut" required><br><br>
        Date de fin : <input type="date" name="date_fin" required><br><br>
        Tâche 1 : <input type="text" name="desc" placeholder="Tache 1" required><br><br>
        Duration (en heures) : <input type="number" min="1" max="24" placeholder="Duration" required><br><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>