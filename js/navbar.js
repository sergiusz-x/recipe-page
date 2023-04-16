document.addEventListener('DOMContentLoaded', function() {
    // Usuwanie search baru jeśli się już nie mieści
    const navbarSearch = document.querySelector('.navbar-search');
    //
    function toogle_class(element, state, class_name) {
        if(state) {
            if(!element.classList.contains(class_name)) {
                element.classList.add(class_name);
            }
        } else {
            if(element.classList.contains(class_name)) {
                element.classList.remove(class_name);
            }
        }
    }
    //
    window.addEventListener('resize', () => {
        if (window.innerWidth > 767) {
            toogle_class(navbarSearch, false, "navbar-search-closed");
        } else {
            toogle_class(navbarSearch, true, "navbar-search-closed");
        }
    });
    //
});