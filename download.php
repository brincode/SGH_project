<?php 
include 'dbconn.php';
$result = $conn->query('SELECT * FROM `data`');
if (!$result) die('Couldn\'t fetch records');
$headers = ['Time',"Day","Hour",'Moisture',"Temperature","Humidity",'EC Sensor'];
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

?>