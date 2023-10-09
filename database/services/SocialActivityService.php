<?php

require_once 'ActivityService.php';

class SocialActivityService extends ActivityService
{
    public function createComplexActivity($user_id, $activity_category, $activity_type, $image, $full_publication_name, $year, $short_description, $publication_link) {
        
        // баллы в соответствии с выбранными параметрами
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
        
        // запись в базе данных
        $sql = "INSERT INTO `social_activity` (`activity_id`, `user_id`, `points`, `activity_category`, `activity_type`, `image`, `title`, `year`, `preview_text`, `link`) VALUES (NULL, '$user_id', $points, '$activity_category', '$activity_type', '$image', '$full_publication_name', '$year', '$short_description', '$publication_link')";

        // Выполните SQL-запрос и проверьте результат
        $this->db->connection->query($sql);
    }

    public function updateComplexActivity($activity_id, $activity_category, $activity_type, $image, $full_publication_name, $year, $short_description, $publication_link) {
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

        $sql = "UPDATE `social_activity` SET `points`= ?, `activity_category`= ?, `activity_type`= ?, `image`= ?, `title`=?, `year`=?, `preview_text`=?, `link`=? WHERE `activity_id`=?";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->bind_param("isssssssi", $points, $activity_category, $activity_type, $image, $full_publication_name, $year, $short_description, $publication_link, $activity_id);
        $stmt->execute();
        $stmt->close();

        echo '{"new_image":"'. $image .'", "new_title": "'. $full_publication_name .'"}';
    }

    public function getActivitiesInFond($user_id) {
        // Подготовьте SQL-запрос с использованием подготовленного выражения
        $sql = "SELECT * FROM social_activity WHERE user_id = ? AND activity_category = 'in_fond'";
    
        // Подготовьте и выполните запрос
        $stmt = $this->db->connection->prepare($sql);
        $stmt->bind_param("i", $user_id); // "i" означает, что $user_id - это целое число
        $stmt->execute();
    
        // Получите результат запроса
        $result = $stmt->get_result();
    
        // Инициализируйте массив для хранения результатов
        $socialActivities = array();
    
        // Пройдитесь по результатам и добавьте их в массив
        while ($row = $result->fetch_assoc()) {
            $socialActivities[] = $row;
        }
    
        // Закройте соединение с базой данных
        $stmt->close();

        // Верните массив с социальными активностями
        return $socialActivities;
    }
}