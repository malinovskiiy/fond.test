<?php

class UserService
{
    public $db = null;

    public function __construct(DBController $db)
    {
        $this->db = $db;
    }

    // Find user by id
    public function getUserById($id)
    {
        if (isset($id)) {
            $result = $this->db->connection->query("SELECT * FROM `users` WHERE id = $id");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    // Search product by name
    public function getUserByName($username)
    {
        // If username exists and does not contain sinqle quote mark
        if (isset($username) && !strpos($username, "'")) {
            $result = $this->db->connection->query("SELECT * FROM `users` WHERE username LIKE '%"."{$username}"."%'");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

     // Search product by name
    public function updateAvatar($avatar, $id)
    {
        
        $this->db->connection->query("UPDATE users SET `image` = '$avatar' WHERE id = $id"); 

        $_SESSION['user']['image'] = $avatar;

        header("Location: /edit-profile");
    }

    // Echo used to transfer data to javascript
    public function getAllKeywords($user_id) {

        // убрать знаки массива для sql запроса IN
        $keywords = $this->db->connection->query("SELECT keywords FROM users WHERE id = $user_id");

        if (!empty($keywords)){
            // Извлеките JSON-строку из результата
            $row = $keywords->fetch_assoc();
            // Убираем двойные кавычки и квадратные скобки
            $keywords_ids = str_replace(['"', "[", "]"], '', $row['keywords']);

            if(!empty($keywords_ids)){
                $result = $this->db->connection->query("SELECT id, name, slug FROM keywords WHERE id IN ($keywords_ids)");
            
                // Шаг 3: Преобразование результата в JSON
                $keywordsArray = array();
                while ($item = $result->fetch_assoc()) {
                    $keywordsArray[] = $item;
                }

                $jsonData = json_encode($keywordsArray);

                echo $jsonData;
            } else {
                echo '[]';
            }
        } 
    }

    public function toggleKeywordForUser($user_id, $keyword_id) {
        // Retrieve the existing JSON data from the database.
        $result = $this->db->connection->query("SELECT keywords FROM users WHERE id = $user_id");

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $keywordsJson = $row['keywords'];
    
            // Parse the JSON data into a PHP array.
            $keywordsArray = json_decode($keywordsJson, true);
    
            if (!$keywordsArray) {
                $keywordsArray = array();
            }
    
            // Check if the keyword_id exists in the array.
            $key = array_search($keyword_id, $keywordsArray);

            if ($key !== false) {
                // If it exists, remove it from the array.
                // remove item at index 1 which is 'for'
                
                if(count($keywordsArray) == 1){
                    $keywordsArray = array();
                }

                array_splice($keywordsArray,  $key, 1); 


            } else {
                if(count($keywordsArray) < 6){
                    // If it doesn't exist, add it to the array.
                    $keywordsArray[] = $keyword_id;
                } else {
                    echo '{"error": "Нельзя добавить больше 6 ключевых слов", "count": "'. count($keywordsArray) .'"}';

                    return 0;
                }
            }
    
            // Convert the PHP array back to JSON.
            $updatedKeywordsJson = json_encode($keywordsArray);

           
            // Update the keywords field in the database.
            $updateSql = "UPDATE users SET keywords = '$updatedKeywordsJson' WHERE id = $user_id";
            if ($this->db->connection->query($updateSql) == true) {
                // Success
                echo $updatedKeywordsJson;
            } else {
                return false; // Error updating database
            }
        } else {
            return false; // User not found
        }
    }
    
    public function updateMainFields($id, $username, $last_name, $first_name, $patronymic, $date_of_birth, $city, $involvement_level, $research_topic, $about_text, $extra_skills)
    {
        if ($id) {
            // Предположим, что ваша таблица пользователей называется 'users'
            $query = "UPDATE users SET 
                username = ?,
                last_name = ?,
                first_name = ?,
                patronymic = ?,
                date_of_birth = ?,
                city = ?,
                involvement_level = ?,
                research_topic = ?,
                about_text = ?,
                extra_skills = ?
                WHERE id = ?";

            // Подготовка и выполнение запроса с использованием параметров
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('ssssssisssi', $username, $last_name, $first_name, $patronymic, $date_of_birth, $city, $involvement_level, $research_topic, $about_text, $extra_skills, $id);

            if ($stmt->execute()) {
                echo '{"status": "success"}';
            } else {
                echo '{"error": "Не удалось изменить профиль"}';
            }
        } else {
            echo '{"error": "Не удалось изменить профиль"}';
        }
    }
    // Update phone and telegram nickname
    public function updateContactsFields($id, $phone, $telegram)
    {
        if ($id) {
            // Предположим, что ваша таблица пользователей называется 'users'
            $query = "UPDATE users SET phone = ?, telegram = ? WHERE id = ?";
    
            // Подготовка и выполнение запроса с использованием параметров
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('ssi', $phone, $telegram, $id);
    
            if ($stmt->execute()) {
                echo '{"status": "success"}';
            } else {
                echo '{"error": "Не удалось изменить профиль"}';
            }
        } else {
            echo '{"error": "Не удалось изменить профиль"}';
        }
    }

    // Update fields with 'science_' prefix in users table
    public function updateScienceFields($id, $science_degree, $science_work_topic, $science_main_achievement, $science_societies, $science_other_societies, $science_ya_expert, $science_ya_ambassador) {
        if ($id) {
            $query = "UPDATE users 
                      SET 
                        science_degree = ?, 
                        science_work_topic = ?, 
                        science_main_achievement = ?, 
                        science_societies = ?, 
                        science_other_societies = ?, 
                        science_ya_expert = ?, 
                        science_ya_ambassador = ? 
                      WHERE 
                        id = ?";

            // Подготовка и выполнение запроса с использованием параметров
            $stmt = $this->db->connection->prepare($query);

            $stmt->bind_param('sssssssi', $science_degree, $science_work_topic, $science_main_achievement, $science_societies, $science_other_societies, $science_ya_expert, $science_ya_ambassador, $id);

            if ($stmt->execute()) {
                echo '{"status": "success"}';
            } else {
                echo '{"error": "Не удалось изменить профиль"}';
            }
        } else {
            echo '{"error": "Не удалось изменить профиль"}';
        }
    }

    // Update fields with 'study_' prefix in users table
    public function updateStudyFields($id, $study_place, $study_city, $study_level, $study_year, $study_institution, $study_direction, $study_average_grade, $study_languages){
        if ($id) {
            // Предположим, что ваша таблица пользователей называется 'users'
            $query = "UPDATE users 
                    SET 
                        study_place = ?, 
                        study_city = ?, 
                        study_level = ?, 
                        study_year = ?, 
                        study_institution = ?, 
                        study_direction = ?, 
                        study_average_grade = ?, 
                        study_languages = ? 
                    WHERE 
                        id = ?";

            // Подготовка и выполнение запроса с использованием параметров
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('ssiissssi', $study_place, $study_city, $study_level, $study_year, $study_institution, $study_direction, $study_average_grade, $study_languages, $id);

            if ($stmt->execute()) {
                echo '{"status": "success"}';
            } else {
                echo '{"error": "Не удалось изменить профиль"}';
            }
        } else {
            echo '{"error": "Не удалось изменить профиль"}';
        }
    }

    public function createWorkplace($userId, $name, $position)
    {
        if ($userId) {
            // Генерация уникального id для нового элемента
            $newId = uniqid();

            // Создание нового элемента с уникальным id
            $newWorkplace = [
                'id' => $newId,
                'name' => $name,
                'position' => $position
            ];

            // Получение текущего JSON-поля "work_places" из базы данных
            $query = "SELECT work_places FROM users WHERE id = ?";
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_assoc();
            $currentWorkPlaces = json_decode($userData['work_places'], true);

            // Добавление нового элемента в массив
            $currentWorkPlaces[] = $newWorkplace;

            // Преобразование массива обратно в JSON
            $newWorkPlacesJson = json_encode($currentWorkPlaces);

            // Обновление JSON-поля "work_places" в базе данных
            $query = "UPDATE users SET work_places = ? WHERE id = ?";
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('si', $newWorkPlacesJson, $userId);

            if ($stmt->execute()) {
                echo '{"status": "success"}'; // Возвращаем успешный результат
            } else {
                echo '{"error": "Не удалось обновить места работы"}'; // Возвращаем ошибку
            }
        } else {
            echo '{"error": "Пользователь не найден"}';  // Возвращаем ошибку, если не удалось определить пользователя
        }
    }

    public function getWorkplaces($userId)
    {
        if ($userId) {
            // Получение текущего JSON-поля "work_places" из базы данных
            $query = "SELECT work_places FROM users WHERE id = ?";
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_assoc();
            $workPlaces = json_decode($userData['work_places'], true);

            echo json_encode($workPlaces);
        } else {
            echo '{"error": "уккщк"}';// Возвращаем null, если не удалось определить пользователя
        }
    }

    public function updateWorkplaces($userId, $workPlaces)
    {
        if ($userId) {

            // Обновление JSON-поля "work_places" в базе данных
            $query = "UPDATE users SET work_places = ? WHERE id = ?";
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('si', $workPlaces, $userId);

            if ($stmt->execute()) {
                echo '{"status": "success"}'; // Возвращаем успешный результат
            } else {
                echo '{"error": "Не удалось обновить места работы"}'; // Возвращаем ошибку
            }
        } else {
            echo '{"error": "Пользователь не найден"}'; // Возвращаем ошибку, если не удалось определить пользователя
        }
    }

    public function deleteWorkplace($userId, $workplaceId)
    {
        if ($userId) {
            // Получение текущего JSON-поля "work_places" из базы данных
            $query = "SELECT work_places FROM users WHERE id = ?";
            $stmt = $this->db->connection->prepare($query);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_assoc();
            $workPlaces = json_decode($userData['work_places'], true);

            // Поиск и удаление рабочего места по указанному id
            $updatedWorkPlaces = array_filter($workPlaces, function ($workplace) use ($workplaceId) {
                return $workplace['id'] !== $workplaceId;
            });

            if (count($updatedWorkPlaces) < count($workPlaces)) {
                // Если было найдено и удалено рабочее место, обновляем JSON-поле
                $workPlacesJson = json_encode(array_values($updatedWorkPlaces)); // Переиндексируем массив
                $query = "UPDATE users SET work_places = ? WHERE id = ?";
                $stmt = $this->db->connection->prepare($query);
                $stmt->bind_param('si', $workPlacesJson, $userId);

                if ($stmt->execute()) {
                    echo '{"status": "success"}';
                } else {
                    echo '{"error": "Не удалось обновить места работы"}';
                }
            } else {
                echo '{"error": "Место работы с указанным ID не найдено"}';
            }
        } else {
            echo '{"error": "Пользователь не найден"}';
        }
    }
}