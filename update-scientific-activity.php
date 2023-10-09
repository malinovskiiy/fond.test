<?php 
require "header.php";

if(!isset($_SESSION['user'])){
	header("Location: 404.php");
}

$activity = $ScientificActivityService->getById($_GET['id']);

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
                                        <span class="text-primary fw-bold fs-5">Изменить научную деятельность<br><span class="text-dark activity_current_title"><?php echo $activity['title']; ?></span></span><p>* - обязательные поля</p>
                                    </div>
                                    <form id="update-scientific-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">
                                        <input type="hidden" name="update_scientific_activity" value="true">
                                        <input type="hidden" name="activity_id" value="<?php echo $activity['activity_id']?>">
                                        <div class="row">
                                            <div class="col-lg-6 profile-input mb-3">                                       
                                                <label class="form-label">Выберите категорию *</label>                                        
                                                <select class="form-select" name="activity_category" id="activity_category">
                                                    <option value="publication" <?php if ($activity['activity_category'] === 'publication') echo 'selected'; ?>>Публикация</option>
                                                    <option value="intellectual_property" <?php if ($activity['activity_category'] === 'intellectual_property') echo 'selected'; ?>>Интеллектуальная собственность</option>
                                                    <option value="grant_activity" <?php if ($activity['activity_category'] === 'grant_activity') echo 'selected'; ?>>Грантовая деятельность</option>
                                                    <option value="conferences" <?php if ($activity['activity_category'] === 'conferences') echo 'selected'; ?>>Конференции и конкурсы НИР</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row science_activity_type">
                                                    
                                        </div>
                                        <div class="profile-input mb-3">
                                            <label class="form-label">Год *</label>
                                            <div class="col-lg-2">
                                                <input type="number" max="9999" min="0" type="text" id="science-year-input" name="science-year-input" class="form-control"  aria-describedby="emailHelp" required value="<?php echo $activity['year']; ?>">
                                            </div>
                                        </div>
                                        <div class="profile-input mb-3">
                                            <label class="form-label">Полное название *</label>
                                            <input type="text" id="science-title-input" name="science-title-input" class="form-control"  aria-describedby="emailHelp" required value="<?php echo $activity['title']; ?>">
                                        </div>
                                        <div class="profile-input mb-3">
                                            <label class="form-label">Краткое описание (не более 300 символов)</label>
                                            <textarea maxlength="300" id="science-description-input" name="science-description-input" class="form-control"  aria-describedby="emailHelp"><?php echo $activity['preview_text']; ?></textarea>
                                        </div>
                                        <div class="profile-input mb-3">
                                            <label class="form-label">Ссылка (необязательно)</label>
                                            <input type="text" id="science-link-input" name="science-link-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $activity['link']; ?>">
                                        </div>
                                        <div class="profile-input mb-5">
                                            
                                            <div class="row d-flex align-items-center">
                                                <div class="col-lg-6">
                                                <label class="form-label">Картинка (необязательно)</label>
                                                    <input type="file" id="science-image-input" name="science-image-input" class="form-control"  aria-describedby="emailHelp" accept="image/*">
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
    $('#activity_category').on('change', function() {
        // Получить выбранную категорию
        var selectedCategory = $(this).val();

        console.log(selectedCategory);

        // Определить контейнер, в который будут добавлены элементы для выбранной категории
        var container = $('.science_activity_type');

        // Очистить контейнер от предыдущих элементов
        container.empty();

        // Создать и добавить новые элементы в зависимости от выбранной категории
        if (selectedCategory === 'publication') {
            container.append(
                ` <div class="col-lg-6 profile-input mb-3">
                                                        
                    <label class="form-label">Выберите тип публикации *</label>
            
                    <select class="form-select" name="publication_type" id="publication_type">
                        <option value="scopus" <?php if ($activity['activity_type'] === 'scopus') echo 'selected'; ?>>SCOPUS/WoS</option>
                        <option value="vak" <?php if ($activity['activity_type'] === 'vak') echo 'selected'; ?>>ВАК</option>
                        <option value="rinc" <?php if ($activity['activity_type'] === 'rinc') echo 'selected'; ?>>РИНЦ</option>
                    </select>
                </div>
                <div class="col-lg-6 publication_rating">
                    <div class="profile-input mb-3">
                    
                    <label class="form-label">Выберите рейтинг публикации SCOPUS/WoS *</label>
                    
                    
                            <select class="form-select" name="publication_rating" id="publication_rating">
                                <option value="q1" <?php if ($activity['activity_subtype'] === 'q1') echo 'selected'; ?>>Q1 (10 баллов)</option>
                                <option value="q2" <?php if ($activity['activity_subtype'] === 'q2') echo 'selected'; ?>>Q2 (7 баллов)</option>
                                <option value="q3" <?php if ($activity['activity_subtype'] === 'q3') echo 'selected'; ?>>Q3 (5 баллов)</option>    
                            </select>

                    </div>
                </div>`
            );

            $('#publication_type').on('change', function() {
                var selectedType = $(this).val();

                console.log(selectedType);
                var ratingSelect = $('.publication_rating');

                if (selectedType === 'scopus') {
                    ratingSelect.show();
                } else {
                    ratingSelect.hide();
                }
            });
        } else if (selectedCategory === 'intellectual_property') {
            container.append(
                ` <div class="col-lg-7 profile-input mb-3">
                                                        
                        <label class="form-label">Выберите тип интеллектуальной собственности *</label>
                
                        <select class="form-select" name="publication_type" id="publication_type">
                            <option value="patent" <?php if ($activity['activity_type'] === 'patent') echo 'selected'; ?>>Патент</option>
                            <option value="computer_certificate" <?php if ($activity['activity_type'] === 'computer_certificate') echo 'selected'; ?>>Свидетельство регистрации программы для ЭВМ</option>
                        </select>
                    </div>
                    <div class="col-lg-5 publication_rating">
                        <div class="profile-input mb-3">
                        
                        <label class="form-label">Выберите тип патента *</label>
                        
                        
                                <select class="form-select" name="publication_rating" id="publication_rating">
                                    <option value="invention" <?php if ($activity['activity_subtype'] === 'invention') echo 'selected'; ?>>На изобретение (10 баллов)</option>
                                    <option value="model" <?php if ($activity['activity_subtype'] === 'model') echo 'selected'; ?>>На полезную модель (5 баллов)</option>
                                    
                                </select>
        
                        </div>
                    </div>`
            );
            $('#publication_type').on('change', function() {
                var selectedType = $(this).val();

                console.log(selectedType);
                var ratingSelect = $('.publication_rating');

                if (selectedType === 'patent') {
                    ratingSelect.show();
                } else {
                    ratingSelect.hide();
                }
            });
        } else if (selectedCategory === 'grant_activity') {
            container.append(
                `<div class="col-lg-6 profile-input mb-3">
                                                        
                    <label class="form-label">Выберите тип гранта *</label>
            
                    <select class="form-select" name="publication_type" id="publication_type">
                        <option value="international" <?php if ($activity['activity_type'] === 'international') echo 'selected'; ?>>Международный</option>
                        <option value="russian" <?php if ($activity['activity_type'] === 'russian') echo 'selected'; ?>>Всероссийский</option>
                        <option value="regional" <?php if ($activity['activity_type'] === 'regional') echo 'selected'; ?>>Региональный</option>
                    </select>
                </div>
                <div class="col-lg-6 publication_rating">
                    <div class="profile-input mb-3">
                    
                    <label class="form-label">Выберите тип участия в гранте *</label>
                    
                    
                            <select class="form-select" name="publication_rating" id="publication_rating">
                                <option value="head" <?php if ($activity['activity_subtype'] === 'head') echo 'selected'; ?>>Руководитель</option>
                                <option value="performer" <?php if ($activity['activity_subtype'] === 'performer') echo 'selected'; ?>>Исполнитель</option>
                                
                            </select>

                    </div>
                </div>`
            );
        } else if (selectedCategory === 'conferences') {
            container.append(
                `<div class="col-lg-6 profile-input mb-3">
                                                        
                    <label class="form-label">Выберите тип конференции или конкурса *</label>
            
                    <select class="form-select" name="publication_type" id="publication_type">
                        <option value="international" <?php if ($activity['activity_type'] === 'international') echo 'selected'; ?>>Международный (5 баллов)</option>
                        <option value="russian" <?php if ($activity['activity_type'] === 'russian') echo 'selected'; ?>>Всероссийский (3 балла)</option>
                        <option value="regional" <?php if ($activity['activity_type'] === 'regional') echo 'selected'; ?>>Региональный (1 балл)</option>
                    </select>
                </div>`
            );
        }
    });

    $('#activity_category').trigger('change');

    $('#update-scientific-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {

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