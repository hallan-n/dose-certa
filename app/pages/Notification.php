<?php

class Notification {
    
    public function calculateNotifications($startDateTime, $endDateTime, $intervalHours) {
        $start = new DateTime($startDateTime);
        $end = new DateTime($endDateTime);
        $interval = new DateInterval('PT' . $intervalHours . 'H');

        $notifications = [];

        while ($start <= $end) {
            $notifications[] = $start->format('Y-m-d H:i:s');
            $start->add($interval);
        }

        return $notifications;
    }
}

?>
