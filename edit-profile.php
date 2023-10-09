<?php 
require "header.php";

if(!isset($_SESSION['user'])){
	header("Location: 404.php");
}

if(isset($_POST['set_avatar'])){

	$avatar = $_FILES['avatar'];

	$type = $avatar['type'];

	$filename = "uploads/profile_img/". md5(microtime()).".".substr($type, strlen("image/"));
    
    // First check avatar then load to server
	if(avatarSecurity($avatar)){
        unset($_SESSION['avatar_error']);
		move_uploaded_file($_FILES['avatar']['tmp_name'], $filename);
		$UserService->updateAvatar($filename, $_SESSION['user']['id']);
	} else {
        $_SESSION['avatar_error'] = 'Попробуйте другое изображение';
    }
}

?>

<div class="page-wrapper position-relative py-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-9">
                <main class="main">     
                    <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-5 px-md-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div class="tab-content w-100" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-main-info" role="tabpanel" aria-labelledby="v-pills-main-info-tab">
                                            
                                            <div class="row profile-input mb-5 align-items-center">
                                            <h5 class="text-primary fw-bold mb-5">Общие сведения</h5>
                                                <div class="col-lg-4 text-lg-end">
                                                    <label class="form-label">Изменить фото профиля</label>
                                                    
                                                </div>
                                                <div class="col-lg-2 mt-3 mt-lg-0">
                                                    <div class="profile-picture">
                                                        
                                                        <img src="<?php echo $UserData['image']?>" class="rounded-circle" alt="profile-picture">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-3 mt-lg-0">
                                                    
                                                    <form action="/edit-profile" method="POST" enctype="multipart/form-data" class="d-flex">

                                                    <div class="group">
                                                        <input type="file" class="form-control <?php if($_SESSION['avatar_error']):?>is-invalid<?php endif ?>" name="avatar" required id="file-input">
                                                        <div class="invalid-feedback">
                                                            <?php if($_SESSION['avatar_error']):?>
                                                                <?php echo $_SESSION['avatar_error'];?>
                                                            <?php endif ?>
                                                            
                                                        </div>
                                                    </div>
                                                        
                                    
                                                        <button type="submit" name="set_avatar" class="btn btn-secondary ms-3">Изменить</button>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                            <form id="update-main" method="POST" action="" class="profile-input-group">
                                               
                                                <hr>
                                                <div class="row profile-input mt-5 mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Никнейм</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input type="text" id="username-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['username']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Фамилия</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input type="text" id="last-name-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['last_name']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Имя</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input type="text" id="first-name-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['first_name']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Отчество (при наличии)</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input type="text" id="patronymic-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['patronymic']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Дата рождения</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                    <input type="date" id="date-of-birth-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['date_of_birth']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Город</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                    <input type="text" id="city-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['city']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Уровень вовлечения в проекты фонда</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                    <select class="form-select" aria-label="Default select example" id="involvement-level-input">
                                                        <option selected>Выберите...</option>
                                                        <option value="0">Стипендиат</option>
                                                        <option value="1">Член Ассоциации</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Тематика исследований</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="research-topic-input" class="form-control"  aria-describedby="emailHelp"><?php echo $UserData['research_topic']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Обо мне</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="about-text-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "><?php echo $UserData['about_text']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Доп. умения и навыки</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="extra-skills-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "><?php echo $UserData['extra_skills']?></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                </div>
                                            </form>        
                                        </div>
                                        <div class="tab-pane fade " id="v-pills-study" role="tabpanel" aria-labelledby="v-pills-study-tab">
                                            <!-- Update study info form -->
                                            <form method="POST" id="update-study" action="" class="profile-input-group">
                                                <h5 class="text-primary fw-bold mb-5">Образование</h5>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Место учебы (полностью)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="study-place-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "><?php echo $UserData['study_place']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Город обучения</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input id="study-city-input" type="text" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['study_city']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Уровень обучения</label>
                                                    </div>
                                                    <div class="col-lg-4">
                                                    <select id="study-level-input" class="form-select">
                                                        <option selected>Выберите...</option>
                                                        <option value="1">Студент</option>
                                                        <option value="2">Магистрант</option>
                                                        <option value="3">Аспирант</option>
                                                        <option value="4">Докторант</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Курс (текущий уровень обучения)</label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                    <select id="study-year-input" class="form-select" aria-label="Default select example">
                                                        <option selected>Выберите...</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Институт/школа</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input id="study-institution-input" type="text" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['study_institution']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Направление</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input id="study-direction-input" type="text" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['study_direction']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Средний балл зачётки</label>
                                                    </div>
                                                    <div class="col-lg-2">
                                                    <input id="study-average-grade-input" type="text" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['study_average_grade']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">
                                                            Иностранный язык и уровень владения (если есть сертификат с подтверждением уровня - данные сертификата)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="study-languages-input"class="form-control"  aria-describedby="emailHelp" value="
                                                    "><?php echo $UserData['study_languages']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                </div>
                                            </form>
                                            
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-science" role="tabpanel" aria-labelledby="v-pills-science-tab">
                                            <form method="POST" action="" id="update-science" class="profile-input-group">
                                                <h5 class="text-primary fw-bold mb-5">Научная деятельность</h5>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Ученая степень</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <input type="text" id="science-degree-input" class="form-control"  aria-describedby="emailHelp" value="<?php echo $UserData['science_degree']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Тема НИР</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="science-work-topic-input" class="form-control"  aria-describedby="emailHelp"><?php echo $UserData['science_work_topic']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Одно главное достижение в научной и/или учебной деятельности (за последние 3 года, с января 2021)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="science-main-achievement-input" class="form-control"  aria-describedby="emailHelp"><?php echo $UserData['science_main_achievement']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Членство в научных сообществах (с указанием должности/ статуса, при наличии)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="science-societies-input" class="form-control"  aria-describedby="emailHelp"><?php echo $UserData['science_societies']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Членство в иных сообществах (с указанием должности/ статуса, при наличии)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="science-other-societies-input" class="form-control"  aria-describedby="emailHelp"><?php echo $UserData['science_other_societies']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">“Я - эксперт” (названия конкурсов и проектов)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="science-ya-expert-input" class="form-control"  aria-describedby="emailHelp"><?php echo $UserData['science_ya_expert']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">“Я - амбассадор” (названия конкурсов и проектов)</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <textarea id="science-ya-ambassador-input" class="form-control"  aria-describedby="emailHelp"><?php echo $UserData['science_ya_ambassador']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-primary w-100">Сохранить</button>
                                                    </div>        
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-job-info" role="tabpanel" aria-labelledby="v-pills-job-info-tab">
                                            <h5 class="text-primary fw-bold mb-5">Трудовая деятельность</h5>
                                            <div class="user-workplaces">
                                                
                                                
                                            </div>
                                            
                                        
                                            <div class="row">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-4">
                                                    <button onclick="createWorkplace()" class="mb-3 btn btn-outline-primary w-100">Добавить место работы</button>

                                                    <button onclick="updateWorkplaces()" class="btn btn-primary w-100">Сохранить</button>
                                                </div>        
                                            </div>                         
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-contacts" role="tabpanel" aria-labelledby="v-pills-contacts-tab">
                                            <!-- Empty action for AJAX query -->
                                            <form method="POST" action="" id="update-contacts" class="profile-input-group">
                                                <h5 class="text-primary fw-bold mb-5">Контакты</h5>
                                                
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Телефон</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input type="text" class="form-control"  aria-describedby="emailHelp" id="profile-phone-input" value="<?php echo $UserData['phone']?>">
                                                    </div>
                                                </div>
                                                <div class="row profile-input mb-3">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label  class="form-label">Ник в Telegram</label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <input type="text" class="form-control"  aria-describedby="emailHelp" id="profile-telegram-input" value="<?php echo $UserData['telegram']?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>   
                                        <div class="tab-pane fade" id="v-pills-keywords" role="tabpanel" aria-labelledby="v-pills-keywords-tab">
                                            <div class="profile-input-group">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <h5 class="text-primary fw-bold mb-5">Ключевые слова</h5>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="row mb-4">
                                                    <div class="col-lg-4 text-lg-end mb-3 mb-lg-0"><i class="fa-solid fa-circle-info text-primary me-2"></i>Чтобы добавить ключевое слово в свой список нажмите на нужное слово из списка</div>
                                                    <div class="col-lg-8">
                                                        <div id="profile-keyword-suggestion-list">
                                                            
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row profile-input mb-5">
                                                    <div class="col-lg-4 text-lg-end">
                                                        <label class="form-label">Поиск ключевого слова</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="keywords" aria-describedby="emailHelp" placeholder="Начните вводить ключевое слово">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row mt-5">
                                                    <div class="col-lg-4 text-lg-end">
                                                    <label class="form-label"><b>Ваш список ключевых слов:</b> <br>Максимум: 6<br><br><i class="fa-solid fa-circle-info text-primary me-2"></i>Нажмите на слово из вашего списка чтобы удалить его</label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div id="profile-keyword-list">
                                                           
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div class="col-lg-3 order-first order-lg-last">
                <aside class="sidebar">
                    <div class="profile-card bg-white w-100 shadow mt-4 p-5">
                        <h5 class="text-primary fw-bold ps-3">Редактирование профиля</h5>
                        <div class="nav flex-column nav-pills mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active text-start" id="v-pills-main-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-main-info" type="button" role="tab" aria-controls="v-pills-main-info" aria-selected="true">Общие сведения</button>
                                <button class="nav-link text-start" id="v-pills-study-tab" data-bs-toggle="pill" data-bs-target="#v-pills-study" type="button" role="tab" aria-controls="v-pills-study" aria-selected="false">Образование</button>
                                <button class="nav-link text-start" id="v-pills-science-tab" data-bs-toggle="pill" data-bs-target="#v-pills-science" type="button" role="tab" aria-controls="v-pills-science" aria-selected="false">Научная деятельность</button>
                                <button class="nav-link text-start" id="v-pills-job-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-job-info" type="button" role="tab" aria-controls="v-pills-job-info" aria-selected="false">Работа</button>
                                <button class="nav-link text-start" id="v-pills-contacts-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contacts" type="button" role="tab" aria-controls="v-pills-contacts" aria-selected="false">Контакты</button>     
                                <button class="nav-link text-start" id="v-pills-keywords-tab" data-bs-toggle="pill" data-bs-target="#v-pills-keywords" type="button" role="tab" aria-controls="v-pills-keywords" aria-selected="false">Ключевые слова</button>     
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<script>
        // Функция для загрузки доступных рабочих мест для редактирования
        function loadWorkPlaces() {
            $.ajax({
                url: 'profile-controller.php',
                method: 'POST',
                data: {get_workplaces: true},
                success: function(response) {

                    // Очистим элемент #profile-keyword-suggestion-list
                    $('.user-workplaces').empty();

                    var workPlaces = JSON.parse(response)

                    // Найти div с классом "user-workspaces"
                    var userWorkspacesDiv = document.querySelector('.user-workplaces');

                    // Перебрать элементы массива work_places и создать новые div для каждого элемента
                    workPlaces.forEach(function(workPlace) {
                        var newUserWorkplaceDiv = document.createElement('div');
                        newUserWorkplaceDiv.classList.add('user-workplace');

                        var workplaceHtml = `
                            <div class="row profile-input mb-3">
                                <div class="col-lg-4 text-end">
                                    <label class="form-label">Место работы (полностью)</label>
                                    
                                    <button class="delete-workplace-btn ms-3 fa-solid fa-xmark btn btn-sm btn-danger" title="Удалить место работы" onclick="deleteWorkplace('${workPlace.id}')" data-workplace-id="${workPlace.id}"></button>
                                    
                                </div>
                                <div class="col-lg-8">
                                    <textarea class="form-control workplace-name" aria-describedby="emailHelp">${workPlace.name}</textarea>
                                </div>
                            </div>
                            <div class="row profile-input mb-3">
                                <div class="col-lg-4 text-lg-end">
                                    <label class="form-label">Должность</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control workplace-position" aria-describedby="emailHelp" value="${workPlace.position}">
                                </div>
                            </div>
                        `;

                        newUserWorkplaceDiv.innerHTML = workplaceHtml;
                        userWorkspacesDiv.appendChild(newUserWorkplaceDiv);
                    });
                }
            });
        }


        function updateWorkplaces(){

            // Найти div с классом "user-workspaces"
            var userWorkspacesDiv = document.querySelectorAll('.user-workplace');

            var newJsonPayload = [];

            userWorkspacesDiv.forEach(function(workPlace){
                var button = workPlace.querySelector('button');
                var workplace_name = workPlace.querySelector('.workplace-name');
                var workplace_position = workPlace.querySelector('.workplace-position');

                newJsonPayload.push({
                    "id": button.getAttribute('data-workplace-id'),
                    "name": workplace_name.value, // You can replace this with the actual name you want to assign.
                    "position": workplace_position.value, // You can replace this with the actual position you want to assign.
                });
                
            })

            $.ajax({
                url: 'profile-controller.php',
                method: 'POST',
                data: {
                    update_workplaces: true,
                    workplaces: JSON.stringify(newJsonPayload)
                },
                success: function(response) {
                    
                    showAlert('Места работы обновлены', 'success');
                    loadWorkPlaces();
                }
            });
        }

        // Отправка формы для удаления рабочего места
        function deleteWorkplace(workplace_id) {
            $.ajax({
                url: 'profile-controller.php',
                method: 'POST',
                data: {
                    delete_workplace: true,
                    workplace_id: workplace_id
                },
                success: function(response) {
                    showAlert('Место работы удалено', 'success');
                    loadWorkPlaces();
                }
            });
        };

        // Отправка формы для добавления рабочего места
        function createWorkplace() {
            $.ajax({
                url: 'profile-controller.php',
                method: 'POST',
                data: {
                    create_workplace: true
                },
                success: function(response) {
                    showAlert('Место работы добавлено', 'success');
                    loadWorkPlaces(); // Обновляем список доступных рабочих мест
                }
            });
        };



        $(document).ready(function() {

            // Загрузка доступных рабочих мест при загрузке страницы
            loadWorkPlaces();

            loadKeywords();

            $('#keywords').on('input', function() {
                // Вызов функции для загрузки подсказок
                loadSuggestions($(this).val());
            });
            
            $('.user-keywords-btn').on('click', function() {
                toggleKeyword(this.getAttribute('data-keyword-id'))
            })

            $('.keyword-alert').hide();

         
            $('#update-contacts').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'profile-controller.php',
                    data: {
                        update_profile_contacts: true,
                        phone: $('#profile-phone-input').val(),
                        telegram: $('#profile-telegram-input').val(),
                    }, // Передаем payload
                    success: function(response) {
                        showAlert('Данные успешно обновлены', 'success');
                    },
                    error: function(xhr, status, error) {
                        
                        console.error('Произошла ошибка при выполнении POST-запроса:', error);
                    }
                });
            });

            // Science form submit handler
            $('#update-main').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'profile-controller.php',
                    data: {
                        update_profile_main: true,
                        username: $('#username-input').val(),
                        last_name: $('#last-name-input').val(),
                        first_name: $('#first-name-input').val(),
                        patronymic: $('#patronymic-input').val(),
                        date_of_birth: $('#date-of-birth-input').val(),
                        city: $('#city-input').val(),
                        involvement_level: $('#involvement-level-input').val(),
                        research_topic: $('#research-topic-input').val(),
                        about_text: $('#about-text-input').val(),
                        extra_skills: $('#extra-skills-input').val(),
                        
                    }, // Передаем payload
                    success: function(response) {

                        
                        $('.header-first-name').text($('#first-name-input').val());
                        showAlert('Данные успешно обновлены', 'success');
                    },
                    error: function(xhr, status, error) {
                        // Обработка ошибок (если нужно)
                        console.error('Произошла ошибка при выполнении POST-запроса:', error);
                    }
                });

                
            });

            // Science form submit handler
            $('#update-science').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'profile-controller.php',
                    data: {
                        update_profile_science: true,
                        science_degree: $('#science-degree-input').val(),
                        science_work_topic: $('#science-work-topic-input').val(),
                        science_main_achievement: $('#science-main-achievement-input').val(),
                        science_societies: $('#science-societies-input').val(),
                        science_other_societies: $('#science-other-societies-input').val(),
                        science_ya_expert: $('#science-ya-expert-input').val(),
                        science_ya_ambassador: $('#science-ya-ambassador-input').val(),
                        
                    }, // Передаем payload
                    success: function(response) {
                        showAlert('Данные успешно обновлены', 'success');
                    },
                    error: function(xhr, status, error) {
                        // Обработка ошибок (если нужно)
                        console.error('Произошла ошибка при выполнении POST-запроса:', error);
                    }
                });

                
            });

           

            // Study form submit handler
            $('#update-study').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'profile-controller.php',
                    data: {
                        update_profile_study: true,
                        study_place: $('#study-place-input').val(),
                        study_city: $('#study-city-input').val(),
                        study_level: $('#study-level-input').val(),
                        study_year: $('#study-year-input').val(),
                        study_institution: $('#study-institution-input').val(),
                        study_direction: $('#study-direction-input').val(),
                        study_average_grade: $('#study-average-grade-input').val(),
                        study_languages: $('#study-languages-input').val(),
                        
                    }, // Передаем payload
                    success: function(response) {

                        console.log(response);

                        showAlert('Данные успешно обновлены', 'success');
                    },
                    error: function(xhr, status, error) {
                        // Обработка ошибок (если нужно)
                        console.error('Произошла ошибка при выполнении POST-запроса:', error);
                    }
                });
            });

            // Get the value of study_level from your PHP variable
            var selectedStudyLevel = <?php echo $UserData['study_level'] ? $UserData['study_level'] : '0'; ?>;

            // Set the selected option based on the value
            $("#study-level-input").val(selectedStudyLevel);

            // Add a change event listener to update the selected value
            $("#study-level-input").change(function() {
                selectedStudyLevel = $(this).val();
            });

            // Get the value of study_level from your PHP variable
            var selectedStudyYear = <?php echo $UserData['study_year'] ? $UserData['study_year'] : '0'; ?>;

            // Set the selected option based on the value
            $("#study-year-input").val(selectedStudyYear);

            // Add a change event listener to update the selected value
            $("#study-year-input").change(function() {
                selectedStudyYear = $(this).val();
            });

            // Get the value of study_level from your PHP variable
            var selectedInvolvementLevel = <?php echo $UserData['involvement_level'] ? $UserData['involvement_level'] : '0'; ?>;

            // Set the selected option based on the value
            $("#involvement-level-input").val(selectedInvolvementLevel);

            // Add a change event listener to update the selected value
            $("#involvement-level-input").change(function() {
                selectedInvolvementLevel = $(this).val();
            });

        });

        
        function loadKeywords(){
            $.ajax({
                type: 'POST',
                url: 'profile-controller.php',
                data: {get_keywords: true }, // Передаем параметр get_keywords
                success: function(response) {

                    loadSuggestions('');
                    
                    // Очистим элемент #profile-keyword-suggestion-list
                    $('#profile-keyword-list').empty();
                    
                    // Распарсим JSON-строку в объект JavaScript
                    var keywords = JSON.parse(response);

                    // Создаем кнопки на основе данных и добавляем их в элемент
                    for (var i = 0; i < keywords.length; i++) {
                        // Создание кнопки и запись в неё названия ключевого слова
                        var keywordButton = document.createElement('button');
                        keywordButton.innerHTML = keywords[i].name + ' &times;';
                        keywordButton.setAttribute("data-keyword-id", keywords[i].id);

                        // Добавляем класс кнопке (если нужно)
                        keywordButton.className = 'btn btn-sm btn-secondary me-2 mb-2';


                        // Добавляем обработчик события на кнопку (если нужно)
                        keywordButton.addEventListener('click', function() {
                            var keywordId = this.getAttribute('data-keyword-id'); // Получаем keyword_id

                            toggleKeyword(keywordId);
                        });

                       
                        // Добавляем кнопку в элемент #profile-keyword-suggestion-list
                        $('#profile-keyword-list').append(keywordButton);
                         
                    }
                },
                error: function(xhr, status, error) {
                    // Обработка ошибок (если нужно)
                    console.error('Произошла ошибка при выполнении POST-запроса:', error);
                }
            });
        }
        
        function toggleKeyword(keywordId){
            // Выполняем POST-запрос на сервер
            $.ajax({
                type: 'POST',
                url: 'profile-controller.php',
                data: { keyword_id: keywordId }, // Передаем параметр keyword_id
                success: function(response) {

                    res = JSON.parse(response);

                    $('#keywords').val('');
                    loadKeywords();

                    if(res.error){
                        showAlert(res.error, 'warning');
                    } else {
                        showAlert('Успешно', 'success');
                    }

                    $('.keyword-alert').show();

                    
                },
                error: function(xhr, status, error) {
                    // Обработка ошибок (если нужно)
                    console.error('Произошла ошибка при выполнении POST-запроса:', error);
                }
            });
        }

        function loadSuggestions(keyword){
            $.ajax({
                type: 'GET',
                url: 'profile-controller.php',
                data: { keyword: keyword },
                success: function(response) {
                    // Очистим элемент #profile-keyword-suggestion-list
                    $('#profile-keyword-suggestion-list').empty();

                    // Распарсим JSON-строку в объект JavaScript
                    var suggestions = JSON.parse(response);

                    // Создаем кнопки на основе данных и добавляем их в элемент
                    for (var i = 0; i < suggestions.length; i++) {
                        // Создание кнопки и запись в неё названия ключевого слова
                        var keywordButton = document.createElement('button');
                        keywordButton.innerHTML = suggestions[i].name + " +";
                        keywordButton.setAttribute("data-keyword-id", suggestions[i].id);

                        // Добавляем класс кнопке (если нужно)
                        keywordButton.className = 'btn btn-sm btn-outline-secondary me-2 mb-2';

                        // Добавляем обработчик события на кнопку (если нужно)
                        keywordButton.addEventListener('click', function() {
                            var keywordId = this.getAttribute('data-keyword-id'); // Получаем keyword_id

                            toggleKeyword(keywordId)
                        });

                        // Добавляем кнопку в элемент #profile-keyword-suggestion-list
                        $('#profile-keyword-suggestion-list').append(keywordButton);
                    }

                    
                },
                error: function(xhr, status, error) {
                    // Обработка ошибок (если нужно)
                    console.error('Произошла ошибка при выполнении POST-запроса:', error);
                }
            });
        }
</script>

<?php require "footer.php"?>