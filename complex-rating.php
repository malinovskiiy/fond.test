<?php 
require "header.php";

// Problem fixed with non existing account views by condidtion $User->getUserById($_GET['id'])
if(isset($_GET['id']) && is_numeric($_GET['id']) && $UserService->getUserById($_GET['id'])){
    $user_data = $UserService->getUserById($_GET['id'])[0];
} else {
    header('Location: ./404.php');
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
                                        <div class="tab-pane fade show active" id="v-pills-science-activity" role="tabpanel" aria-labelledby="v-pills-science-activity-tab">
                                            
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Научная деятельность пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                            <?php if(!empty($ScientificActivityService->getAll($user_data['id']))):?>
                                                <div class="row blog-posts">
                                                <?php foreach($ScientificActivityService->getAll($user_data['id']) as $activity):?>
                                                    <div class="col-lg-6 blog-post mt-4">
                                                        
                                                        <div class="blog-post-image w-100 mb-3">
                                                            <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                        </div>
                                                            
                                                        <small class="blog-post-info text-muted"><?php echo $ScientificActivityService->generateActivityString($activity['activity_category'], $activity['activity_type'], $activity['activity_subtype'], $activity['year'])?></small>
                                                        <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                                        <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                                        <?php if(!empty($activity['link'])): ?>
                                                            <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link me-3">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                                        <?php endif ?>
                                                        <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                        
                                                                
                                                                <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=scientific_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger">Удалить</a>
                                                                <a href="update-scientific-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                            
                                                            
                                                        <?php endif ?>
                                                    </div>
                                                    <?php endforeach;?>
                                                </div>  
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="science-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <button class="page-link" tabindex="-1" aria-disabled="true">Previous</button>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <button class="page-link" >Next</button>
                                                        </li>
                                                    </ul>
                                                </nav>    
                                            <?php else: ?>
                                                Нет данных
                                            <?php endif ?>
                                        </div>
                                        <div class="tab-pane fade " id="v-pills-scholarship" role="tabpanel" aria-labelledby="v-pills-scholarship-tab">
                                            <!-- Update study info form -->
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Стипендиальные поощрения/премии пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                            <?php if(!empty($ScholarshipActivityService->getAll($user_data['id']))):?>

                                                <div class="row blog-posts">
                                                    <?php foreach($ScholarshipActivityService->getAll($user_data['id']) as $activity):?>
                                                        <div class="col-lg-6 blog-post mt-4">
                                                            <div class="blog-post-image w-100 mb-3">
                                                                <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                            </div>
                                                            <small class="blog-post-info text-muted"><?php echo $ScholarshipActivityService->generateActivityString($activity['activity_category'],'', '', $activity['year'])?></small>
                                                            <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                                            <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                                            <?php if(!empty($activity['link'])): ?>
                                                                <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link me-3">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                                            <?php endif ?>                                                            
                                                            <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                                    <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=scholarship_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger">Удалить</a>
                                                                    <a href="update-scholarship-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endforeach;?>
                                                </div>    
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="scholarship-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <a class="page-link" href="#"></a>
                                                        </li>
                                                    </ul>
                                                </nav> 
                                            <?php else: ?>
                                                Нет данных
                                            <?php endif ?>  
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-olympiad" role="tabpanel" aria-labelledby="v-pills-olympiad-tab">
                                            
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Олимпиадная деятельность пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                            <?php if(!empty($OlympiadActivityService->getAll($user_data['id']))):?>
                                                <div class="row blog-posts">
                                                <?php foreach($OlympiadActivityService->getAll($user_data['id']) as $activity):?>
                                                        <div class="col-lg-6 blog-post mt-4">
                                                            
                                                        <div class="blog-post-image w-100 mb-3">
                                                            <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                        </div>

                                                            <small class="blog-post-info text-muted"><?php echo $OlympiadActivityService->generateActivityString($activity['activity_category'], '', '', $activity['year'])?></small>

                                                            <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>

                                                            <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>

                                                            <?php if(!empty($activity['link'])): ?>
                                                                <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link me-3">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>

                                                            <?php endif ?>
                                                            <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                                    <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=olympiad_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger">Удалить</a>
                                                                    <a href="update-olympiad-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                            <?php endif ?>
                                                        </div>
                                                <?php endforeach;?>
                                                </div>
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="olympiad-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <a class="page-link" href="#"></a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            <?php else: ?>
                                                Нет данных
                                            <?php endif ?>  
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-sports" role="tabpanel" aria-labelledby="v-pills-sports-tab">
                                           
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Спортивная деятельность пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                            <?php if(!empty($SportsActivityService->getAll($user_data['id']))):?>
                                                <div class="row blog-posts">
                                                <?php foreach($SportsActivityService->getAll($user_data['id']) as $activity):?>
                                                        <div class="col-lg-6 blog-post mt-4">
                                                            <div class="blog-post-image w-100 mb-3">
                                                                <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                            </div>
                                                            <small class="blog-post-info text-muted"><?php echo $SportsActivityService->generateActivityString($activity['activity_category'], '', '', $activity['year'])?></small>
                                                            <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                                            <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                                            <?php if(!empty($activity['link'])): ?>
                                                                <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link me-3">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>

                                                            <?php endif ?>                                                            
                                                            <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                                    <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=sports_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger">Удалить</a>
                                                                    <a href="update-sports-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                            <?php endif ?>
                                                        </div>
                                                <?php endforeach;?>   
                                                </div>  
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="sports-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <a class="page-link" href="#"></a>
                                                        </li>
                                                    </ul>
                                                </nav>  
                                            <?php else: ?>
                                                Нет данных
                                            <?php endif ?>               
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Общественная деятельность пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                            <?php if(!empty($SocialActivityService->getAll($user_data['id']))):?>
                                                <div class="row blog-posts">
                                                    <?php foreach($SocialActivityService->getAll($user_data['id']) as $activity):?>
                                                            <div class="col-lg-6 blog-post mt-4">
                                                            
                                                                <div class="blog-post-image w-100 mb-3">
                                                                    <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                                </div>
                                                                <small class="blog-post-info text-muted"><?php echo $SocialActivityService->generateActivityString($activity['activity_category'], $activity['activity_type'], '', $activity['year'])?></small>
                                                                <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                                                <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                                                <?php if(!empty($activity['link'])): ?>
                                                                    <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link  me-3">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>

                                                                <?php endif ?>                                                               
                                                                <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                                    <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=social_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger">Удалить</a>
                                                                    <a href="update-social-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                                <?php endif ?>
                                                            </div>
                                                    <?php endforeach;?> 
                                                </div>   
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="social-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <a class="page-link" href="#"></a>
                                                        </li>
                                                    </ul>
                                                </nav> 
                                            <?php else: ?>
                                                Нет данных
                                            <?php endif ?>
                                        </div>   
                                        <div class="tab-pane fade" id="v-pills-educational" role="tabpanel" aria-labelledby="v-pills-educational-tab">
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Просветительская деятельность пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                            <?php if(!empty($EducationalActivityService->getAll($user_data['id']))):?>
                                                <div class="row blog-posts">
                                                    <?php foreach($EducationalActivityService->getAll($user_data['id']) as $activity):?>
                                                            <div class="col-lg-6 blog-post mt-4">
                                                            <div class="blog-post-image w-100 mb-3">
                                                                <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                            </div>
                                                                <small class="blog-post-info text-muted"><?php echo $EducationalActivityService->generateActivityString($activity['activity_category'], '', '', $activity['year'])?></small>
                                                                <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                                                <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                                                <?php if(!empty($activity['link'])): ?>
                                                                    <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                                                <?php endif ?>                                                                
                                                                <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                                    <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=educational_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger ms-3">Удалить</a>
                                                                    <a href="update-educational-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                                <?php endif ?>
                                                            </div>
                                                    <?php endforeach;?> 
                                                </div>  
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="educational-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <a class="page-link" href="#"></a>
                                                        </li>
                                                    </ul>
                                                </nav> 
                                            <?php else: ?>
                                                Нет данных
                                            <?php endif ?>
                                        </div>  
                                        <div class="tab-pane fade" id="v-pills-volunteer" role="tabpanel" aria-labelledby="v-pills-volunteer-tab">
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Волонтёрская деятельность пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                            <?php if(!empty($VolunteerActivityService->getAll($user_data['id']))):?>
                                                <div class="row blog-posts">
                                                    <?php foreach($VolunteerActivityService->getAll($user_data['id']) as $activity):?>
                                                            <div class="col-lg-6 blog-post mt-4">
                                                            <div class="blog-post-image w-100 mb-3">
                                                            <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                        </div>
                                                                <small class="blog-post-info text-muted"><?php echo $VolunteerActivityService->generateActivityString($activity['activity_category'], '', '', $activity['year'])?></small>
                                                                <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                                                <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                                                <?php if(!empty($activity['link'])): ?>
                                                                    <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link me-3">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                                                <?php endif ?>                                                                
                                                                <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                                    <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=volunteer_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger">Удалить</a>
                                                                    <a href="update-volunteer-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                                <?php endif ?>
                                                            </div>
                                                    <?php endforeach;?> 
                                                </div> 
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="volunteer-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <a class="page-link" href="#"></a>
                                                        </li>
                                                    </ul>
                                                </nav> 
                                            <?php else: ?>
                                                Нет данных
                                            <?php endif ?>
                                        </div> 
                                        <div class="tab-pane fade" id="v-pills-internship" role="tabpanel" aria-labelledby="v-pills-internship-tab">
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Практики и стажировки пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span>
                                            </div>
                                           
                                            <?php if(!empty($InternshipActivityService->getAll($user_data['id']))): ?>
                                                <div class="row blog-posts">
                                                    <?php foreach($InternshipActivityService->getAll($user_data['id']) as $activity):?>
                                                            <div class="col-lg-6 blog-post mt-4">
                                                                <div class="blog-post-image w-100 mb-3">
                                                                    <img src="<?php echo (!empty($activity['image'])) ? $activity['image'] : '/assets/img/placeholder.jpg'; ?>" alt="blog-post-image">
                                                                </div>
                                                                <small class="blog-post-info text-muted"><?php echo $InternshipActivityService->generateActivityString($activity['activity_category'], '', '', $activity['year'])?></small>
                                                                <h6 class="blog-post-title mt-3"><?php echo $activity['title']?></h6>
                                                                <p class="blog-post-preview-text mt-3"><?php echo $activity['preview_text']?></p>
                                                                <?php if(!empty($activity['link'])): ?>
                                                                    <a href="<?php echo $activity['link'] ?>" class="text-primary blog-post-link me-3">Ссылка <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                                                <?php endif ?>                                                                
                                                                <?php if($user_data['id'] === $_SESSION['user']['id']):?>
                                                                    <a href="rating-controller.php?delete_activity_id=<?php echo $activity['activity_id']?>&delete_activity_table_name=internship_activity&user_id=<?php echo $user_data['id']?>" class="btn btn-sm btn-outline-danger">Удалить</a>
                                                                    <a href="update-internship-activity?id=<?php echo $activity['activity_id']?>" class="btn btn-sm btn-outline-success ms-2">Изменить</a>
                                                                <?php endif ?>
                                                            </div>
                                                    <?php endforeach;?> 
                                                </div>    
                                                <nav>
                                                    <ul class="pagination justify-content-center mt-5" id="internship-pagination">
                                                        <!-- Кнопка "Previous" -->
                                                        <li class="page-item disabled" id="prev-page">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"></a>
                                                        </li>
                                                        <!-- Номера страниц будут добавлены здесь динамически -->
                                                        <!-- Кнопка "Next" -->
                                                        <li class="page-item" id="next-page">
                                                            <a class="page-link" href="#"></a>
                                                        </li>
                                                    </ul>
                                                </nav> 
                                            <?php else :?>
                                                Нет данных
                                            <?php endif ?>
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
                        <h5 class="text-primary fw-bold ps-3">Комплексный рейтинг</h5>
                        <div class="nav flex-column nav-pills mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active text-start" id="v-pills-science-activity-tab" data-bs-toggle="pill" data-bs-target="#v-pills-science-activity" type="button" role="tab" aria-controls="v-pills-science-activity" aria-selected="true">Научная деятельность</button>
                                <button class="nav-link text-start" id="v-pills-scholarship-tab" data-bs-toggle="pill" data-bs-target="#v-pills-scholarship" type="button" role="tab" aria-controls="v-pills-scholarship" aria-selected="false">Стипендиальное поощрение/премии</button>
                                <button class="nav-link text-start" id="v-pills-olympiad-tab" data-bs-toggle="pill" data-bs-target="#v-pills-olympiad" type="button" role="tab" aria-controls="v-pills-olympiad" aria-selected="false">Олимпиадная деятельность</button>
                                <button class="nav-link text-start" id="v-pills-sports-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sports" type="button" role="tab" aria-controls="v-pills-sports" aria-selected="false">Спортивная деятельность</button>
                                <button class="nav-link text-start" id="v-pills-social-tab" data-bs-toggle="pill" data-bs-target="#v-pills-social" type="button" role="tab" aria-controls="v-pills-social" aria-selected="false">Общественная деятельность</button>     
                                <button class="nav-link text-start" id="v-pills-educational-tab" data-bs-toggle="pill" data-bs-target="#v-pills-educational" type="button" role="tab" aria-controls="v-pills-educational" aria-selected="false">Просветительская деятельность</button>     
                                <button class="nav-link text-start" id="v-pills-volunteer-tab" data-bs-toggle="pill" data-bs-target="#v-pills-volunteer" type="button" role="tab" aria-controls="v-pills-volunteer" aria-selected="false">Волонтёрская деятельность</button>   
                                <button class="nav-link text-start" id="v-pills-internship-tab" data-bs-toggle="pill" data-bs-target="#v-pills-internship" type="button" role="tab" aria-controls="v-pills-internship" aria-selected="false">Практики и стажировки</button>     
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

<script>

function initPagination(tab_id, pagination_list_id){
    const blogPosts = document.querySelectorAll(`#${tab_id} .blog-post`); // Получаем все элементы блог-постов
    const itemsPerPage = 4; // Количество блог-постов на одной странице
    let currentPage = 1;

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        blogPosts.forEach((post, index) => {
            if (index >= startIndex && index < endIndex) {
                post.style.display = 'block'; // Показываем блог-посты для текущей страницы
            } else {
                post.style.display = 'none'; // Скрываем блог-посты для других страниц
            }
        });
    }

    function updatePagination() {
        const totalPages = Math.ceil(blogPosts.length / itemsPerPage);
        const paginationContainer = document.getElementById(pagination_list_id) ? document.getElementById(pagination_list_id) : document.createElement('div');
        paginationContainer.innerHTML = ''; // Очищаем контейнер пагинации

        // Кнопка "Previous"
        const prevPageButton = document.createElement('li');
        prevPageButton.classList.add('page-item');
        if (currentPage === 1) {
            prevPageButton.classList.add('disabled');
        }
        const prevPageLink = document.createElement('button');
        prevPageLink.classList.add('page-link');
       
        prevPageLink.innerHTML = '<i class="fa-solid fa-angle-left"></i>';
        prevPageButton.appendChild(prevPageLink);

        // Обработчик клика на кнопке "Previous"
        prevPageLink.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                updatePagination();
            }
        });

        paginationContainer.appendChild(prevPageButton);

        // Номера страниц
        for (let page = 1; page <= totalPages; page++) {
            const pageButton = document.createElement('li');
            pageButton.classList.add('page-item');
            if (page === currentPage) {
                pageButton.classList.add('active');
            }
            const pageLink = document.createElement('button');
            pageLink.classList.add('page-link');
            
            pageLink.innerHTML = page;
            pageButton.appendChild(pageLink);

            // Обработчик клика на номере страницы
            pageLink.addEventListener('click', () => {
                if (page !== currentPage) {
                    currentPage = page;
                    showPage(currentPage);
                    updatePagination();
                }
            });

            paginationContainer.appendChild(pageButton);
        }

        // Кнопка "Next"
        const nextPageButton = document.createElement('li');
        nextPageButton.classList.add('page-item');
        if (currentPage === totalPages) {
            nextPageButton.classList.add('disabled');
        }
        const nextPageLink = document.createElement('button');
        nextPageLink.classList.add('page-link');
        nextPageLink.innerHTML = '<i class="fa-solid fa-angle-right"></i>';
        nextPageButton.appendChild(nextPageLink);

        // Обработчик клика на кнопке "Next"
        nextPageLink.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
                updatePagination();
            }
        });

        paginationContainer.appendChild(nextPageButton);
    }

    // Начальная загрузка первой страницы
    showPage(currentPage);
    updatePagination();
}

</script>

<script>
    initPagination('v-pills-science-activity', 'science-pagination')
    initPagination('v-pills-scholarship', 'scholarship-pagination')
    initPagination('v-pills-olympiad', 'olympiad-pagination')
    initPagination('v-pills-sports', 'sports-pagination')
    initPagination('v-pills-social', 'social-pagination')
    initPagination('v-pills-educational', 'educational-pagination')
    initPagination('v-pills-volunteer', 'volunteer-pagination')
    initPagination('v-pills-internship', 'internship-pagination')
</script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Получите значение параметра "tab" из URL
    const urlParams = new URLSearchParams(window.location.search);
    const selectedTab = urlParams.get('tab');

   // Получите список всех табов
    const tabs = document.querySelectorAll('#v-pills-tab button');

    // Переберите табы и установите активный класс для выбранного таба
    tabs.forEach(tab => {
        const tabId = tab.getAttribute('id');
        const tabName = tabId.replace('v-pills-', '').replace('-tab', ''); // Удалить "v-pills" и "-tab" из атрибута id

        if (tabName === selectedTab) {
            tab.click()
        }

        // Добавьте обработчик клика для каждого таба
        tab.addEventListener('click', function() {
            // Измените значение параметра "tab" в URL
            const newUrlParams = new URLSearchParams(window.location.search);
            newUrlParams.set('tab', tabName);
            window.history.replaceState({}, '', `${window.location.pathname}?${newUrlParams}`);
        });
    });
});

</script>


<?php require "footer.php"?>