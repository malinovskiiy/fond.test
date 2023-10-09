<?php
require_once "header.php";

// In this component $UserData REPLACED with $user_data all the same logic

if(isset($_SESSION['user'])){
    // Problem fixed with non existing account views by condidtion $User->getUserById($_GET['id'])
    if(isset($_GET['id']) && is_numeric($_GET['id']) && $UserService->getUserById($_GET['id'])){
        $user_data = $UserService->getUserById($_GET['id'])[0];
        
        if($_SESSION['user']['id'] === $user_data['id']){
            header('Location: /dashboard.php');
        }
    } else {
        header('Location: ./404.php');
    }
} else {
    header('Location: ./404.php');
}

?>

<div class="page-wrapper py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-9">
                    <main class="main">
                        <div class="profile-card bg-white w-100 shadow mt-4 p-4 p-md-5">
                            <div class="row">
                                <div class="col-lg-7 d-flex flex-column">
                                    <div class="profile-main d-flex">
                                        <div class="profile-picture">
                                            <img src="<?php echo $user_data['image']?>" class="rounded-circle" alt="profile-picture">
                                        </div>
                                        <div class="profile-info ms-4">
                                            <div class="profile-name d-flex align-items-center flex-wrap">
                                               <h4 class="fw-bold"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></h4>
                                            </div>
                                            <div class="profile-role">
                                                <h6 class="text-primary fw-bold"> <?php if($user_data['involvement_level'] == 1):?>
                                                        Член ассоциации
                                                    <?php else:?>
                                                        Стипендиат
                                                    <?php endif ?></h6>
                                            </div>
                                            <div class="profile-contacts d-flex flex-column">
                                                <span class="text-break">@<?php echo $user_data['username']?></span>
                                                
                                                <span class="mt-2"><i class="fa-solid fa-building-columns"></i> <?php echo $user_data['study_place']?></span>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="profile-actions mt-4 d-flex flex-wrap align-items-start">
                                        <div class="form-group">
                                            <button class="btn btn-outline-primary mb-2 mb-md-0">Сообщение</button>
                                            <button class="btn btn-primary ms-md-2 mb-2 mb-md-0">Поделиться<i class="fa-solid fa-up-right-from-square ms-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 pt-4 pt-lg-0 d-flex flex-column justify-content-between">
                                    <h5 class="text-primary fw-bold">Тематика исследований</h5>
                                    <p class="mt-3">
                                    <?php echo $user_data['research_topic']?>
                                    </p>
                                    <ul class="profile-tags d-flex flex-wrap align-items-start">
                                        
                                        <?php foreach (explode(",", $user_data['keywords']) as $keyword): ?>
                                            <li class="px-3 py-2 me-2 mt-2 btn btn-sm btn-outline-secondary">
                                                <?php echo $KeywordService->getKeywordById(intval(str_replace(['"', "[", "]"], '', $keyword)))[0]['name'];?>
                                            </li>
                                        <?php endforeach?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-5 px-md-5">
                            <h5 class="text-primary fw-bold">Комплексный рейтинг</h5>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Научная деятельность</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Учебная деятельность</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Спортивная деятельность</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Общественная деятельность</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Просветительская деятельность</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Волонтёрская деятельность</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Публикационная деятельность</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за год</span></div> ">Практики и стажировки</span>
                                        <div class="progress mt-3">
                                            <div class="progress-bar" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-4 px-md-5">
                            <h5 class="text-primary fw-bold">Участие в проектах Фонда</h5>
                            <div class="row">
                                <div class="col-12">
                                    <p class="mt-3">
                                        Руководитель направления <span class="text-primary">«Экопросвещение через призму искусства»</span>, участник направления <span class="text-primary">«Межвузовский экологический клуб»</span>, участник направления <span class="text-primary">«Экспертный круг»</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-4 px-md-5">
                            <h5 class="text-primary fw-bold">Статистика</h5>
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-4 d-flex flex-column mt-2 text-center">
                                            <span>Публикации</span>
                                            <span class="fs-1 fw-bold">15</span>
                                        </div>
                                        <div class="col-md-8">
                                            <ul class="stats-list">
                                                <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">SCOPUS/WoS:</a><span class="fw-bold">4</span></li>
                                                <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">ВАК:</a><span class="fw-bold">6</span></li>
                                                <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">РИНЦ:</a><span class="fw-bold">5</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-4 d-flex flex-column align-items-center text-center mt-3 mt-md-0">
                                            <span>Конференции и конкурсы</span>
                                            <span class="fs-1 fw-bold">3</span>
                                        </div>
                                        <div class="col-md-8"><ul class="stats-list">
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Международные:</a><span class="fw-bold">4</span></li>
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Всероссийские:</a><span class="fw-bold">6</span></li>
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Региональные:</a><span class="fw-bold">5</span></li>
                                        </ul></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-4 px-md-5">
                            <h5 class="text-primary fw-bold">Последние публикации</h5>
                            <div class="row blog-posts">
                                <div class="col-lg-6 blog-post mt-4">
                                    <div class="blog-post-image w-100 mb-3">
                                        <img src="./assets/img/blog-post-image.png" alt="blog-post-image">
                                    </div>
                                    <small class="blog-post-info text-muted">Мероприятие &#8226; 07.03.2022</small>
                                    <h6 class="blog-post-title mt-3">Презентация проекта «Твой ход»</h6>
                                    <p class="blog-post-preview-text mt-3">Мы рассказали о своём опыте участия в проекте и представили все возможности нового сезона. Больше дела, меньше слов. Время сделать твой ход!</p>
                                    <a href="#" class="text-primary blog-post-link">Читать пост <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                </div>
                                <div class="col-lg-6 blog-post mt-4">
                                    <div class="blog-post-image w-100 mb-3">
                                        <img src="./assets/img/blog-post-image-2.png" alt="blog-post-image">
                                    </div>
                                    <small class="blog-post-info text-muted">Мероприятие &#8226; 07.03.2022</small>
                                    <h6 class="blog-post-title mt-3">Презентация проекта «Твой ход»</h6>
                                    <p class="blog-post-preview-text mt-3">Мы рассказали о своём опыте участия в проекте и представили все возможности нового сезона. Больше дела, меньше слов. Время сделать твой ход!</p>
                                    <a href="#" class="text-primary blog-post-link">Читать пост <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                </div>
                                <div class="col-lg-6 blog-post mt-4">
                                    <div class="blog-post-image w-100 mb-3">
                                        <img src="./assets/img/test.jpg" alt="blog-post-image">
                                    </div>
                                    <small class="blog-post-info text-muted">Мероприятие &#8226; 07.03.2022</small>
                                    <h6 class="blog-post-title mt-3">Презентация проекта «Твой ход»</h6>
                                    <p class="blog-post-preview-text mt-3">Мы рассказали о своём опыте участия в проекте и представили все возможности нового сезона. Больше дела, меньше слов. Время сделать твой ход!</p>
                                    <a href="#" class="text-primary blog-post-link">Читать пост <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                </div>
                                <div class="col-lg-6 blog-post mt-4">
                                    <div class="blog-post-image w-100 mb-3">
                                        <img src="./assets/img/blog-post-image.png" alt="blog-post-image">
                                    </div>
                                    <small class="blog-post-info text-muted">Мероприятие &#8226; 07.03.2022</small>
                                    <h6 class="blog-post-title mt-3">Презентация проекта «Твой ход»</h6>
                                    <p class="blog-post-preview-text mt-3">Мы рассказали о своём опыте участия в проекте и представили все возможности нового сезона. Больше дела, меньше слов. Время сделать твой ход!</p>
                                    <a href="#" class="text-primary blog-post-link">Читать пост <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                </div>
                               
                            </div>
                        </div>
                    </main>
                </div>
                <div class="col-lg-3">
                    <aside class="sidebar">
                        <div class="profile-card bg-white w-100 shadow mt-4 p-4">
                            <h5 class="text-primary fw-bold">Обо мне</h5>
                            <p class="mt-4">
                                <?php echo $user_data['about_text']?>
                            </p>
                        </div>
                        <div class="profile-card bg-white w-100 shadow mt-4 p-4">
                            <h5 class="text-primary fw-bold">Контакты</h5>
                            <ul class="contacts-list">
                                <li class="mt-4"><i class="text-primary fa-solid fa-envelope"></i><span class="ms-3 text-break"><?php echo $user_data['email']?></span></li>
                                <?php if($user_data['telegram']): ?>
                                    <li class="mt-4"><a href="https://t.me/<?php echo $user_data['telegram']?>"><i class="fa-brands fa-telegram" style="color: #2AABEE"></i><span class="ms-3 text-break"><?php echo $user_data['telegram']?></span></a></li>
                                <?php endif ?>
                                <?php if($user_data['phone']): ?>
                                    <li class="mt-4"><i class="text-primary fa-solid fa-phone" ></i><span class="ms-3 text-break"><?php echo $user_data['phone']?></span></li>
                                <?php endif ?>
                                
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
</div>

<?php require_once 'footer.php'?>