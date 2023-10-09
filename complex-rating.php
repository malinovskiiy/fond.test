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
                                                <span class="text-primary fw-bold fs-5">Научная деятельность пользователя<br><span class="text-dark"><?php echo $user_data['first_name']?> <?php echo $user_data['last_name']?></span></span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-scientific-activity" method="POST" class="profile-input-group">

                                               <div class="row">
                                                    <div class="col-lg-6 profile-input mb-3">                                       
                                                        <label class="form-label">Выберите категорию *</label>                                        
                                                        <select class="form-select" name="activity_category" id="activity_category">
                                                            <option value="publication">Публикация</option>
                                                            <option value="intellectual_property">Интеллектуальная собственность</option>
                                                            <option value="grant_activity">Грантовая деятельность</option>
                                                            <option value="conferences">Конференции и конкурсы НИР</option>
                                                        </select>
                                                    </div>
                                                    
                                               </div>

                                               <div class="row science_activity_type">
                                                    
                                               </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="science-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="science-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание *</label>
                                                
                                                   
                                                   <textarea id="science-description-input" class="form-control"  aria-describedby="emailHelp" required value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="science-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>        
                                        </div>
                                        <div class="tab-pane fade " id="v-pills-scholarship" role="tabpanel" aria-labelledby="v-pills-scholarship-tab">
                                            <!-- Update study info form -->
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить стипендиальное поощрение/премию</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-scholarship-activity" method="POST" class="profile-input-group">

                                            

                                               <div class="row scholarship_activity_type">
                                                    <div class="col-lg-6 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип стипендии *</label>
                                                
                                                        <select class="form-select" id="scholarship_type">
                                                        <option value="international">Международная (10 баллов)</option>
                                                        <option value="russian">Всероссийская / организованная промышленным предприятием (5 баллов)</option>
                                                        <option value="regional">Региональная (3 балла)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="scholarship-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="scholarship-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание</label>
                                                
                                                   
                                                   <textarea id="scholarship-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="scholarship-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>  
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-olympiad" role="tabpanel" aria-labelledby="v-pills-olympiad-tab">
                                            <!-- Update study info form -->
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить олимпиадную деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-olympiad-activity" method="POST" class="profile-input-group">

                                            

                                               <div class="row olympiad_activity_type">
                                                    <div class="col-lg-6 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип олимпиады *</label>
                                                
                                                        <select class="form-select" id="olympiad_type">
                                                        <option value="international">Международная (5 баллов)</option>
                                                        <option value="russian">Всероссийская (3 балла)</option>
                                                        <option value="regional">Региональная (1 балл)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="olympiad-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="olympiad-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание</label>
                                                
                                                   
                                                   <textarea id="olympiad-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="olympiad-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>  
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-sports" role="tabpanel" aria-labelledby="v-pills-sports-tab">
                                            <!-- Update study info form -->
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить спортивную деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-sports-activity" method="POST" class="profile-input-group">

                                            

                                               <div class="row sports_activity_type">
                                                    <div class="col-lg-6 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип соревнования *</label>
                                                
                                                        <select class="form-select" id="sports_type">
                                                        <option value="international">Международные (5 баллов)</option>
                                                        <option value="russian">Всероссийские (3 балла)</option>
                                                        <option value="regional">Региональные (1 балл)</option>
                                                        <option value="gto">Значок ГТО (1 балл)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="sports-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="sports-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание</label>
                                                
                                                   
                                                   <textarea id="sports-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="sports-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>                       
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить общественную деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-social-activity" method="POST" class="profile-input-group">

                                               <div class="row">
                                                    <div class="col-lg-8 profile-input mb-3">                                       
                                                        <label class="form-label">Выберите тип деятельности *</label>                                        
                                                        <select class="form-select"  id="social_activity_category">
                                                            <option value="in_fond">В Фонде</option>
                                                            <option value="not_only_in_fond">В Фонде и не только</option>
                                                         
                                                        </select>
                                                    </div>
                                                    
                                               </div>

                                               <div class="row social_activity_type">
                                                    
                                               </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="social-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="social-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание</label>
                                                
                                                   
                                                   <textarea id="social-description-input" class="form-control"  aria-describedby="emailHelp" required value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="social-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>   







                                            
                                        </div>   
                                        <div class="tab-pane fade" id="v-pills-educational" role="tabpanel" aria-labelledby="v-pills-educational-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить просветительскую деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-educational-activity" method="POST" class="profile-input-group">

                                            

                                               <div class="row educational_activity_type">
                                                    <div class="col-lg-8 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип деятельности*</label>
                                                
                                                        <select class="form-select" id="educational_type">
                                                        <option value="international">Спикер на Международных мероприятиях (5 баллов)</option>
                                                        <option value="russian">Спикер на Всероссийских мероприятиях (3 балла)</option>
                                                        <option value="regional">Спикер на Региональных мероприятиях (1 балл)</option>
                                                      
                                                        </select>
                                                    </div>
                                                </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="educational-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="educational-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание</label>
                                                
                                                   
                                                   <textarea id="educational-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="educational-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>  
                                        </div>  
                                        <div class="tab-pane fade" id="v-pills-volunteer" role="tabpanel" aria-labelledby="v-pills-volunteer-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить волонтёрскую деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-volunteer-activity" method="POST" class="profile-input-group">
                                               <div class="row volunteer_activity_type">
                                                    <div class="col-lg-10 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип деятельности*</label>
                                                
                                                        <select class="form-select" id="volunteer_type">
                                                        <option value="international">Организатор Международных и Всероссийских волонтерских мероприятий (5 баллов)</option>
                                                        <option value="russian">Организатор Региональных волонтерских мероприятий (3 балла)</option>
                                                        <option value="regional">Организатор Университетских волонтерских мероприятий (1 балл)</option>
                                                      
                                                       
                                                        <option value="participant">Участник волонтерских мероприятий (1 балл)</option>
                                                      
                                                        </select>
                                                    </div>
                                                </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="volunteer-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="volunteer-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание</label>
                                                
                                                   
                                                   <textarea id="volunteer-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="volunteer-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
                                                    </div>
                                                </div>
                                                <!-- еуые -->
                                            </form>  
                                        </div> 
                                        <div class="tab-pane fade" id="v-pills-internship" role="tabpanel" aria-labelledby="v-pills-internship-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить практики и стажировки</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-internship-activity" method="POST" class="profile-input-group">
                                               <div class="row internship_activity_type">
                                                    <div class="col-lg-10 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип практики или стажировки*</label>
                                                
                                                        <select class="form-select" id="internship_type">
                                                            <option value="international">Международная  (5 баллов)</option>
                                                            <option value="russian">Всероссийская (3 балла)</option>
                                                            <option value="regional">Региональная (1 балл)</option>
                                                        
                                                      
                                                        </select>
                                                    </div>
                                                </div>
                                               <!-- НЕ ЗНАЧАЩИЕ ПОЛЯ -->
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Год *</label>
                                                
                                                <div class="col-lg-2">
                                                <input type="text" id="internship-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="internship-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание</label>
                                                
                                                   
                                                   <textarea id="internship-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="internship-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary">Вернуться назад</a>
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