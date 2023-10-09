<?php
require "functions.php";

if(isset($_POST['keyword_id'])){
    $UserService->toggleKeywordForUser($_SESSION['user']['id'], $_POST['keyword_id']);
}

if(isset($_GET['keyword'])){
    $KeywordService->getSimilar($_SESSION['user']['id'], $_GET['keyword']);
}


if(isset($_POST['get_keywords'])){
    $UserService->getAllKeywords($_SESSION['user']['id']);
}


if(isset($_POST['update_profile_contacts'])){
    $UserService->updateContactsFields($_SESSION['user']['id'], $_POST['phone'], $_POST['telegram']);
}

if(isset($_POST['update_profile_science'])){
    $UserService->updateScienceFields(
        $_SESSION['user']['id'], 
        $_POST['science_degree'],
        $_POST['science_work_topic'],
        $_POST['science_main_achievement'],
        $_POST['science_societies'],
        $_POST['science_other_societies'],
        $_POST['science_ya_expert'],
        $_POST['science_ya_ambassador']
    );
}

if(isset($_POST['update_profile_study'])){
    $UserService->updateStudyFields(
        $_SESSION['user']['id'], 
        $_POST['study_place'],
        $_POST['study_city'],
        $_POST['study_level'],
        $_POST['study_year'],
        $_POST['study_institution'],
        $_POST['study_direction'],
        $_POST['study_average_grade'],
        $_POST['study_languages']
    );
}

if(isset($_POST['update_profile_main'])){
    $UserService->updateMainFields(
        $_SESSION['user']['id'], 
        $_POST['username'],
        $_POST['last_name'],
        $_POST['first_name'],
        $_POST['patronymic'],
        $_POST['date_of_birth'],
        $_POST['city'],
        $_POST['involvement_level'],
        $_POST['research_topic'],
        $_POST['about_text'],
        $_POST['extra_skills']
    );
}

if(isset($_POST['get_workplaces'])){
    $UserService->getWorkplaces($_SESSION['user']['id']);
}


if(isset($_POST['delete_workplace'])){
    $UserService->deleteWorkplace($_SESSION['user']['id'], $_POST['workplace_id']);
}

if(isset($_POST['create_workplace'])){
    $UserService->createWorkplace($_SESSION['user']['id'], '', '');
}

if(isset($_POST['update_workplaces'])){
    $UserService->updateWorkplaces($_SESSION['user']['id'], $_POST['workplaces']);
}


