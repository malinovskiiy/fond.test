<?php 

$site_title = 'Изменить просветительскую деятельность';

require "header.php";

if(!isset($_SESSION['user'])){
	header("Location: 404.php");
}

$activity = $EducationalActivityService->getById($_GET['id']);

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
                                <div class="tab-pane fade show active" id="v-pills-science-activity" role="tabpanel" aria-labelledby="v-pills-science-activity-tab">
                                    <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                        <span class="text-primary fw-bold fs-5">Изменить просветительскую деятельность<br><span class="text-dark activity_current_title"><?php echo $activity['title']; ?></span></span><p>* - обязательные поля</p>
                                    </div>
                                    
                                    <form id="update-educational-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                            
                                               <input type="hidden" name="update_educational_activity" value="true">
                                               <input type="hidden" name="activity_id" value="<?php echo $activity['activity_id']?>">
                                               <div class="row educational_activity_type">
                                                    <div class="col-lg-7 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип деятельности *</label>
                                                
                                                        <select class="form-select" id="educational_type" name="educational_type">
                                                            <option value="international" <?php if ($activity['activity_category'] === 'international') echo 'selected'; ?>>Спикер на Международных мероприятиях (5 баллов)</option>
                                                            <option value="russian" <?php if ($activity['activity_category'] === 'russian') echo 'selected'; ?>>Спикер на Всероссийских мероприятиях (3 балла)</option>
                                                            <option value="regional" <?php if ($activity['activity_category'] === 'regional') echo 'selected'; ?>>Спикер на Региональных мероприятиях (1 балл)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input  type="number" max="9999" min="0" type="text" id="educational-year-input" name="educational-year-input" class="form-control"  aria-describedby="emailHelp" required value="<?php echo $activity['year']?>">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="educational-title-input" name="educational-title-input" class="form-control"  aria-describedby="emailHelp" required value="<?php echo $activity['title']?>">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                
                                                   
                                                   <textarea maxlength="300" id="educational-description-input" name="educational-description-input" class="form-control"  aria-describedby="emailHelp"><?php echo $activity['preview_text']?></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="educational-link-input" name="educational-link-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $activity['link']?>">
                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-lg-6">
                                                            <label class="form-label">Картинка (останется прошлая если не загружать)</label>
                                                            <input type="file" id="educational-image-input" name="educational-image-input" class="form-control"  aria-describedby="emailHelp">

                                                        </div>   
                                                        <div class="col-lg-6">
                                                            <div class="activity_image_preview mt-3 mt-lg-0">
                                                                <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="" class="activity_current_image">
                                                            </div>
                                                        </div>   
                                                    </div>
                                                             
                                               </div>
                                                
                                               <input type="hidden" name="old_image" value="<?php echo $activity['image']; ?>">

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary w-100 mt-3 mt-lg-0">Вернуться назад</a>
                                                    </div>
                                                </div>
                                               
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

    $('#update-educational-activity').on('submit', function(e) {
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

                console.log(res.new_title)

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