<?php

require_once 'ActivityService.php';

class SocialActivityService extends ActivityService
{
    public function create($user_id, $activity_category, $activity_type, $full_publication_name, $year, $short_description, $publication_link) {
        
        // Определите баллы в соответствии с выбранными параметрами
        $points = 0;
        
        switch ($activity_category) {
            case 'in_fond':
                if ($activity_type === 'curator') {
                    $points = 5;
                } elseif ($activity_type === 'participant') {
                    $points = 3;
                } 
            case 'not_only_in_fond':
                if ($activity_type === 'international') {           
                    $points = 5;          
                } elseif ($activity_type === 'russian') {        
                    $points = 3;          
                } elseif ($activity_type === 'regional') {
                    $points = 1;         
                } elseif ($activity_type === 'management_team') {
                    $points = 1;         
                }
        }
        
        // Создайте запись в базе данных (предполагается, что у вас есть подключение к БД)
        $sql = "INSERT INTO `social_activity` (`activity_id`, `user_id`, `points`, `activity_category`, `activity_type`, `title`, `year`, `preview_text`, `link`) VALUES (NULL, '$user_id', $points, '$activity_category', '$activity_type', '$full_publication_name', '$year', '$short_description', '$publication_link')";

        // Выполните SQL-запрос и проверьте результат
        $this->db->connection->query($sql);
    }
}