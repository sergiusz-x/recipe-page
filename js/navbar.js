document.addEventListener('DOMContentLoaded', function() {
    const navbarSearch = document.querySelector('.navbar-search')
    const logoStrony = document.querySelector(".navbar-logo")
    const nazwaStrony = logoStrony.querySelector("p")
    //
    function toogle_class(element, state, class_name) {
        if(state) {
            if(!element.classList.contains(class_name)) {
                element.classList.add(class_name)
            }
        } else {
            if(element.classList.contains(class_name)) {
                element.classList.remove(class_name)
            }
        }
    }
    //
    function resize() {
        if (window.innerWidth > 767) {
            toogle_class(navbarSearch, false, "navbar-search-closed")
        } else {
            toogle_class(navbarSearch, true, "navbar-search-closed")
        }
        //
        if(window.innerWidth < 460) {
            nazwaStrony.innerHTML = ""
        } else {
            nazwaStrony.innerHTML = "PRZEPISY KULINARNE"
        }
    }
    window.addEventListener('resize', () => {
        resize()
    })
    resize()
})