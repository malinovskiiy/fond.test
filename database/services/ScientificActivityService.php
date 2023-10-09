<?php

require_once 'ActivityService.php';

class ScientificActivityService extends ActivityService
{
    public function create($user_id, $activity_category, $publication_type, $publication_rating, $full_publication_name, $year, $short_description, $publication_link) {
        // Определите баллы в соответствии с выбранными параметрами
        $points = 0;

        switch ($activity_category) {
            case 'publication':
                if ($publication_type === 'scopus' || $publication_type === 'wos') {
                    if ($publication_rating === 'q1') {
                        $points = 10;
                    } elseif ($publication_rating === 'q2') {
                        $points = 7;
                    } elseif ($publication_rating === 'q3') {
                        $points = 5;
                    }
                } elseif ($publication_type === 'vak') {
                    $points = 3;
                } elseif ($publication_type === 'rinc') {
                    $points = 1;
                }
            case 'intellectual_property':
                if ($publication_type === 'patent') {
                    if ($publication_rating === 'invention') {
                        $points = 10;
                    } elseif ($publication_rating === 'model') {
                        $points = 5;
                    }
                } elseif ($publication_type === 'computer_certificate') {
                    $points = 3;
                } 
            case 'grant_activity':
                if ($publication_type === 'international') {
                    if ($publication_rating === 'head') {
                        $points = 10;
                    } elseif ($publication_rating === 'performer') {
                        $points = 5;
                    }
                } elseif ($publication_type === 'russian') {
                    if ($publication_rating === 'head') {
                        $points = 5;
                    } elseif ($publication_rating === 'performer') {
                        $points = 3;
                    }
                } elseif ($publication_type === 'regional') {
                    if ($publication_rating === 'head') {
                        $points = 3;
                    } elseif ($publication_rating === 'performer') {
                        $points = 1;
                    }
                }
            case 'conferences':
                if ($publication_type === 'international') {           
                    $points = 5;          
                } elseif ($publication_type === 'russian') {        
                    $points = 3;          
                } elseif ($publication_type === 'regional') {
                    $points = 1;         
                }
        }
    
        // Создайте запись в базе данных (предполагается, что у вас есть подключение к БД)
        $sql = "INSERT INTO `scientific_activity` (`activity_id`, `user_id`, `points`, `activity_category`, `activity_type`, `activity_subtype`, `title`, `year`, `preview_text`, `link`) VALUES (NULL, '$user_id', $points, '$activity_category', '$publication_type', '$publication_rating', '$full_publication_name', '$year', '$short_description', '$publication_link')";
        
        // Выполните SQL-запрос и проверьте результат
        $this->db->connection->query($sql);
    }

    public function getActivityStatistics($user_id){
        // SQL-запрос для получения статистики
        $sql = "SELECT 
                    SUM(CASE WHEN activity_category = 'publication' THEN 1 ELSE 0 END) as total_publications,
                    SUM(CASE WHEN activity_category = 'publication' AND activity_type = 'scopus' THEN 1 ELSE 0 END) as scopus_publications,
                    SUM(CASE WHEN activity_category = 'publication' AND activity_type = 'vak' THEN 1 ELSE 0 END) as vak_publications,
                    SUM(CASE WHEN activity_category = 'publication' AND activity_type = 'rinc' THEN 1 ELSE 0 END) as rinc_publications,
                    SUM(CASE WHEN activity_category = 'conferences' THEN 1 ELSE 0 END) as total_conferences,
                    SUM(CASE WHEN activity_category = 'conferences' AND activity_type = 'international' THEN 1 ELSE 0 END) as international_conferences,
                    SUM(CASE WHEN activity_category = 'conferences' AND activity_type = 'russian' THEN 1 ELSE 0 END) as russian_conferences,
                    SUM(CASE WHEN activity_category = 'conferences' AND activity_type = 'regional' THEN 1 ELSE 0 END) as regional_conferences
                FROM 
                    scientific_activity
                WHERE 
                    user_id = $user_id";

        // Выполните SQL-запрос
        $result = $this->db->connection->query($sql);

        // Обработайте результат запроса
        $statistics = array();

        if ($result) {
            $row = $result->fetch_assoc();
            $statistics = $row;
        }

        return $statistics;
    }
}