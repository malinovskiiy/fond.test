<?php
session_start();

require_once 'database/DBController.php';
require_once 'database/services/UserService.php';
require_once 'database/services/KeywordService.php';
require_once 'database/services/ScientificActivityService.php';
require_once 'database/services/ScholarshipActivityService.php';
require_once 'database/services/OlympiadActivityService.php';
require_once 'database/services/SportsActivityService.php';
require_once 'database/services/SocialActivityService.php';
require_once 'database/services/EducationalActivityService.php';
require_once 'database/services/VolunteerActivityService.php';
require_once 'database/services/InternshipActivityService.php';

// Контроллер работы с БД

$db = new DBController();

// ===========================

// Сервисы пользователя и его ключевых слов

$UserService = new UserService($db);
$KeywordService = new KeywordService($db);

// ===========================

// Инициализируем критерии комплексного рейтинга

$ScientificActivityService = new ScientificActivityService($db, 'scientific_activity');
$ScholarshipActivityService = new ScholarshipActivityService($db, 'scholarship_activity');
$OlympiadActivityService = new OlympiadActivityService($db, 'olympiad_activity');
$SportsActivityService = new SportsActivityService($db, 'sports_activity');
$SocialActivityService = new SocialActivityService($db, 'social_activity');
$EducationalActivityService = new EducationalActivityService($db, 'educational_activity');
$VolunteerActivityService = new VolunteerActivityService($db, 'volunteer_activity');
$InternshipActivityService = new InternshipActivityService($db, 'internship_activity');

// ====================================================================================

// Обьект авторизованного пользователя

$UserData = $_SESSION['user'] ? $UserService->getUserById($_SESSION['user']['id'])[0] : 'null';

// ===========================

// Check type and size of image
function imageSecurity($image){

	$name = $image['name'];
	$type = $image['type'];
	$size = $image['size'];

	$blacklist = array(".php", ".js", ".html");

	foreach($blacklist as $row){
		if(preg_match("/$row\$/i", $name)) return false;
	}
	// Allowed types
	if(($type != "image/png") && ($type != "image/jpg") && ($type != "image/jpeg")) return false;

	// Allowed size 5MB
	if($size > 5 * 1024 * 1024) return false;

	return true;
}


function loadAndCompressImage($input_file, $output_dir, $quality = 50) {
    // Проверяем, был ли загружен файл без ошибок
    if ($input_file['error'] !== UPLOAD_ERR_OK) {
        return false; // Возвращаем false, если есть ошибка при загрузке файла
    }

    // Создаем объект Imagick // для того чтобы ее установить запустите OpenServer зайдите в меню -> дополнительно -> конфигурация -> php_**** 
	// откроется та версия php которую вы используете в данный момент и в этом файле найдите блок с опциями "extension" и в самом верху этих опций запишите следующее: 
	// extension=php_imagick.dll далее перезапустите OpenServer
	
    $image = new Imagick();

    $image->readImage($input_file['tmp_name']);
       
    // Устанавливаем формат WebP
    $image->setImageFormat('webp');

    // Устанавливаем качество сжатия
    $image->setImageCompressionQuality($quality);

    // Генерируем уникальное имя файла
    $output_filename = $_SERVER['DOCUMENT_ROOT'] . '/' . $output_dir . '/' . md5(microtime()) . '.webp';

    // Сохраняем сжатое изображение в указанную директорию
    $image->writeImage($output_filename);

    $position = strpos($output_filename, "/uploads");

    $result_filename = substr($output_filename, $position);

    return $result_filename; // Возвращаем путь к сжатому изображению (НЕ АБСОЛЮТНЫЙ ЧТОБЫ НА САЙТЕ ПОКАЗЫВАЛСЯ)
  
}