document.addEventListener('DOMContentLoaded', function() {
        const gallery_przycisk_lewo = document.getElementById("button-gallery-lewo")
        const gallery_przycisk_prawo = document.getElementById("button-gallery-prawo")
        const gallery_zdjecie = document.getElementById("gallery-zdjecie")
        //
        let index = 0;
        if(!images || images.length == 0) {
            images = ["../images/dummy.png"]
        }
        function show_image() {
            gallery_zdjecie.src = images[index]
        }
        //
        gallery_przycisk_prawo.addEventListener('click', () => {
            index++
            if(index >= images.length) index = 0
            //
            show_image()
        })
        //
        gallery_przycisk_lewo.addEventListener('click', () => {
            index--
            if(index < 0) index = images.length-1
            //
            show_image()
        })
        //
        show_image()
})