<?php
require_once "functions.php";

$site_title = $UserService->getUserByName($_GET['username'])[0]['first_name'] . ' ' .$UserService->getUserByName($_GET['username'])[0]['last_name'];

// In this component $user_data REPLACED with $user_data all the same logic

// Problem fixed with non existing account views by condidtion $User->getUserById($_GET['id'])
if(isset($_GET['username'])  && $UserService->getUserByName($_GET['username'])){
    $user_data = $UserService->getUserByName($_GET['username'])[0];
    
    if($_SESSION['user']['id'] === $user_data['id']){
        header('Location: /dashboard.php');
    }
} else {
    header('Location: ./404.php');
}

require_once "header.php";

$statistics = $ScientificActivityService->getActivityStatistics($user_data['id']);
$fond_activities = $SocialActivityService->getActivitiesInFond($user_data['id']);

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
                                        <img src="<?php echo $user_data['image']?>" class="rounded-circle" alt="profile-picture">
                                    </div>
                                    <div class="profile-info ms-4">
                                        <div class="profile-name d-flex align-items-center flex-wrap">
                                            <h4 class="fw-bold"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></h4>
                                        </div>
                                        <div class="profile-role">
                                            <p class="text-primary fw-bold">
                                                <?php if($user_data['involvement_level'] == 1):?>
                                                    Член Ассоциации
                                                <?php else:?>
                                                    Стипендиат
                                                <?php endif ?>
                                            </p>
                                        </div>
                                        <div class="profile-contacts d-flex flex-column">
                                            <span class="text-break">@<?php echo $user_data['username']?></span>
                                            
                                            <span class="mt-3">
                                                <i class="fa-solid fa-building-columns text-primary"></i> <?php echo $user_data['study_place']?>
                                                <?php if(!empty($user_data['city'])):?>
                                                    &nbsp;&#8226; <i class="mx-2 fa-solid text-primary fa-location-dot"></i><?php echo $user_data['city']?><br>
                                                    <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#full-profile-info"><i class="me-2 fa-solid fa-circle-info"></i>Подробнее</a>
                                                <?php else: ?>
                                                    &nbsp;&#8226; <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#full-profile-info"><i class="mx-2 fa-solid fa-circle-info"></i>Подробнее</a>
                                                <?php endif ?>
                                                
                                                
                                            </span>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pt-4 pt-lg-0 d-flex flex-column justify-content-between">
                                <h5 class="text-primary fw-bold">Тематика исследований</h5>
                                <p class="mt-3">
                                    <?php echo $user_data['research_topic'] ?? 'Не заполнено'?>
                                </p>
                                <ul class="profile-tags d-flex flex-wrap align-items-start">
                                <?php if(!empty(json_decode($user_data['keywords']))): ?>
                                    <?php foreach (explode(",", $user_data['keywords']) as $keyword): ?>
                                        <li class="py-1 px-2 me-2 mt-2 btn btn-sm btn-outline-secondary">
                                            <?php echo $KeywordService->getKeywordById(intval(str_replace(['"', "[", "]"], '', $keyword)))[0]['name'];?>
                                        </li>
                                    <?php endforeach?>
                                <?php else: ?>
                                    Ключевые слова не настроены
                                <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-5 px-md-5">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-primary fw-bold">Комплексный рейтинг</h5>
                            </div>
                            <div class="col-lg-6 text-lg-end mt-2 mt-lg-0">
                                <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=scientific_activity" class="btn btn-sm btn-primary me-2">Просмотр</a>

                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="rating-bar mt-4">
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=scientific_activity" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Оценка активности в публикации научных работ в различных научных журналах (SCOPUS, WoS, ВАК, РИНЦ)</span></div> ">Научная деятельность <small>(<?php echo $ScientificActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small></a>
                                    <div class="progress mt-3">
                                    <?php
                                        $SciencePoints = $ScientificActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=scholarship" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Рассчитывается исходя из количества присудившихся стипендий, премий и медалей за последние 3 года</span></div> ">Стипендиальное поощрение</a> <small>(<?php echo $ScholarshipActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small>
                                    <div class="progress mt-3">
                                    <?php
                                        $ScholarshipPoints = $ScholarshipActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=olympiad" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Оценка достижений и наград в различных конкурсах и олимпиадах.</span></div> ">Олимпиадная деятельность</a> <small>(<?php echo $OlympiadActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small>
                                    <div class="progress mt-3">
                                    <?php
                                        $OlympiadPoints = $OlympiadActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=sports" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Участие в международных, всероссийских и региональных соревнованиях оценивается согласно полученным призовым местам</span></div> ">Спортивная деятельность</a> <small>(<?php echo $SportsActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small>
                                    <div class="progress mt-3">
                                    <?php
                                        $SportsPoints = $SportsActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=social" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>В этом разделе учитывается участие в качестве куратора или участника на мероприятих различного уровня</span></div> "> Общественная деятельность</a> <small>(<?php echo $SocialActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small>
                                    <div class="progress mt-3">
                                    <?php
                                        $SocialPoints = $SocialActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=educational" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Участие в качестве спикера на международных, всероссийских и региональных мероприятиях</span></div> ">Просветительская деятельность</a> <small>(<?php echo $EducationalActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small>
                                    <div class="progress mt-3">
                                    <?php
                                        $EducationalPoints = $EducationalActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=volunteer" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в волонтерских мероприятиях за последние 3 года</span></div> ">Волонтёрская деятельность</a> <small>(<?php echo $VolunteerActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small>
                                    <div class="progress mt-3">
                                    <?php
                                        $VolunteerPoints = $VolunteerActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                    <a href="complex-rating?id=<?php echo $user_data['id']?>&tab=internship" class="text-dark" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-html="true" data-bs-placement="right" data-bs-title="<div class='text-start'><h6 class='text-primary'>Критерии оценивания</h6><span>Считается по количеству участий в практиках и стажировках за последние 3 года</span></div>">Практики и стажировки</a> <small>(<?php echo $InternshipActivityService->calculatePoints($user_data['id']) ?? 0;?>)</small>
                                    <div class="progress mt-3">
                                    <?php
                                        $InternshipPoints = $InternshipActivityService->calculatePoints($user_data['id']) ?? 0;
                                        
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
                                <?php 
                                
                                $activityCount = count($fond_activities);
                                if($activityCount !== 0){
                                    foreach($fond_activities as $key => $activity):
                                        $activityType = $activity['activity_type'];
                                        $activityTypeText = ($activityType === "curator") ? "руководитель" : "участник";
                                        
                                        // Добавляем первой букве текста большую букву, если это первый элемент
                                        if ($key == 0) {
                                            $activityTypeText = mb_convert_case($activityTypeText, MB_CASE_TITLE, 'UTF-8');
                                        }

                                        // Выводим текст активности
                                        echo $activityTypeText . " направления <a href='#' class='text-primary'>«" . $activity['title'] . "»</a>";

                                        // Добавляем запятую, если это не последний элемент
                                        if ($key < $activityCount - 1) {
                                            echo ", ";
                                        }
                                    endforeach;
                                } else {
                                    echo 'Нет данных';
                                }
                                
                                ?>

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
                                        <span class="fs-1 fw-bold"><?php echo $statistics['total_publications'] ?? 0?></span>
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="stats-list">
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">SCOPUS/WoS:</a><span class="fw-bold"><?php echo $statistics['scopus_publications'] ?? 0?? 0?></span></li>
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">ВАК:</a><span class="fw-bold"><?php echo $statistics['vak_publications'] ?? 0?></span></li>
                                            <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">РИНЦ:</a><span class="fw-bold"><?php echo $statistics['rinc_publications'] ?? 0?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 d-flex flex-column align-items-center text-center mt-3 mt-md-0">
                                        <span>Конференции и конкурсы</span>
                                        <span class="fs-1 fw-bold"><?php echo $statistics['total_conferences'] ?? 0?></span>
                                    </div>
                                    <div class="col-md-8"><ul class="stats-list">
                                        <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Международные:</a><span class="fw-bold"><?php echo $statistics['international_conferences'] ?? 0?></span></li>
                                        <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Всероссийские:</a><span class="fw-bold"><?php echo $statistics['russian_conferences'] ?? 0?></span></li>
                                        <li class="w-100 d-flex justify-content-between px-4 mt-2"><a href="#" class="text-decoration-none">Региональные:</a><span class="fw-bold"><?php echo $statistics['regional_conferences'] ?? 0?></span></li>
                                    </ul></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-card bg-white w-100 shadow mt-4 px-4 py-4 px-md-5">
                        <h5 class="text-primary fw-bold">Последние публикации</h5>
                        <div class="row blog-posts">
                        <?php

                        if(!empty($ScientificActivityService->getAll($user_data['id']))){
                            $count = 0; // Инициализируем счетчик
                            foreach ($ScientificActivityService->getAll($user_data['id']) as $activity) {
                                if ($count >= 4) {
                                    break; // Если выведено 4 элемента, завершаем цикл
                                }
                                ?>
    
                                <div class="col-lg-6 blog-post mt-4">
                                    <div class="blog-post-image w-100 mb-3">
                                        <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                    </div>
                                    <small class="blog-post-info text-muted"><?php echo $ScientificActivityService->generateActivityString($activity['activity_category'], $activity['activity_type'], $activity['activity_subtype'], $activity['year'])?></small>
                                    <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                    <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                    <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                </div>
    
                                <?php
                                $count++; // Увеличиваем счетчик
                            }
                        } else {
                            echo '<div class="col-lg-6 mt-3"> Нет данных</div>';
                        }

                       
                        ?>
                        </div>
                    </div>
                </main>
            </div>
            <div class="col-lg-3">
                <aside class="sidebar">
                    <div class="profile-card bg-white w-100 shadow mt-4 p-4">
                        <h5 class="text-primary fw-bold">Обо мне</h5>
                        <p class="mt-4">
                            <?php echo $user_data['about_text'] ?? 'Не заполнено'?>
                        </p>
                    </div>
                    <div class="profile-card bg-white w-100 shadow mt-4 p-4">
                        <h5 class="text-primary fw-bold">Контакты</h5>
                        <ul class="contacts-list">
                            <li class="mt-4"><small><i class="text-primary fa-solid fa-envelope"></i><span class="ms-3 text-break"><?php echo $user_data['email']?></span></small></li>
                            <?php if($user_data['telegram']): ?>
                                <li class="mt-4"><small><a href="https://t.me/<?php echo $user_data['telegram']?>"><i class="fa-brands fa-telegram" style="color: #2AABEE"></i><span class="ms-3 text-break"><?php echo $user_data['telegram']?></span></a></small></li>
                            <?php endif ?>
                            <?php if($user_data['phone']): ?>
                                <li class="mt-4"><small><i class="text-primary fa-solid fa-phone" ></i><span class="ms-3 text-break"><?php echo $user_data['phone']?></span></small></li>
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
                            <small><?php echo $user_data['last_name']?> <?php echo $user_data['first_name'] ?> <?php echo $user_data['patronymic'] ?? '' ?>
                                </small>
                            </div>
                        </div>   
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small><i class="fa-solid fa-calendar-days text-primary me-3"></i><span>Дата рождения :</span></small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo $user_data['date_of_birth'] ? date("d.m.Y", strtotime($user_data['date_of_birth'])) : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small><i class="fa-solid fa-list-check text-primary me-3"></i><span>Доп. умения и навыки:</span></small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo $user_data['extra_skills'] ? $user_data['extra_skills'] : 'Не указано'?></small> 
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
                                <small><?php echo !empty($user_data['study_place']) ? $user_data['study_place'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Город:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['study_city']) ? $user_data['study_city'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Уровень обучения:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small>
                                    <?php 
                                        switch($user_data['study_level']){
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
                                <small><?php echo $user_data['study_year'] > 0 ? $user_data['study_year'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Институт/школа:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['study_institution']) ? $user_data['study_institution'] : 'Не указано'?></small> 
                        </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Направление:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['study_direction']) ? $user_data['study_direction'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Средний балл зачётки:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['study_average_grade']) ? $user_data['study_average_grade'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Иностранный язык и уровень владения:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['study_languages']) ? $user_data['study_languages'] : 'Не указано'?></small> 
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
                                <small><?php echo !empty($user_data['science_degree']) ? $user_data['science_degree'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Тема НИР:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['science_work_topic']) ? $user_data['science_work_topic'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Одно главное достижение в научной и/или учебной деятельности:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small>
                                <div class="col-lg-8">
                                <?php echo !empty($user_data['science_main_achievement']) ? $user_data['science_main_achievement'] : 'Не указано'?> 
                            </div>
                                </small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Членство в научных сообществах:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo $user_data['science_societies'] > 0 ? $user_data['science_societies'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>Членство в иных сообществах:</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['science_other_societies']) ? $user_data['science_other_societies'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>“Я - эксперт”<br>(названия конкурсов и проектов):</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['science_ya_expert']) ? $user_data['science_ya_expert'] : 'Не указано'?></small> 
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <small>“Я - амбассадор”<br>(названия конкурсов и проектов):</small> 
                            </div>  
                            <div class="col-lg-8">
                                <small><?php echo !empty($user_data['science_ya_ambassador']) ? $user_data['science_ya_ambassador'] : 'Не указано'?></small> 
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="full-work-info">
                        <h6 class="text-primary my-4">Трудовая деятельность</h6>
                        <?php if(!empty(json_decode($user_data['work_places']))): ?>
                            <?php foreach(json_decode($user_data['work_places']) as $item): ?>
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

<?php require_once 'footer.php'?>