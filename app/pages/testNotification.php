<?php

require_once 'Notification.php';

// Função auxiliar para comparar arrays
function arraysAreEqual($array1, $array2) {
    return $array1 == $array2;
}

// Função para testar o método calculateNotifications
function testCalculateNotifications() {
    $notificationManager = new Notification();

    // Defina os parâmetros para o teste, incluindo a virada de mês
    $startDateTime = '2024-05-30 22:00:00';
    $endDateTime = '2024-06-02 23:00:00';
    $intervalHours = 6;

    // Chame o método que está sendo testado
    $result = $notificationManager->calculateNotifications($startDateTime, $endDateTime, $intervalHours);

    // Defina o resultado esperado
    $expected = [
        '2024-05-30 22:00:00',
        '2024-05-31 04:00:00',
        '2024-05-31 10:00:00',
        '2024-05-31 16:00:00',
        '2024-05-31 22:00:00',
        '2024-06-01 04:00:00',
        '2024-06-01 10:00:00',
        '2024-06-01 16:00:00',
        '2024-06-01 22:00:00',
        '2024-06-02 04:00:00',
        '2024-06-02 10:00:00',
        '2024-06-02 16:00:00',
        '2024-06-02 22:00:00'
    ];

    // Imprima os dados de entrada
    echo "<strong>Dados de Entrada:</strong><br>";
    echo "Data e Hora de Início: $startDateTime<br>";
    echo "Data e Hora de Fim: $endDateTime<br>";
    echo "Intervalo de Horas: $intervalHours<br><br>";

    // Imprima o resultado obtido
    echo "<strong>Resultado Obtido:</strong><br>";
    echo "<pre>";
    print_r($result);
    echo "</pre>";

    // Verifique se o resultado é igual ao esperado
    if (arraysAreEqual($expected, $result)) {
        echo "<br><strong>Test passed.</strong><br>";
    } else {
        echo "<br><strong>Test failed.</strong><br>";
        echo "Expected:<br>";
        echo "<pre>";
        print_r($expected);
        echo "</pre>";
        echo "Got:<br>";
        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }
}

// Execute o teste
testCalculateNotifications();

?>
