document.addEventListener('DOMContentLoaded', function() {
    //
    const szerokosc_canvas = 110
    const wysokosc_canvas = 110
    //
    const canvas = document.getElementById("canvas-logo")
    const ctx = canvas.getContext("2d")
    const logo_strony = document.getElementById("logo-strony-png")
    //
    let czy_hover = false
    canvas.addEventListener('mouseenter', () => { czy_hover = true })
    canvas.addEventListener('mouseleave', () => { czy_hover = false })
    //
    let animation_started = false
    let interval = setInterval(() => {
        if(!animation_started) {
            start()
        } else {
            clearInterval(interval)
        }
    }, 10);
    //
    let _image_trzepaczka = new Image()
    let _image_walek = new Image()
    let image_trzepaczka, image_walek
    _image_trzepaczka.src = "../images/logo_trzepaczka.svg"
    _image_walek.src = "../images/logo_walek.svg"
    let images_loaded = false
    //
    _image_trzepaczka.onload = function(){
        image_trzepaczka = this
        //
        _image_walek.onload = function(){
            image_walek = this
            images_loaded = true
            start()
        }
    }
    //
    const skala_obrazka = 0.85
    //
    const dx = -szerokosc_canvas / 2
    const dy = -wysokosc_canvas / 2
    const dWidth = szerokosc_canvas
    const dHeight = wysokosc_canvas
    //
    let sx = 0
    let sy = 0
    const sWidth = 1000
    const sHeight = 1000
    //
    //
    function rotateImage(image, angle, ifClear) {
        if(ifClear) ctx.clearRect(-szerokosc_canvas, -wysokosc_canvas, szerokosc_canvas*2 + szerokosc_canvas*skala_obrazka, wysokosc_canvas*2 + wysokosc_canvas*skala_obrazka)
        ctx.translate(szerokosc_canvas / 2, wysokosc_canvas / 2)
        //
        ctx.rotate(angle * Math.PI / 180)
        ctx.drawImage(image, sx, sy, sWidth, sHeight, dx, dy, dWidth, dHeight)
        //
        ctx.rotate(-angle * Math.PI / 180)
        ctx.translate(-szerokosc_canvas / 2, -wysokosc_canvas / 2)
    }
    //
    function drawImages() {
        sx = -67; sy = -54
        rotateImage(image_walek, angle, true)
        sx = 0; sy = 0
        rotateImage(image_trzepaczka, -angle, false)
    }
    //
    let angle = 0
    function start() {
        if(animation_started || !images_loaded) return
        animation_started = true
        //
        if(logo_strony) {
            logo_strony.remove()
        }
        canvas.style = "display: block;"
        //
        ctx.translate((szerokosc_canvas - szerokosc_canvas*skala_obrazka) / 2, (wysokosc_canvas - wysokosc_canvas*skala_obrazka) / 2)
        ctx.scale(skala_obrazka, skala_obrazka)
        //
        drawImages()
        //
        setInterval(function() {
            if(czy_hover) {
                if(angle <= 360) {
                    angle += 1.5
                    drawImages()
                }
            } else {
                if(angle > 0) {
                    angle -= 1.5
                    drawImages()
                }
            }
            //
        }, 2)
    }
})