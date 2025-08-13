<?php
// Устанавливаем заголовок, чтобы клиент знал, что получает JSON
header('Content-Type: application/json');

// Получаем тело запроса
$request_body = file_get_contents('php://input');

// Декодируем JSON в PHP-массив
$data = json_decode($request_body, true);

// Проверяем, что данные были успешно получены
if ($data === null) {
    // Ошибка: неверный формат JSON
    http_response_code(400); // Bad Request
    echo json_encode(array('status' => 'error', 'message' => 'Неверный JSON-формат данных.'));
    exit;
}

// Проверяем наличие необходимых полей
if (!isset($data['name']) || !isset($data['message'])) {
    // Ошибка: отсутствуют необходимые поля
    http_response_code(400); // Bad Request
    echo json_encode(array('status' => 'error', 'message' => 'Отсутствуют поля "name" или "message".'));
    exit;
}

// Получаем данные из декодированного массива
$name = $data['name'];
$message = $data['message'];

// Здесь может быть ваша логика обработки данных, например:
// - сохранение в базу данных
// - отправка email
// - выполнение какой-либо операции

// Подготавливаем ответ
$response = array(
    'status' => 'success',
    'message' => 'Данные успешно получены и обработаны!',
    'received_data' => array(
        'name' => $name,
        'message' => $message,
        'timestamp' => date('Y-m-d H:i:s')
    )
);

// Возвращаем ответ в формате JSON
echo json_encode($response);
?>