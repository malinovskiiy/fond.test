<?php 
require "header.php";

if(!isset($_SESSION['user'])){
	header("Location: 404.php");
}

$activity = $SocialActivityService->getById($_GET['id']);

if($activity === NULL){
    header("Location: 404.php");
}
?>


<div class="page-wrapper position-relative py-5">
    <div class="container pt-5">
        
        <main class="main">     
            <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-5 px-md-5">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div class="tab-content w-100" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-social-activity" role="tabpanel" aria-labelledby="v-pills-social-activity-tab">
                                    <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                        <span class="text-primary fw-bold fs-5">Изменить общественную деятельность<br><span class="text-dark activity_current_title"><?php echo $activity['title']; ?></span></span><p>* - обязательные поля</p>
                                    </div>
                                    <form id="update-social-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">


                                                <input type="hidden" name="update_social_activity" value="true">
                                                 <input type="hidden" name="activity_id" value="<?php echo $activity['activity_id']?>">
                                                <div class="row">
                                                        <div class="col-lg-8 profile-input mb-3">                                       
                                                            <label class="form-label">Выберите тип деятельности *</label>                                        
                                                            <select class="form-select"  id="social_activity_category" name="social_activity_category">
                                                                <option value="in_fond"<?php if ($activity['activity_category'] === 'in_fond') echo 'selected'; ?>>В Фонде</option>
                                                                <option value="not_only_in_fond" <?php if ($activity['activity_category'] === 'not_only_in_fond') echo 'selected'; ?>>В Фонде и не только</option>
                                                            
                                                            </select>
                                                        </div>
                                                        
                                                </div>

                                               <div class="row social_activity_type">
                                                    
                                               </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input  type="number" max="9999" min="0" type="text" id="social-year-input" name="social-year-input" class="form-control"  aria-describedby="emailHelp" required value="<?php echo $activity['year']; ?>">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="social-title-input" name="social-title-input" class="form-control"  aria-describedby="emailHelp" required value="<?php echo $activity['title']; ?>">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                
                                                   
                                                   <textarea maxlength="300" id="social-description-input" name="social-description-input" class="form-control"  aria-describedby="emailHelp"><?php echo $activity['preview_text']; ?></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="social-link-input" name="social-link-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $activity['link']; ?>">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-5">
                                            
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-lg-6">
                                                        <label class="form-label">Картинка (необязательно)</label>
                                                            <input type="file" id="social-image-input" name="social-image-input" class="form-control"  aria-describedby="emailHelp" accept="image/*">
                                                        </div>   
                                                        <div class="col-lg-6">
                                                            <div class="activity_image_preview mt-3 mt-lg-0">
                                                                <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="" class="activity_current_image">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <input type="hidden" name="old_image" value="<?php echo $activity['image']; ?>">
      
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary w-100 mt-3 mt-lg-0">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
           
    </div>
</div>

<script>

    // Обработчик изменения значения поля "Выберите категорию"
   

    

    $('#social_activity_category').on('change', function() {
        // Получить выбранную категорию
        var selectedCategory = $(this).val();

        // Определить контейнер, в который будут добавлены элементы для выбранной категории
        var container = $('.social_activity_type');

        // Очистить контейнер от предыдущих элементов
        container.empty();

        // Создать и добавить новые элементы в зависимости от выбранной категории
        if (selectedCategory === 'in_fond') {
            container.append(
                ` <div class="col-lg-12 profile-input mb-3">
                                                        
                    <label class="form-label">Тип участия в деятельности *</label>
            
                    <select class="form-select" id="social_activity_type" name="social_activity_type">
                        <option value="curator" <?php if ($activity['activity_type'] === 'curator') echo 'selected'; ?>>Куратор направления стипендиальной программы Фонда (5 баллов)</option>
                        <option value="participant" <?php if ($activity['activity_type'] === 'participant') echo 'selected'; ?>>Участник направления стипендиальной программы Фонда (3 балла)</option>
                    </select>
                </div>`
            )
        } else if (selectedCategory === 'not_only_in_fond') {
            container.append(
                ` <div class="col-lg-12 profile-input mb-3">
                                                        
                    <label class="form-label">Тип участия в деятельности *</label>
            
                    <select class="form-select" id="social_activity_type" name="social_activity_type">
                        <option value="international" <?php if ($activity['activity_type'] === 'international') echo 'selected'; ?>>Организатор Международных и Всероссийских мероприятий (5 баллов)</option>
                        <option value="russian" <?php if ($activity['activity_type'] === 'russian') echo 'selected'; ?>>Организатор Региональных мероприятий (3 балла)</option>
                        <option value="regional" <?php if ($activity['activity_type'] === 'regional') echo 'selected'; ?>>Организатор Университетских мероприятий (1 балл)</option>
                        <option value="management_team" <?php if ($activity['activity_type'] === 'management_team') echo 'selected'; ?>>Вхожу в руководящий состав СНО и/или иных сообществ института/ школы или вуза (1 балл)</option>
                   
                    </select>
                </div>`
            );
        } 
    });

    $('#social_activity_category').trigger('change');

   
    $('#update-social-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {

                console.log(response);

                var res = JSON.parse(response);

                $('.activity_current_title').text(res.new_title);
                $('.activity_current_image').attr('src', res.new_image);

                showAlert('Данные успешно обновлены', 'success');
            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<?php require "footer.php"?>