<?php

require_once 'Notification.php';

$notificationManager = new Notification();

$startDateTime = '2024-05-27 08:00:00';
$endDateTime = '2024-05-28 08:00:00';
$intervalHours = 6;

$notifications = $notificationManager->calculateNotifications($startDateTime, $endDateTime, $intervalHours);


echo "Notificações:\n";
foreach ($notifications as $notification) {
    echo $notification . "<br />";
}

?>
