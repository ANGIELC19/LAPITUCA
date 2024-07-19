<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['message'])) {
        $message = strtolower($input['message']);
        $response = "";

        if (strpos($message, 'reserva') !== false) {
            $response = "Para hacer una reserva, por favor llámanos al 967 525 084 o visita nuestra página web en www.broasteria.com/reservas";
        } elseif (strpos($message, 'hora') !== false) {
            $response = "Nuestro horario de atención es de lunes a domingo de 18:00 a 22:00.";
        } elseif (strpos($message, 'menu') !== false || strpos($message, 'carta') !== false) {
            $response = "Puedes ver nuestro menú completo en www.broasteria.com/menu";
        } elseif (strpos($message, 'ubicacion') !== false || strpos($message, 'direccion') !== false) {
            $response = "Estamos ubicados en la Calle Moquegua 290, Caja de agua.";
        } else {
            $response = "Lo siento, no entiendo tu pregunta. ¿Podrías reformularla? Puedo ayudarte con reservas, horarios, menú y ubicación.";
        }

        echo json_encode(["response" => $response]);
    } else {
        echo json_encode(["response" => "Error: Mensaje no recibido."]);
    }
} else {
    echo json_encode(["response" => "Error: Método no permitido."]);
}
?>
