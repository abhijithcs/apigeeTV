<?php
$file = fopen('https://dashboard.apigee.net/render/?target=alias(dashed(timeShift(metrics.googleanalytics.all.visits%2C "1week"))%2C "Past week")&format=csv',"r");
print_r(fgetcsv($file));
fclose($file);
?>
