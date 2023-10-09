<?php 
require_once "header.php";

if(!isset($_SESSION['user'])){
	header("Location: 404.php");
}

$statistics = $ScientificActivityService->getActivityStatistics($UserData['id'])

?>
    <div class="page-wrapper py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-9">
                    <main class="main">
                        <div class="profile-card bg-white w-100 shadow mt-4 p-4 p-md-5">
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-center">
                                    <div class="profile-main d-flex">
                                        <div class="profile-picture">
                                            <img src="<?php echo $UserData['image']?>" class="rounded-circle" alt="profile-picture">
                                        </div>
                                        <div class="profile-info ms-4">
                                            <div class="profile-name d-flex align-items-center flex-wrap">
                                               <h4 class="fw-bold"><?php echo $UserData['first_name']?> <?php echo $UserData['last_name']?></h4>
                                            </div>
                                            <div class="profile-role">
                                                <h6 class="text-primary fw-bold">
                                                    <?php if($UserData['involvement_level'] == 1):?>
                                                        Член Ассоциации
                                                    <?php else:?>
                                                        Стипендиат
                                                    <?php endif ?>
                                                </h6>
                                            </div>
                                            <div class="profile-contacts d-flex flex-column">
                                                <span class="text-break">@<?php echo $UserData['username']?></span>
                                                
                                                <span class="mt-2"><i class="fa-solid fa-building-columns text-primary"></i> <?php echo $UserData['study_place']?> <i class="mx-2 fa-solid fa-city text-primary"></i><?php echo $UserData['city']?></span>
                                                
                                            </div>
                                            <button class="mt-3 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#full-profile-info">
                                            Подробнее
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 pt-4 pt-lg-0 d-flex flex-column justify-content-between">
                                    <h5 class="text-primary fw-bold">Тематика исследований</h5>
                                    <p class="mt-3">
                                        <?php echo $UserData['research_topic']?>
                                    </p>
                                    <ul class="profile-tags d-flex flex-wrap align-items-start">
                                    <?php if(!empty(json_decode($UserData['keywords']))): ?>
                                        <?php foreach (explode(",", $UserData['keywords']) as $keyword): ?>
                                            <li class="px-3 py-2 me-2 mt-2 btn btn-sm btn-outline-secondary">
                                                <?php echo $KeywordService->getKeywordById(intval(str_replace(['"', "[", "]"], '', $keyword)))[0]['name'];?>
                                            </li>
                                        <?php endforeach?>
                                    <?php else: ?>
                                        Ключевые слова не настроены
                                    <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                           


                            
                        </div>
                        <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-5 px-md-5">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="text-primary fw-bold">Комплексный рейтинг</h5>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="/edit-complex-rating" class="btn btn-sm btn-primary">Редактировать</a>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=scientific_activity" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Оценка активности в публикации научных работ в различных научных журналах (SCOPUS, WoS, ВАК, РИНЦ)</span></div> ">Научная деятельность <small>(<?php echo $ScientificActivityService->calculatePoints($UserData['id']);?>)</small></a>
                                        <div class="progress mt-3">
                                        <?php
                                            $SciencePoints = $ScientificActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displaySciencePoints = $SciencePoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($SciencePoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displaySciencePoints = $SciencePoints % 100;
                                            } elseif ($SciencePoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displaySciencePoints = $SciencePoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displaySciencePoints; ?>%" aria-valuenow="<?php echo $displaySciencePoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=scholarship" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Рассчитывается исходя из количества присудившихся стипендий, премий и медалей за последние 3 года</span></div> ">Стипендиальное поощрение</a> <small>(<?php echo $ScholarshipActivityService->calculatePoints($UserData['id']);?>)</small>
                                        <div class="progress mt-3">
                                        <?php
                                            $ScholarshipPoints = $ScholarshipActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displayScholarshipPoints = $ScholarshipPoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($ScholarshipPoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displayScholarshipPoints = $ScholarshipPoints % 100;
                                            } elseif ($ScholarshipPoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displayScholarshipPoints = $ScholarshipPoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displayScholarshipPoints; ?>%" aria-valuenow="<?php echo $displayScholarshipPoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=olympiad" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Оценка достижений и наград в различных конкурсах и олимпиадах.</span></div> ">Олимпиадная деятельность</a> <small>(<?php echo $OlympiadActivityService->calculatePoints($UserData['id']);?>)</small>
                                        <div class="progress mt-3">
                                        <?php
                                            $OlympiadPoints = $OlympiadActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displayOlympiadPoints = $OlympiadPoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($OlympiadPoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displayOlympiadPoints = $OlympiadPoints % 100;
                                            } elseif ($OlympiadPoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displayOlympiadPoints = $OlympiadPoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displayOlympiadPoints; ?>%" aria-valuenow="<?php echo $displayOlympiadPoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=sports" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Участие в международных, всероссийских и региональных соревнованиях оценивается согласно полученным призовым местам</span></div> ">Спортивная деятельность</a> <small>(<?php echo $SportsActivityService->calculatePoints($UserData['id']);?>)</small>
                                        <div class="progress mt-3">
                                        <?php
                                            $SportsPoints = $SportsActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displaySportsPoints = $SportsPoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($SportsPoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displaySportsPoints = $SportsPoints % 100;
                                            } elseif ($SportsPoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displaySportsPoints = $SportsPoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displaySportsPoints; ?>%" aria-valuenow="<?php echo $displaySportsPoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=social" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>В этом разделе учитывается участие в качестве куратора или участника на мероприятих различного уровня</span></div> "> Общественная деятельность</a> <small>(<?php echo $SocialActivityService->calculatePoints($UserData['id']);?>)</small>
                                        <div class="progress mt-3">
                                        <?php
                                            $SocialPoints = $SocialActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displaySocialPoints = $SocialPoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($SocialPoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displaySocialPoints = $SocialPoints % 100;
                                            } elseif ($SocialPoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displaySocialPoints = $SocialPoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displaySocialPoints; ?>%" aria-valuenow="<?php echo $displaySocialPoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=educational" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Участие в качестве спикера на международных, всероссийских и региональных мероприятиях</span></div> ">Просветительская деятельность</a> <small>(<?php echo $EducationalActivityService->calculatePoints($UserData['id']);?>)</small>
                                        <div class="progress mt-3">
                                        <?php
                                            $EducationalPoints = $EducationalActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displayEducationalPoints = $EducationalPoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($EducationalPoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displayEducationalPoints = $EducationalPoints % 100;
                                            } elseif ($EducationalPoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displayEducationalPoints = $EducationalPoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displayEducationalPoints; ?>%" aria-valuenow="<?php echo $displayEducationalPoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=volunteer" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за последние 3 года</span></div> ">Волонтёрская деятельность</a> <small>(<?php echo $VolunteerActivityService->calculatePoints($UserData['id']);?>)</small>
                                        <div class="progress mt-3">
                                        <?php
                                            $VolunteerPoints = $VolunteerActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displayVolunteerPoints = $VolunteerPoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($VolunteerPoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displayVolunteerPoints = $VolunteerPoints % 100;
                                            } elseif ($VolunteerPoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displayVolunteerPoints = $VolunteerPoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displayVolunteerPoints; ?>%" aria-valuenow="<?php echo $displayVolunteerPoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
    
                                    </div>
                                    <div class="rating-bar mt-4">
                                        <a href="complex-rating?id=<?php echo $_SESSION['user']['id']?>&tab=internship" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в практиках и стажировках за последние 3 года</span></div>">Практики и стажировки</a> <small>(<?php echo $InternshipActivityService->calculatePoints($UserData['id']);?>)</small>
                                        <div class="progress mt-3">
                                        <?php
                                            $InternshipPoints = $InternshipActivityService->calculatePoints($UserData['id']);
                                            
                                            $color = ''; // Переменная для хранения цвета прогресс-бара
                                            $displayInternshipPoints = $InternshipPoints; // Переменная для хранения отображаемых баллов
                                            
                                            
                                            if ($InternshipPoints >= 200) {
                                                $color = 'bg-success'; // Желтый цвет для более чем 200 баллов
                                                $displayInternshipPoints = $InternshipPoints % 100;
                                            } elseif ($InternshipPoints >= 100) {
                                                $color = 'bg-primary'; // Красный цвет для более чем 100 баллов
                                                $displayInternshipPoints = $InternshipPoints % 100; // Остаток от деления на 100
                                            } else {
                                                $color = 'bg-secondary'; // Красный цвет для более чем 100 баллов
                                                
                                            }
                                            
                                            // Вывод прогресс-бара с учетом цвета и отображаемых баллов
                                            ?>
                                            <div class="progress-bar <?php echo $color; ?>" role="progressbar" aria-label="Basic example" style="width: <?php echo $displayInternshipPoints; ?>%" aria-valuenow="<?php echo $displayInternshipPoints; ?>" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <h5 class="text-primary fw-bold">Статистика </h5>
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-4 d-flex flex-column mt-2 text-center">
                                            <span>Публикации</span>
                                            <span class="fs-1 fw-bold"><?php echo $statistics['total_publications']?></span>
                                        </div>
                                        <div class="col-md-8">
                                            <ul class="stats-list">
                                                <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">SCOPUS/WoS:</a><span class="fw-bold"><?php echo $statistics['scopus_publications']?></span></li>
                                                <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">ВАК:</a><span class="fw-bold"><?php echo $statistics['vak_publications']?></span></li>
                                                <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">РИНЦ:</a><span class="fw-bold"><?php echo $statistics['rinc_publications']?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-4 d-flex flex-column align-items-center text-center mt-3 mt-md-0">
                                            <span>Конференции и конкурсы</span>
                                            <span class="fs-1 fw-bold"><?php echo $statistics['total_conferences']?></span>
                                        </div>
                                        <div class="col-md-8"><ul class="stats-list">
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Международные:</a><span class="fw-bold"><?php echo $statistics['international_conferences']?></span></li>
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Всероссийские:</a><span class="fw-bold"><?php echo $statistics['russian_conferences'] ?></span></li>
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Региональные:</a><span class="fw-bold"><?php echo $statistics['regional_conferences']?></span></li>
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
                                <?php echo $UserData['about_text']?>
                            </p>
                        </div>
                        <div class="profile-card bg-white w-100 shadow mt-4 p-4">
                            <h5 class="text-primary fw-bold">Контакты</h5>
                            <ul class="contacts-list">
                                <li class="mt-4"><small><i class="text-primary fa-solid fa-envelope"></i><span class="ms-3 text-break"><?php echo $UserData['email']?></span></small></li>
                                <?php if($UserData['telegram']): ?>
                                    <li class="mt-4"><small><a href="https://t.me/<?php echo $UserData['telegram']?>"><i class="fa-brands fa-telegram" style="color: #2AABEE"></i><span class="ms-3 text-break"><?php echo $UserData['telegram']?></span></a></small></li>
                                <?php endif ?>
                                <?php if($UserData['phone']): ?>
                                    <li class="mt-4"><small><i class="text-primary fa-solid fa-phone" ></i><span class="ms-3 text-break"><?php echo $UserData['phone']?></span></small></li>
                                <?php endif ?>
                                
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="full-profile-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-primary" id="exampleModalLabel">Подробная информация</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-lg-5">
                    <div class="full-main-info">
                        <h6 class="text-primary my-4">Основная информация</h6>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small><i class="fa-solid fa-user text-primary me-3"></i><span>Полное ФИО :</span></small>
                            </div>
                            <div class="col-lg-8">
                            <small><?php echo $UserData['last_name']?> <?php echo $UserData['first_name'] ?> <?php echo $UserData['patronymic'] ?? '' ?>
                                </small>
                            </div>
                        </div>   
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small><i class="fa-solid fa-calendar-days text-primary me-3"></i><span>Дата рождения :</span></small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo $UserData['date_of_birth'] ? date("d.m.Y", strtotime($UserData['date_of_birth'])) : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small><i class="fa-solid fa-list-check text-primary me-3"></i><span>Доп. умения и навыки:</span></small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo $UserData['extra_skills'] ? $UserData['extra_skills'] : 'Не указано'?></small> 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="full-study-info">
                        <h6 class="text-primary my-4">Образование</h6>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Вуз:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['study_place']) ? $UserData['study_place'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Город:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['study_city']) ? $UserData['study_city'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Уровень обучения:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small>
                                    <?php 
                                        switch($UserData['study_level']){
                                            case "1":
                                                echo 'Студент';
                                                break;
                                            case "2":
                                                echo 'Магистрант';
                                                break;
                                            case "3":
                                                echo 'Аспирант';
                                                break;
                                            case "4":
                                                echo 'Докторант';
                                                break;
                                            default: 
                                                echo 'Не указано';
                                        }
                                    ?>
                                </small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Курс (текущий уровень обучения):</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo $UserData['study_year'] > 0 ? $UserData['study_year'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Институт/школа:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['study_institution']) ? $UserData['study_institution'] : 'Не указано'?></small> 
                        </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Направление:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['study_direction']) ? $UserData['study_direction'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Средний балл зачётки:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['study_average_grade']) ? $UserData['study_average_grade'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Иностранный язык и уровень владения:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['study_languages']) ? $UserData['study_languages'] : 'Не указано'?></small> 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="full-science-info">
                        <h6 class="text-primary my-4">Научная деятельность</h6>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Ученая степень:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['science_degree']) ? $UserData['science_degree'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Тема НИР:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['science_work_topic']) ? $UserData['science_work_topic'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Одно главное достижение в научной и/или учебной деятельности:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small>
                                <div class="col-lg-8">
                                <?php echo !empty($UserData['science_main_achievement']) ? $UserData['science_main_achievement'] : 'Не указано'?> 
                            </div>
                                </small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Членство в научных сообществах:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo $UserData['science_societies'] > 0 ? $UserData['science_societies'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Членство в иных сообществах:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['science_other_societies']) ? $UserData['science_other_societies'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>“Я - эксперт”<br>(названия конкурсов и проектов):</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['science_ya_expert']) ? $UserData['science_ya_expert'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>“Я - амбассадор”<br>(названия конкурсов и проектов):</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($UserData['science_ya_ambassador']) ? $UserData['science_ya_ambassador'] : 'Не указано'?></small> 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="full-work-info">
                        <h6 class="text-primary my-4">Трудовая деятельность</h6>
                        <?php if(!empty(json_decode($UserData['work_places']))): ?>
                            <?php foreach(json_decode($UserData['work_places']) as $item): ?>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <small>Место работы: </small> 
                                    </div>  
                                    <div class="col-lg-8">
                                        <small><?php echo $item->name;?></small> 
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-4">
                                        <small>Должность:</small> 
                                    </div>  
                                    <div class="col-lg-8">
                                        <small><?php echo $item->position;?></small> 
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else: ?>
                           <small>Нет информации</small>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once "footer.php"?>