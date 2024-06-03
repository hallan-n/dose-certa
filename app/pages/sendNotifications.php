<?php

require 'SMS.php';

$db = new PDO('sqlite:database.sqlite');

$currentDateTime = (new DateTime())->format('Y-m-d H:i');
$query = $db->prepare('
    SELECT notifications.id, notifications.notification_datetime, medication.name as medication_name, users.tel as user_phone
    FROM notifications
    JOIN medication ON notifications.medication_id = medication.id
    JOIN users ON medication.user_id = users.id
    WHERE notification_datetime = :currentDateTime
');
$query->execute(['currentDateTime' => $currentDateTime]);
$notifications = $query->fetchAll(PDO::FETCH_ASSOC);

// Enviar SMS para cada notificação
if ($notifications) {
    $authKey = '123';
    $smsSender = new SMS($authKey);

    foreach ($notifications as $notification) {
        $sender = '77282';
        $notification['user_phone_number'] = str_replace(['(', ')', '-'], '', $notification['user_phone']);
        $receivers = '+55' . $notification['user_phone_number'];
        $notificationTime = (new DateTime($notification['notification_datetime']))->format('H:i');
        $content = 'Você tem uma nova notificação de medicação: ' . $notification['medication_name'] . ' às ' . $notificationTime;

        $result = $smsSender->sendSMS($sender, $receivers, $content);

        if ($result['success']) {
            echo "SMS enviado com sucesso para notificação ID: " . $notification['id'] . PHP_EOL;
        } else {
            echo "Erro ao enviar SMS para notificação ID: " . $notification['id'] . ". Erro: " . $result['error'] . PHP_EOL;
        }
    }
}
?>
