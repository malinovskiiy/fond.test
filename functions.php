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
function avatarSecurity($avatar){

	$name = $avatar['name'];
	$type = $avatar['type'];
	$size = $avatar['size'];

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
