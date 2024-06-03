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


    public function addNotifications($conn, $medication_id, $startDateTime, $endDateTime, $intervalHours) {

        $notifications = $this->calculateNotifications($startDateTime, $endDateTime, $intervalHours);

        $createNotificationTableQuery = "
            CREATE TABLE IF NOT EXISTS notifications (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                medication_id INT NOT NULL,
                notification_datetime VARCHAR NOT NULL,
                FOREIGN KEY (medication_id) REFERENCES medication(id)
            )
        ";
        $conn->exec($createNotificationTableQuery);

        $stmt = $conn->prepare("INSERT INTO notifications (medication_id, notification_datetime) VALUES (:medication_id, :notification_datetime)");
        foreach ($notifications as $notification_datetime) {
            $stmt->bindParam(':medication_id', $medication_id);
            $stmt->bindParam(':notification_datetime', $notification_datetime);
            $stmt->execute();
        }
    }

    public function deleteNotifications($conn, $medication_id) {
        $stmt = $conn->prepare("DELETE FROM notifications WHERE medication_id = :medication_id");
        $stmt->bindParam(':medication_id', $medication_id);
        $stmt->execute();
    }


}

?>
