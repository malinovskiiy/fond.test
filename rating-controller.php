<?php
require "functions.php";

if(isset($_POST['create_scientific_activity'])){
    $user_id = $_SESSION['user']['id'];
    $activity_category = mysqli_escape_string($db->connection, $_POST['activity_category']);
    $publication_type = mysqli_escape_string($db->connection, $_POST['publication_type']);
    $publication_rating = mysqli_escape_string($db->connection, $_POST['publication_rating']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $full_publication_name = mysqli_escape_string($db->connection, $_POST['full_publication_name']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $publication_link = mysqli_escape_string($db->connection, $_POST['publication_link']);

    $ScientificActivityService->create(
        $user_id,
        $activity_category,
        $publication_type,
        $publication_rating,
        $full_publication_name,
        $year,
        $short_description,
        $publication_link
    );
}

if(isset($_POST['create_scholarship_activity'])){
    $user_id = $_SESSION['user']['id'];
    $scholarship_type = mysqli_escape_string($db->connection, $_POST['scholarship_type']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $full_scholarship_name = mysqli_escape_string($db->connection, $_POST['full_scholarship_name']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $scholarship_link = mysqli_escape_string($db->connection, $_POST['scholarship_link']);

    $ScholarshipActivityService->create(
        $user_id,
        $scholarship_type,
        $full_scholarship_name,
        $year,
        $short_description,
        $scholarship_link
    );
}

if(isset($_POST['create_olympiad_activity'])){
    $user_id = $_SESSION['user']['id'];
    $olympiad_type = mysqli_escape_string($db->connection, $_POST['olympiad_type']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $full_olympiad_name = mysqli_escape_string($db->connection, $_POST['full_olympiad_name']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $olympiad_link = mysqli_escape_string($db->connection, $_POST['olympiad_link']);

    $OlympiadActivityService->create(
        $user_id,
        $olympiad_type,
        $full_olympiad_name,
        $year,
        $short_description,
        $olympiad_link
    );
}

if(isset($_POST['create_sports_activity'])){
    $user_id = $_SESSION['user']['id'];
    $sports_type = mysqli_escape_string($db->connection, $_POST['sports_type']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $full_sports_name = mysqli_escape_string($db->connection, $_POST['full_sports_name']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $sports_link = mysqli_escape_string($db->connection, $_POST['sports_link']);

    $SportsActivityService->create(
        $user_id,
        $sports_type,
        $full_sports_name,
        $year,
        $short_description,
        $sports_link
    );
}

if(isset($_POST['create_social_activity'])){
    $user_id = $_SESSION['user']['id'];
    $activity_category = mysqli_escape_string($db->connection, $_POST['activity_category']);
    $activity_type = mysqli_escape_string($db->connection, $_POST['activity_type']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $title = mysqli_escape_string($db->connection, $_POST['title']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $social_link = mysqli_escape_string($db->connection, $_POST['social_link']);

    $SocialActivityService->create(
        $user_id,
        $activity_category,
        $activity_type,
        $title,
        $year,
        $short_description,
        $social_link
    );
}

if(isset($_POST['create_educational_activity'])){
    $user_id = $_SESSION['user']['id'];
    $activity_type = mysqli_escape_string($db->connection, $_POST['activity_type']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $title = mysqli_escape_string($db->connection, $_POST['title']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $educational_link = mysqli_escape_string($db->connection, $_POST['educational_link']);

    $EducationalActivityService->create(
        $user_id,
        $activity_type,
        $title,
        $year,
        $short_description,
        $educational_link
    );
}

if(isset($_POST['create_volunteer_activity'])){
    $user_id = $_SESSION['user']['id'];
    $activity_type = mysqli_escape_string($db->connection, $_POST['activity_type']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $title = mysqli_escape_string($db->connection, $_POST['title']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $volunteer_link = mysqli_escape_string($db->connection, $_POST['volunteer_link']);

    $VolunteerActivityService->create(
        $user_id,
        $activity_type,
        $title,
        $year,
        $short_description,
        $volunteer_link
    );
}

if(isset($_POST['create_internship_activity'])){
    $user_id = $_SESSION['user']['id'];
    $activity_type = mysqli_escape_string($db->connection, $_POST['activity_type']);
    $year = mysqli_escape_string($db->connection, $_POST['year']);
    $title = mysqli_escape_string($db->connection, $_POST['title']);
    $short_description = mysqli_escape_string($db->connection, $_POST['short_description']);
    $internship_link = mysqli_escape_string($db->connection, $_POST['internship_link']);

    $InternshipActivityService->create(
        $user_id,
        $activity_type,
        $title,
        $year,
        $short_description,
        $internship_link
    );
}