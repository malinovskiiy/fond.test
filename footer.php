<footer>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <small class="col-md-6 mb-0 text-muted">© НЕПРАВИТЕЛЬСТВЕННЫЙ ЭКОЛОГИЧЕСКИЙ ФОНД ИМЕНИ В. И. ВЕРНАДСКОГО</small>
            <ul class="nav col-md-6 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Главная</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">О фонде</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Участникам</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Новости</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Контакты</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Архив</a></li>
            </ul>
        </footer>
    </div>
    </footer>

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="/assets/js/main.js"></script>
    
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
        const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))


        function showAlert(text, type){
            $('.keyword-alert').remove();

            var alert = document.createElement("div");
            alert.className = `w-50 alert alert-${type} keyword-alert fixed-top mx-auto mt-5`;
            alert.append(text);
            alert.setAttribute('role', 'alert');
            $('.page-wrapper').append(alert);

            setTimeout(function() {
                $('.keyword-alert').fadeOut();
            }, 1500);
        }

    </script>
</body>
</html>