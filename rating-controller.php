<?php
require_once "functions.php";

// TODO MAKE THIS ALL NON UNIQUE FUNCTIONALITY and remove all 8 classes
// restructure code of complex rating to remove all 8 classes


if(isset($_GET['delete_activity_id']) && isset($_GET['delete_activity_table_name']) && isset($_GET['user_id'])){
    if(isset($_SESSION['user']) && $_GET['user_id'] === $_SESSION['user']['id']){

        $sql = "DELETE FROM " .  $_GET['delete_activity_table_name'] . " WHERE activity_id = " . $_GET['delete_activity_id'];

        $db->connection->query($sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if(isset($_POST['create_scientific_activity']) || isset($_POST['update_scientific_activity']) && isset($_SESSION['user']) ){
    $user_id = $_SESSION['user']['id'];
    $activity_category = mysqli_escape_string($db->connection, $_POST['activity_category']);
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $publication_type = mysqli_escape_string($db->connection, $_POST['publication_type']);
    $publication_rating = mysqli_escape_string($db->connection, $_POST['publication_rating']);
    $year = mysqli_escape_string($db->connection, $_POST['science-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['science-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['science-description-input']);
    $publication_link = mysqli_escape_string($db->connection, $_POST['science-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);

    if (isset($_FILES['science-image-input']) && $_FILES['science-image-input']['error'] === UPLOAD_ERR_OK) {
        $science_image = $_FILES['science-image-input'];

        // Проверка и загрузка изображения
        if (imageSecurity($science_image)) {
            
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $science_image_filename = loadAndCompressImage($science_image, $output_dir);
            
        } else {
            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $science_image_filename = $old_image;
        }
    } else {
        $science_image_filename = $old_image;
    }

    if(isset($_POST['create_scientific_activity'])){
        $ScientificActivityService->createComplexActivity(
            $user_id,
            $activity_category,
            $publication_type,
            $publication_rating,
            $science_image_filename,
            $title,
            $year,
            $short_description,
            $publication_link
        );
    } else{
        $ScientificActivityService->updateComplexActivity(
            $activity_id,
            $activity_category,
            $publication_type,
            $publication_rating,
            $science_image_filename,
            $title,
            $year,
            $short_description,
            $publication_link
        );
    }

   
}

if(isset($_POST['create_scholarship_activity']) || isset($_POST['update_scholarship_activity']) && isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $scholarship_type = mysqli_escape_string($db->connection, $_POST['scholarship_type']);
    $year = mysqli_escape_string($db->connection, $_POST['scholarship-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['scholarship-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['scholarship-description-input']);
    $scholarship_link = mysqli_escape_string($db->connection, $_POST['scholarship-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);

    if (isset($_FILES['scholarship-image-input']) && $_FILES['scholarship-image-input']['error'] === UPLOAD_ERR_OK) {
        $scholarship_image = $_FILES['scholarship-image-input'];
        $scholarship_image_type = $scholarship_image['type'];
        $scholarship_image_filename = "uploads/posts_img/" . md5(microtime()) . "." . substr($scholarship_image_type, strlen("image/"));

        // Проверка и загрузка изображения
        if (imageSecurity($scholarship_image)) {
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $scholarship_image_filename = loadAndCompressImage($scholarship_image, $output_dir);
        } else {

            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $scholarship_image_type = $old_image;
        }
    } else {
        $scholarship_image_filename = $old_image; // Если изображение не было загружено
    }
    if(isset($_POST['create_scholarship_activity'])){
        $ScholarshipActivityService->createActivity(
            $user_id,
            $scholarship_type,
            $scholarship_image_filename,
            $title,
            $year,
            $short_description,
            $scholarship_link
        );
    } else {
        $ScholarshipActivityService->updateActivity(
            $activity_id,
            $scholarship_type,
            $scholarship_image_filename,
            $title,
            $year,
            $short_description,
            $scholarship_link
        );
    }
}

if(isset($_POST['create_olympiad_activity']) || isset($_POST['update_olympiad_activity']) && isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $olympiad_type = mysqli_escape_string($db->connection, $_POST['olympiad_type']);
    $year = mysqli_escape_string($db->connection, $_POST['olympiad-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['olympiad-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['olympiad-description-input']);
    $olympiad_link = mysqli_escape_string($db->connection, $_POST['olympiad-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);
    
    if (isset($_FILES['olympiad-image-input']) && $_FILES['olympiad-image-input']['error'] === UPLOAD_ERR_OK) {
        $olympiad_image = $_FILES['olympiad-image-input'];
        $olympiad_image_type = $olympiad_image['type'];
        $olympiad_image_filename = "uploads/posts_img/" . md5(microtime()) . "." . substr($olympiad_image_type, strlen("image/"));

        // Проверка и загрузка изображения
        if (imageSecurity($olympiad_image)) {
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $olympiad_image_filename = loadAndCompressImage($olympiad_image, $output_dir);
            
        } else {
            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $olympiad_image_type = $old_image;
        }
    } else {
        $olympiad_image_filename = $old_image; // Если изображение не было загружено
    }
    if(isset($_POST['create_olympiad_activity'])){
        $OlympiadActivityService->createActivity(
            $user_id,
            $olympiad_type,
            $olympiad_image_filename,
            $title,
            $year,
            $short_description,
            $olympiad_link
        );
    } else {
        $OlympiadActivityService->updateActivity(
            $activity_id,
            $olympiad_type,
            $olympiad_image_filename,
            $title,
            $year,
            $short_description,
            $olympiad_link
        );
    }
}

if(isset($_POST['create_sports_activity']) || isset($_POST['update_sports_activity']) && isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $sports_type = mysqli_escape_string($db->connection, $_POST['sports_type']);
    $year = mysqli_escape_string($db->connection, $_POST['sports-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['sports-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['sports-description-input']);
    $sports_link = mysqli_escape_string($db->connection, $_POST['sports-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);
    
    if (isset($_FILES['sports-image-input']) && $_FILES['sports-image-input']['error'] === UPLOAD_ERR_OK) {
        $sports_image = $_FILES['sports-image-input'];
        $sports_image_type = $sports_image['type'];
        $sports_image_filename = "uploads/posts_img/" . md5(microtime()) . "." . substr($sports_image_type, strlen("image/"));

        // Проверка и загрузка изображения
        if (imageSecurity($sports_image)) {
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $sports_image_filename = loadAndCompressImage($sports_image, $output_dir);
        } else {
            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $sports_image_type = $old_image;
        }
    } else {
        $sports_image_filename = $old_image; // Если изображение не было загружено
    }
    
    if(isset($_POST['create_sports_activity'])){
        $SportsActivityService->createActivity(
            $user_id,
            $sports_type,
            $sports_image_filename,
            $title,
            $year,
            $short_description,
            $sports_link
        );
    } else {
        $SportsActivityService->updateActivity(
            $activity_id,
            $sports_type,
            $sports_image_filename,
            $title,
            $year,
            $short_description,
            $sports_link
        );
    }
}


if(isset($_POST['create_social_activity']) || isset($_POST['update_social_activity']) && isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $activity_category = mysqli_escape_string($db->connection, $_POST['social_activity_category']);
    $activity_type = mysqli_escape_string($db->connection, $_POST['social_activity_type']);
    $year = mysqli_escape_string($db->connection, $_POST['social-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['social-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['social-description-input']);
    $social_link = mysqli_escape_string($db->connection, $_POST['social-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);

    if (isset($_FILES['social-image-input']) && $_FILES['social-image-input']['error'] === UPLOAD_ERR_OK) {
        $social_image = $_FILES['social-image-input'];
        $social_image_type = $social_image['type'];
        $social_image_filename = "uploads/posts_img/" . md5(microtime()) . "." . substr($social_image_type, strlen("image/"));

        // Проверка и загрузка изображения
        if (imageSecurity($social_image)) {
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $social_image_filename = loadAndCompressImage($social_image, $output_dir);
        } else {
            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $social_image_type = $old_image;
        }
    } else {
        $social_image_filename = $old_image; // Если изображение не было загружено
    }

    if(isset($_POST['create_social_activity'])){
        $SocialActivityService->createComplexActivity(
            $user_id,
            $activity_category,
            $activity_type,
            $social_image_filename,
            $title,
            $year,
            $short_description,
            $social_link
        );
    } else{
        $SocialActivityService->updateComplexActivity(
            $activity_id,
            $activity_category,
            $activity_type,
            $social_image_filename,
            $title,
            $year,
            $short_description,
            $social_link
        );
    }
}

if(isset($_POST['create_educational_activity']) || isset($_POST['update_educational_activity']) && isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $educational_type = mysqli_escape_string($db->connection, $_POST['educational_type']);
    $year = mysqli_escape_string($db->connection, $_POST['educational-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['educational-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['educational-description-input']);
    $educational_link = mysqli_escape_string($db->connection, $_POST['educational-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);
    
    if (isset($_FILES['educational-image-input']) && $_FILES['educational-image-input']['error'] === UPLOAD_ERR_OK) {
        $educational_image = $_FILES['educational-image-input'];
        $educational_image_type = $educational_image['type'];
        $educational_image_filename = "uploads/posts_img/" . md5(microtime()) . "." . substr($educational_image_type, strlen("image/"));

        // Проверка и загрузка изображения
        if (imageSecurity($educational_image)) {
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $educational_image_filename = loadAndCompressImage($educational_image, $output_dir);
        } else {
            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $educational_image_type = $old_image;
        }
    } else {
        $educational_image_filename = $old_image; // Если изображение не было загружено
    }
    if(isset($_POST['create_educational_activity'])){
        $EducationalActivityService->createActivity(
            $user_id,
            $educational_type,
            $educational_image_filename,
            $title,
            $year,
            $short_description,
            $educational_link
        );
    } else {
        $EducationalActivityService->updateActivity(
            $activity_id,
            $educational_type,
            $educational_image_filename,
            $title,
            $year,
            $short_description,
            $educational_link
        );
    }
}

if(isset($_POST['create_volunteer_activity']) || isset($_POST['update_volunteer_activity']) && isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $volunteer_type = mysqli_escape_string($db->connection, $_POST['volunteer_type']);
    $year = mysqli_escape_string($db->connection, $_POST['volunteer-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['volunteer-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['volunteer-description-input']);
    $volunteer_link = mysqli_escape_string($db->connection, $_POST['volunteer-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);
    
    if (isset($_FILES['volunteer-image-input']) && $_FILES['volunteer-image-input']['error'] === UPLOAD_ERR_OK) {
        $volunteer_image = $_FILES['volunteer-image-input'];
        $volunteer_image_type = $volunteer_image['type'];
        $volunteer_image_filename = "uploads/posts_img/" . md5(microtime()) . "." . substr($volunteer_image_type, strlen("image/"));

        // Проверка и загрузка изображения
        if (imageSecurity($volunteer_image)) {
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $volunteer_image_filename = loadAndCompressImage($volunteer_image, $output_dir);
            
        } else {
            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $volunteer_image_type = $old_image;
        }
    } else {
        $volunteer_image_filename = $old_image; // Если изображение не было загружено
    }
    if(isset($_POST['create_volunteer_activity'])){
        $VolunteerActivityService->createActivity(
            $user_id,
            $volunteer_type,
            $volunteer_image_filename,
            $title,
            $year,
            $short_description,
            $volunteer_link
        );
    } else {
        $VolunteerActivityService->updateActivity(
            $activity_id,
            $volunteer_type,
            $volunteer_image_filename,
            $title,
            $year,
            $short_description,
            $volunteer_link
        );
    }
}


if(isset($_POST['create_internship_activity']) || isset($_POST['update_internship_activity']) && isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $activity_id = mysqli_escape_string($db->connection, $_POST['activity_id']);
    $internship_type = mysqli_escape_string($db->connection, $_POST['internship_type']);
    $year = mysqli_escape_string($db->connection, $_POST['internship-year-input']);
    $title = mysqli_escape_string($db->connection, $_POST['internship-title-input']);
    $short_description = mysqli_escape_string($db->connection, $_POST['internship-description-input']);
    $internship_link = mysqli_escape_string($db->connection, $_POST['internship-link-input']);

    $old_image = mysqli_escape_string($db->connection, $_POST['old_image']);
    
    if (isset($_FILES['internship-image-input']) && $_FILES['internship-image-input']['error'] === UPLOAD_ERR_OK) {
        $internship_image = $_FILES['internship-image-input'];
        $internship_image_type = $internship_image['type'];
        $internship_image_filename = "uploads/posts_img/" . md5(microtime()) . "." . substr($internship_image_type, strlen("image/"));

        // Проверка и загрузка изображения
        if (imageSecurity($internship_image)) {
            $output_dir = 'uploads/posts_img'; // Укажите путь к директории для сохранения сжатых изображений
            $internship_image_filename = loadAndCompressImage($internship_image, $output_dir);
            
        } else {
            echo '{"warning":"Активность добавлена, но файл не был загружен"}';
            $internship_image_type = $old_image;
        }
    } else {
        $internship_image_filename = $old_image; // Если изображение не было загружено
    }
    if(isset($_POST['create_internship_activity'])){
        $InternshipActivityService->createActivity(
            $user_id,
            $internship_type,
            $internship_image_filename,
            $title,
            $year,
            $short_description,
            $internship_link
        );
    } else {
        $InternshipActivityService->updateActivity(
            $activity_id,
            $internship_type,
            $internship_image_filename,
            $title,
            $year,
            $short_description,
            $internship_link
        );
    }
}