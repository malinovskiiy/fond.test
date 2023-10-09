<?php

require_once 'ActivityService.php';

class OlympiadActivityService extends ActivityService
{
    public function create($user_id, $activity_category, $activity_title, $year, $activity_description, $link) {

        
        // Определите баллы в соответствии с выбранными параметрами
        $points = 0;

        if ($activity_category === 'international') {           
            $points = 5;          
        } elseif ($activity_category === 'russian') {        
            $points = 3;          
        } elseif ($activity_category === 'regional') {
            $points = 1;         
        }

        // Создайте запись в базе данных (предполагается, что у вас есть подключение к БД)
        $sql = "INSERT INTO `olympiad_activity` (`activity_id`, `user_id`, `points`, `activity_category`, `title`, `year`, `preview_text`, `link`) VALUES (NULL, '$user_id', '$points', '$activity_category', '$activity_title', '$year', '$activity_description', '$link')";

        // Выполните SQL-запрос и проверьте результат
        $this->db->connection->query($sql);
    }
}