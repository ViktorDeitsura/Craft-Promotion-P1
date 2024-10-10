<?

@session_start();

function echo_json($array = array()) {
    header("Content-Type: application/json; charset=UTF-8");
    http_response_code(200);
    echo json_encode($array, TRUE);
    exit();
}



function validate($file) {
    # Валидация файла фотки
    if ($file['size'] > 1024*1024*5) { 
        echo_json(['status'=> false,'message'=>'Ошибка! Размер фото превышает 5 мб']);
        exit;
    }

    // Проверяем, существует ли временный файл
    if (!empty($file['tmp_name']) && file_exists($file['tmp_name'])) {
        $mime = mime_content_type($file['tmp_name']);
        
        if ($mime != "image/jpeg" && $mime != "image/jpg" && $mime != "image/png" && $mime != "image/webp") {
            echo_json(['status'=> false,'message'=>'Ошибка! Допустимый формат изображения : jpg, png, jpeg, webp']);
            exit; // Выходим, если формат неверный
        }

        list($img,$ext) = explode("/", $mime); 

        if ( strtolower($ext) == "webp") { 
            $ext = "jpg";
        }

        return $ext;

    } else {
        echo_json(['status'=> false,'message'=>'Ошибка! Файл не найден или поврежден']);
        exit; 
    }
}

$element    = htmlspecialchars( $_POST['title'] );
$date       = date("y.m.d");
$directory  = $_SERVER['DOCUMENT_ROOT'] . "/upload/users/";
$directory .= intval($_SESSION['user']['phone']) . "/";

if (!is_dir($directory)) {
    if (!mkdir($directory, 0777, true)) {
        echo_json(['status'=> false,'message'=>'Не удалось создать директорию']);
    }
}

$check_ext  = validate($_FILES['filecheck']);
$passp_ext  = validate($_FILES['filepassport']);

include_once($_SERVER['DOCUMENT_ROOT'] . "/php/models/spdo.class.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/php/models/product.class.php");
$model = new Core\prod();

$id = $model->createProduct($_SESSION['user']['phone'], $element, 1, $date); // создадим запись в бд

$check_name = $id."_check." . $check_ext;
$passp_name = $id."_passport." . $passp_ext;


@move_uploaded_file($_FILES['filecheck']['tmp_name'], $directory . $check_name );
@move_uploaded_file($_FILES['filepassport']['tmp_name'], $directory . $passp_name);


#telegram alert
include_once($_SERVER['DOCUMENT_ROOT'] . "/services/telegram/bot.php");
$arUsers = array(
    6242444124, # 
    8239048230, # 
    3849023890, # 
    3278409234, # 
    7239874939  # 
);
$message  = "💎 SITE.COM\n";
$message .= "📦 Новая регистрация от пользователя!\n";
$message .= "📞 Номер телефона: " . $_SESSION['user']['phone'];
$res = sendMessage($message, $arUsers);

echo_json(['status'=> true,'message'=>'Ваш продукт успешно зарегистрирован']);
