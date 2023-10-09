<?php 
require "header.php";

if(!isset($_SESSION['user'])){
	header("Location: 404.php");
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
                                                <span class="text-primary fw-bold fs-5">Добавить научную деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-scientific-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                               <input type="hidden" name="create_scientific_activity" value="true">
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
                                                    <input  type="number" max="9999" min="0" type="text" id="science-year-input" name="science-year-input" class="form-control"  aria-describedby="emailHelp" required>
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="science-title-input" name="science-title-input" class="form-control"  aria-describedby="emailHelp" required>
                                                   
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                
                                                   
                                                   <textarea maxlength="300" id="science-description-input" name="science-description-input" class="form-control"  aria-describedby="emailHelp"></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="science-link-input" name="science-link-input" class="form-control"  aria-describedby="emailHelp">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                
                                                   <div class="col-lg-6">
                                                    <input type="file" id="science-image-input" name="science-image-input" class="form-control"  aria-describedby="emailHelp" value="">

                                                   </div>                
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
                                        <div class="tab-pane fade " id="v-pills-scholarship" role="tabpanel" aria-labelledby="v-pills-scholarship-tab">
                                            <!-- Update study info form -->
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить стипендиальное поощрение/премию</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-scholarship-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                            
                                               <input type="hidden" name="create_scholarship_activity" value="true">
                                               <div class="row scholarship_activity_type">
                                                    <div class="col-lg-6 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип стипендии *</label>
                                                
                                                        <select class="form-select" id="scholarship_type" name="scholarship_type">
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
                                                <input  type="number" max="9999" min="0" type="text" id="scholarship-year-input" name="scholarship-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="scholarship-title-input" name="scholarship-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                
                                                   
                                                   <textarea maxlength="300" id="scholarship-description-input" name="scholarship-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="scholarship-link-input" name="scholarship-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                
                                                   <div class="col-lg-6">
                                                    <input type="file" id="scholarship-image-input" name="scholarship-image-input" class="form-control"  aria-describedby="emailHelp" value="">

                                                   </div>                
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
                                        <div class="tab-pane fade" id="v-pills-olympiad" role="tabpanel" aria-labelledby="v-pills-olympiad-tab">
                                            <!-- Update study info form -->
                                            <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить олимпиадную деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-olympiad-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                                <input type="hidden" name="create_olympiad_activity" value="true">

                                               <div class="row olympiad_activity_type">
                                                    <div class="col-lg-6 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип олимпиады *</label>
                                                
                                                        <select class="form-select" id="olympiad_type" name="olympiad_type">
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
                                                <input  type="number" max="9999" min="0" type="text" id="olympiad-year-input" name="olympiad-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="olympiad-title-input" name="olympiad-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                
                                                   
                                                   <textarea maxlength="300" id="olympiad-description-input" name="olympiad-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="olympiad-link-input" name="olympiad-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                
                                                   <div class="col-lg-6">
                                                    <input type="file" id="olympiad-image-input" name="olympiad-image-input" class="form-control"  aria-describedby="emailHelp" value="">

                                                   </div>                
                                               </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="/dashboard" class="btn btn-outline-primary w-100 mt-3 mt-lg-0w-100 mt-3 mt-lg-0">Вернуться назад</a>
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
                                            <form id="create-sports-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                               
                                               <input type="hidden" name="create_sports_activity" value="true">
                                               <div class="row sports_activity_type">
                                                    <div class="col-lg-6 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип соревнования *</label>
                                                
                                                        <select class="form-select" id="sports_type" name="sports_type">
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
                                                <input  type="number" max="9999" min="0" type="text" id="sports-year-input" name="sports-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">       
                                                   <label class="form-label">Полное название *</label>
                                                   <input type="text" id="sports-title-input" name="sports-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                               </div>
                                               <div class="profile-input mb-3">
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                   <textarea maxlength="300" id="sports-description-input" name="sports-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                   <input type="text" id="sports-link-input" name="sports-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                               </div>
                                               <div class="profile-input mb-5">
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                   <div class="col-lg-6">
                                                    <input type="file" id="sports-image-input" name="sports-image-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   </div>                
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
                                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить общественную деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-social-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">


                                                <input type="hidden" name="create_social_activity" value="true">
                                                <div class="row">
                                                        <div class="col-lg-8 profile-input mb-3">                                       
                                                            <label class="form-label">Выберите тип деятельности *</label>                                        
                                                            <select class="form-select"  id="social_activity_category" name="social_activity_category">
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
                                                <input  type="number" max="9999" min="0" type="text" id="social-year-input" name="social-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="social-title-input" name="social-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                
                                                   
                                                   <textarea maxlength="300" id="social-description-input" name="social-description-input" class="form-control"  aria-describedby="emailHelp" required value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="social-link-input" name="social-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                
                                                   <div class="col-lg-6">
                                                    <input type="file" id="social-image-input" name="social-image-input" class="form-control"  aria-describedby="emailHelp" value="">

                                                   </div>                
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
                                        <div class="tab-pane fade" id="v-pills-educational" role="tabpanel" aria-labelledby="v-pills-educational-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить просветительскую деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-educational-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                            
                                               <input type="hidden" name="create_educational_activity" value="true">
                                               <div class="row educational_activity_type">
                                                    <div class="col-lg-8 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип деятельности*</label>
                                                
                                                        <select class="form-select" id="educational_type" name="educational_type"> 
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
                                                <input  type="number" max="9999" min="0"  id="educational-year-input" name="educational-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">            
                                                   <label class="form-label">Полное название *</label> 
                                                   <input type="text"  id="educational-title-input" name="educational-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                   <textarea maxlength="300" id="educational-description-input" name="educational-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                   <input type="text"  id="educational-link-input" name="educational-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                
                                                   <div class="col-lg-6">
                                                    <input type="file" id="educational-image-input" name="educational-image-input" class="form-control"  aria-describedby="emailHelp" value="">

                                                   </div>                
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
                                        <div class="tab-pane fade" id="v-pills-volunteer" role="tabpanel" aria-labelledby="v-pills-volunteer-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить волонтёрскую деятельность</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-volunteer-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                            <input type="hidden" name="create_volunteer_activity" value="true">
                                               <div class="row volunteer_activity_type">
                                                    <div class="col-lg-10 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип деятельности*</label>
                                                
                                                        <select class="form-select" id="volunteer_type" name="volunteer_type">
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
                                                <input  type="number" max="9999" min="0" id="volunteer-year-input" name="volunteer-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
    
                                                   <input type="text" id="volunteer-title-input" name="volunteer-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>

                                                   <textarea maxlength="300"  id="volunteer-description-input" name="volunteer-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>

                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
       
                                                   <input type="text" id="volunteer-link-input" name="volunteer-link-input" class="form-control"  aria-describedby="emailHelp" value="">

                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                
                                                   <div class="col-lg-6">
                                                    <input type="file" id="volunteer-image-input" name="volunteer-image-input" class="form-control"  aria-describedby="emailHelp" value="">

                                                   </div>                
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
                                        <div class="tab-pane fade" id="v-pills-internship" role="tabpanel" aria-labelledby="v-pills-internship-tab">
                                        <div class="d-flex flex-wrap profile-input mb-3 justify-content-between">
                                                <span class="text-primary fw-bold fs-5">Добавить практики и стажировки</span><p>* - обязательные поля</p>
                                            </div>
                                            <form id="create-internship-activity" method="POST" class="profile-input-group" enctype="multipart/form-data">

                                            <input type="hidden" name="create_internship_activity" value="true">
                                               <div class="row internship_activity_type">
                                                    <div class="col-lg-10 profile-input mb-3">
                                                        
                                                        <label class="form-label">Выберите тип практики или стажировки*</label>
                                                
                                                        <select class="form-select" id="internship_type" name="internship_type">
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
                                                    <input  type="number" max="9999" min="0" id="internship-year-input" name="internship-year-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                </div>
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Полное название *</label>
                                                
                                                   
                                                   <input type="text" id="internship-title-input" name="internship-title-input" class="form-control"  aria-describedby="emailHelp" required value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Краткое описание (не более 300 символов)</label>
                                                
                                                   
                                                   <textarea maxlength="300" id="internship-description-input" name="internship-description-input" class="form-control"  aria-describedby="emailHelp" value="
                                                    "></textarea>
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-3">
                                                   
                                                   <label class="form-label">Ссылка (необязательно)</label>
                                                
                                                   
                                                   <input type="text" id="internship-link-input" name="internship-link-input" class="form-control"  aria-describedby="emailHelp" value="">
                                                   
                                                   
                                           
                                               </div>
                                               <div class="profile-input mb-5">
                                                   
                                                   <label class="form-label">Картинка (необязательно)</label>
                                                
                                                   <div class="col-lg-6">
                                                    <input type="file" id="internship-image-input" name="internship-image-input" class="form-control"  aria-describedby="emailHelp" value="">

                                                   </div>                
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
            <div class="col-lg-3 order-first order-lg-last">
                <aside class="sidebar">
                    <div class="profile-card bg-white w-100 shadow mt-4 p-5">
                        <h5 class="text-primary fw-bold ps-3">Редактирование комплексного рейтинга</h5>
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

    // Обработчик изменения значения поля "Выберите категорию"
    $('#activity_category').on('change', function() {
        // Получить выбранную категорию
        var selectedCategory = $(this).val();

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
                        <option value="scopus">SCOPUS/WoS</option>
                        <option value="vak">ВАК</option>
                        <option value="rinc">РИНЦ</option>
                    </select>
                </div>
                <div class="col-lg-6 publication_rating">
                    <div class="profile-input mb-3">
                    
                    <label class="form-label">Выберите рейтинг публикации SCOPUS/WoS *</label>
                    
                    
                            <select class="form-select" name="publication_rating" id="publication_rating">
                                <option value="q1">Q1 (10 баллов)</option>
                                <option value="q2">Q2 (7 баллов)</option>
                                <option value="q3">Q3 (5 баллов)</option>    
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
                            <option value="patent">Патент</option>
                            <option value="computer_certificate">Свидетельство регистрации программы для ЭВМ</option>
                        </select>
                    </div>
                    <div class="col-lg-5 publication_rating">
                        <div class="profile-input mb-3">
                        
                        <label class="form-label">Выберите тип патента *</label>
                        
                        
                                <select class="form-select" name="publication_rating" id="publication_rating">
                                    <option value="invention">На изобретение (10 баллов)</option>
                                    <option value="model">На полезную модель (5 баллов)</option>
                                    
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
                        <option value="international">Международный</option>
                        <option value="russian">Всероссийский</option>
                        <option value="regional">Региональный</option>
                    </select>
                </div>
                <div class="col-lg-6 publication_rating">
                    <div class="profile-input mb-3">
                    
                    <label class="form-label">Выберите тип участия в гранте *</label>
                    
                    
                            <select class="form-select" name="publication_rating" id="publication_rating">
                                <option value="head">Руководитель</option>
                                <option value="performer">Исполнитель</option>
                                
                            </select>

                    </div>
                </div>`
            );
        } else if (selectedCategory === 'conferences') {
            container.append(
                `<div class="col-lg-6 profile-input mb-3">
                                                        
                    <label class="form-label">Выберите тип конференции или конкурса *</label>
            
                    <select class="form-select" name="publication_type" id="publication_type">
                        <option value="international">Международный (5 баллов)</option>
                        <option value="russian">Всероссийский (3 балла)</option>
                        <option value="regional">Региональный (1 балл)</option>
                    </select>
                </div>`
            );
        }
    });

    $('#activity_category').trigger('change');

    $('#create-scientific-activity').on('submit', function(e) {
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
                
                var json_res = JSON.parse(response) ? JSON.parse(response) : {};

                if(json_res.warning){
                    showAlert(json_res.warning, 'warning');
                } else {
                    showAlert('Данные успешно обновлены', 'success');
                }
                
                
            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<script>
    $('#create-scholarship-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {

                var json_res = JSON.parse(response);

                if(json_res.warning){
                    showAlert(json_res.warning, 'warning');
                } else {
                    showAlert('Данные успешно обновлены', 'success');
                }


            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<script>
    $('#create-olympiad-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {

            var json_res = JSON.parse(response);

            if(json_res.warning){
                showAlert(json_res.warning, 'warning');
            } else {
                showAlert('Данные успешно обновлены', 'success');
            }


            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<script>
    $('#create-sports-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {

                var json_res = JSON.parse(response);

                if(json_res.warning){
                    showAlert(json_res.warning, 'warning');
                } else {
                    showAlert('Данные успешно обновлены', 'success');
                }

            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

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
                        <option value="curator">Куратор направления стипендиальной программы Фонда (5 баллов)</option>
                        <option value="participant">Участник направления стипендиальной программы Фонда (3 балла)</option>
                    </select>
                </div>`
            )
        } else if (selectedCategory === 'not_only_in_fond') {
            container.append(
                ` <div class="col-lg-12 profile-input mb-3">
                                                        
                    <label class="form-label">Тип участия в деятельности *</label>
            
                    <select class="form-select" id="social_activity_type" name="social_activity_type">
                        <option value="international">Организатор Международных и Всероссийских мероприятий (5 баллов)</option>
                        <option value="russian">Организатор Региональных мероприятий (3 балла)</option>
                        <option value="regional">Организатор Университетских мероприятий (1 балл)</option>
                        <option value="management_team">Вхожу в руководящий состав СНО и/или иных сообществ института/ школы или вуза (1 балл)</option>
                   
                    </select>
                </div>`
            );
        } 
    });

    $('#social_activity_category').trigger('change');

   
    $('#create-social-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {

                var json_res = JSON.parse(response);

                if(json_res.warning){
                    showAlert(json_res.warning, 'warning');
                } else {
                    showAlert('Данные успешно обновлены', 'success');
                }


            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<script>
    $('#create-educational-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {
                var json_res = JSON.parse(response);

                if(json_res.warning){
                    showAlert(json_res.warning, 'warning');
                } else {
                    showAlert('Данные успешно обновлены', 'success');
                }
            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<script>
    $('#create-volunteer-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {
                var json_res = JSON.parse(response);

                if(json_res.warning){
                    showAlert(json_res.warning, 'warning');
                } else {
                    showAlert('Данные успешно обновлены', 'success');
                }
            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<script>
    $('#create-internship-activity').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'rating-controller.php',
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(response) {
                var json_res = JSON.parse(response);

                if(json_res.warning){
                    showAlert(json_res.warning, 'warning');
                } else {
                    showAlert('Данные успешно обновлены', 'success');
                }
            },
            error: function(xhr, status, error) {
                // Обработка ошибок (если нужно)
                console.error('Произошла ошибка при выполнении POST-запроса:', error);
            }
        });
    });
</script>

<?php require "footer.php"?>