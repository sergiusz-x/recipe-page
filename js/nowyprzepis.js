document.addEventListener('DOMContentLoaded', function() {
    //
    zwiekszanie_zmniejszanie_licznikow()
    dodawanie_usuwanie_elementow_skladniki_przygotowanie()
    //
})

function dodawanie_usuwanie_elementow_skladniki_przygotowanie() {
    //
    // SKŁADNIKI
    const skladniki_przycisk_dodaj = document.getElementById("skladniki-button-dodaj")
    const skladniki_przycisk_usun = document.getElementById("skladniki-button-usun")
    const skladniki_box_div = document.querySelector(".skladniki-box")
    const skladniki_box_oryginal = document.getElementById("skladniki-box-oryginal")
    //
    // PRZYGOTOWANIE
    const przygotowanie_przycisk_dodaj = document.getElementById("przygotowanie-button-dodaj")
    const przygotowanie_przycisk_usun = document.getElementById("przygotowanie-button-usun")
    const przygotowanie_box_div = document.querySelector(".przygotowanie-box")
    const przygotowanie_box_oryginal = document.getElementById("przygotowanie-box-oryginal")
    //
    //
    skladniki_przycisk_dodaj.addEventListener('click', () => {
        const klon_div = skladniki_box_oryginal.cloneNode(true)
        klon_div.querySelector(".skladnik-nazwa-input").value = ""
        klon_div.querySelector(".skladnik-wielkosc-input").value = ""
        //
        skladniki_box_div.appendChild(klon_div)
        //
        if(skladniki_box_div.children.length > 1) {
            skladniki_przycisk_usun.disabled = false
        }
    })
    skladniki_przycisk_usun.addEventListener('click', () => {
        if(skladniki_box_div.children.length > 1) {
            skladniki_box_div.removeChild(skladniki_box_div.lastChild)
        }
        if(skladniki_box_div.children.length <= 1) {
            skladniki_przycisk_usun.disabled = true
        }
    })
    //
    przygotowanie_przycisk_dodaj.addEventListener('click', () => {
        const klon_div = przygotowanie_box_oryginal.cloneNode(true)
        klon_div.querySelector(".textarea-krok-przygotowania").value = `${przygotowanie_box_div.children.length+1}. `
        //
        przygotowanie_box_div.appendChild(klon_div)
        //
        if(przygotowanie_box_div.children.length > 1) {
            przygotowanie_przycisk_usun.disabled = false
        }
    })
    przygotowanie_przycisk_usun.addEventListener('click', () => {
        if(przygotowanie_box_div.children.length > 1) {
            przygotowanie_box_div.removeChild(przygotowanie_box_div.lastChild)
        }
        if(przygotowanie_box_div.children.length <= 1) {
            przygotowanie_przycisk_usun.disabled = true
        }
    })
    //
}

function zwiekszanie_zmniejszanie_licznikow() {
    //
    // PORCJA NA
    const porcja_wartosc = document.getElementById("porcja-na-wartosc")
    const porcja_przycisk_zwieksz = document.getElementById("porcja-button-zwieksz")
    const porcja_przycisk_zmniejsz = document.getElementById("porcja-button-zmniejsz")
    //
    // CZAS REALIZACJI
    const czasrealizacji_wartosc = document.getElementById("czas-realizacji-wartosc")
    const czasrealizacji_przycisk_zwieksz = document.getElementById("czasrealizacji-button-zwieksz")
    const czasrealizacji_przycisk_zmniejsz = document.getElementById("czasrealizacji-button-zmniejsz")
    //
    function get_txt(innerHTML, plusminus, tekst, minmax) {
        let liczba = Number(innerHTML.split(" ")[0])
        if(isNaN(liczba)) liczba = 1
        liczba += plusminus
        if(liczba < minmax[0]) liczba = minmax[0]
        if(liczba > minmax[1]) liczba = minmax[1]
        //
        let teksty = ["-", "-", "-"]
        if(tekst == "osoby") teksty = ["osobę", "osoby", "osób"]
        if(tekst == "minuty") teksty = ["min", "min", "min"]
        //
        if(liczba <= 1) return `${liczba} ${teksty[0]}`
        if(liczba < 5) return `${liczba} ${teksty[1]}`
        return `${liczba} ${teksty[2]}`
    }
    //
    porcja_przycisk_zwieksz.addEventListener('click', () => {
        porcja_wartosc.innerHTML = get_txt(porcja_wartosc.innerHTML, 1, "osoby", [1, 30])
    });
    porcja_przycisk_zmniejsz.addEventListener('click', () => {
        porcja_wartosc.innerHTML = get_txt(porcja_wartosc.innerHTML, -1, "osoby", [1, 30])
    });
    //
    czasrealizacji_przycisk_zwieksz.addEventListener('click', () => {
        czasrealizacji_wartosc.innerHTML = get_txt(czasrealizacji_wartosc.innerHTML, 5, "minuty", [5, 120])
    });
    czasrealizacji_przycisk_zmniejsz.addEventListener('click', () => {
        czasrealizacji_wartosc.innerHTML = get_txt(czasrealizacji_wartosc.innerHTML, -5, "minuty", [5, 120])
    });
}