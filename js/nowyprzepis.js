document.addEventListener('DOMContentLoaded', function() {
    //
    zwiekszanie_zmniejszanie_licznikow()
    dodawanie_usuwanie_elementow_skladniki_przygotowanie()
    zapisanie_przepisu()
    sprawdzanieCzyEdytujePrzepis()
    //
})

function pobierz_dane_przepisu() {
    let dane = {
        nazwa_przepisu: undefined,
        trudnosc: undefined,
        porcja: undefined,
        czas_realizacji: undefined,
        skladniki: [],
        przygotowanie: [],
        zdjecia: []
    }
    //
    let input_nazwa_przepisu = document.getElementById("nazwa-przepisu")
    if(input_nazwa_przepisu) dane.nazwa_przepisu = input_nazwa_przepisu?.value
    //
    const inputy_trudnosc = document.getElementsByName("trudnosc")
    let wybrana_trudnosc
    for(let i = 0; i < inputy_trudnosc.length; i++) {
        if(inputy_trudnosc[i] && inputy_trudnosc[i].checked) {
            wybrana_trudnosc = i
            break
        }
    }
    dane.trudnosc = wybrana_trudnosc
    //
    let text_porcja_przepisu = document.getElementById("porcja-na-wartosc")
    if(text_porcja_przepisu && text_porcja_przepisu.innerHTML) {
        text_porcja_przepisu = Number(text_porcja_przepisu.innerHTML.split(" ")[0])
        if(!isNaN(text_porcja_przepisu)) dane.porcja = text_porcja_przepisu
    }
    //
    let text_czas_realizacji = document.getElementById("czas-realizacji-wartosc")
    if(text_czas_realizacji && text_czas_realizacji.innerHTML) {
        text_czas_realizacji = Number(text_czas_realizacji.innerHTML.split(" ")[0])
        if(!isNaN(text_czas_realizacji)) dane.czas_realizacji = text_czas_realizacji
    }
    //
    const skladniki_all_div = document.querySelectorAll(".skladnik")
    for(const skladnik_div of skladniki_all_div) {
        const nazwa = skladnik_div.querySelector(".skladnik-nazwa-input")?.value
        const wielkosc = skladnik_div.querySelector(".skladnik-wielkosc-input")?.value
        const typ_wielkosci = skladnik_div.querySelector(".skladnik-typ-wielkosci-select")?.value
        //
        if(nazwa && wielkosc && typ_wielkosci) {
            if(!isNaN(Number(wielkosc))) {
                dane.skladniki.push({
                    nazwa: nazwa,
                    wielkosc: Number(wielkosc),
                    typ_wielkosci: typ_wielkosci
                })
            } else {
                return alert("Wielkość jednego z składników nie jest liczbą!")
            }
        }
    }
    //
    const przygotowanie_all_div = document.querySelectorAll(".krok-przygotowania")
    for(const przygotowanie_div of przygotowanie_all_div) {
        const tresc = przygotowanie_div.querySelector(".textarea-krok-przygotowania")?.value
        //
        if(tresc) {
            dane.przygotowanie.push(tresc)
        }
    }
    //
    const podgladZdjecia = document.querySelector('.podglad-zdjecia')
    const zdjecia = podgladZdjecia.querySelectorAll('.src-dodane-zdjecie')
    for (const img of zdjecia) {
        const src = img.getAttribute('src')
        dane.zdjecia.push(src)
    }
    //
    return dane
}

function zapisanie_przepisu() {
    const skladniki_przycisk_dodaj = document.getElementById("dodaj-przepis-button")
    //
    skladniki_przycisk_dodaj.addEventListener('click', () => {
        const dane_przepisu = pobierz_dane_przepisu()
        //
        if(!dane_przepisu.nazwa_przepisu || dane_przepisu.nazwa_przepisu.length == 0) {
            return alert("Uzupełnij nazwę przepisu!")
        } else if(dane_przepisu.nazwa_przepisu.length > 50) {
            return alert("Nazwa przepisu jest zbyt długa!")
        }
        //
        if((!dane_przepisu.trudnosc && dane_przepisu.trudnosc !== 0) || isNaN(dane_przepisu.trudnosc)) {
            return alert("Uzupełnij trudność przepisu!")
        }
        if(!dane_przepisu.porcja || isNaN(dane_przepisu.porcja)) {
            return alert("Uzupełnij porcję przepisu!")
        }
        if(!dane_przepisu.czas_realizacji || isNaN(dane_przepisu.czas_realizacji)) {
            return alert("Uzupełnij czas realizacji przepisu!")
        }
        //
        if(!dane_przepisu.skladniki || dane_przepisu.skladniki.length == 0) {
            return alert("Uzupełnij składniki przepisu!")
        } else {
            let ifReturn = false
            dane_przepisu.skladniki.forEach(skladnik => {
                if(skladnik.nazwa.length > 40) {
                    ifReturn = true
                    return alert("Nazwa jednego z składników jest zbyt długa!")  
                }
            })
            if(ifReturn) return
        }
        //
        if(!dane_przepisu.przygotowanie || dane_przepisu.przygotowanie.length == 0 || dane_przepisu.przygotowanie[0] == "1. ") {
            return alert("Uzupełnij etapy przygotowania przepisu!")
        } else {
            let ifReturn = false
            dane_przepisu.przygotowanie.forEach(przygotowanie => {
                if(przygotowanie.length > 1000) {
                    ifReturn = true
                    return alert("Jeden z kroków przygotowania jest zbyt długi!")  
                }
            })
            if(ifReturn) return
        }
        //
        if(!dane_przepisu.zdjecia || dane_przepisu.zdjecia.length == 0) {
            return alert("Uzupełnij zdjęcia przepisu!")
        }
        //
        if(skladniki_przycisk_dodaj.classList[1] && skladniki_przycisk_dodaj.classList[1].startsWith("idprzepisu-"))
        dane_przepisu.id_przepisu = Number(skladniki_przycisk_dodaj.classList[1].split("-")[1])
        //
        fetch("../php/zapisz_przepis.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dane_przepisu)
        }).then(response => {
            if (response.ok) {
                return response.text()
            } else {
                throw new Error('Błąd sieci!')
            }
        }).then(text => {
            if(text.startsWith("Błąd dodawania przepisu") || isNaN(Number(text))) {
                alert(text)
                window.location.href = `${window.location.pathname}/../konto.php`
            } else {
                window.location.href = `${window.location.pathname}/../przepis.php?id=${text}`
            }
        }).catch(error => {
            console.error(error)
        })
    })
}


function dodaj_usun_skladniki(dodaj) {
    const skladniki_przycisk_usun = document.getElementById("skladniki-button-usun")
    const skladniki_box_div = document.querySelector(".skladniki-box")
    const skladniki_box_oryginal = document.getElementById("skladniki-box-oryginal")
    //
    if(dodaj) {
        const klon_div = skladniki_box_oryginal.cloneNode(true)
        klon_div.querySelector(".skladnik-nazwa-input").value = ""
        klon_div.querySelector(".skladnik-wielkosc-input").value = ""
        //
        skladniki_box_div.appendChild(klon_div)
        //
        if(skladniki_box_div.children.length > 1) {
            skladniki_przycisk_usun.disabled = false
        }
    } else {
        if(skladniki_box_div.children.length > 1) {
            skladniki_box_div.removeChild(skladniki_box_div.lastChild)
        }
        if(skladniki_box_div.children.length <= 1) {
            skladniki_przycisk_usun.disabled = true
        }
    }
}
function dodaj_usun_przygotowanie(dodaj) {
    const przygotowanie_przycisk_usun = document.getElementById("przygotowanie-button-usun")
    const przygotowanie_box_div = document.querySelector(".przygotowanie-box")
    const przygotowanie_box_oryginal = document.getElementById("przygotowanie-box-oryginal")
    //
    if(dodaj) {
        const klon_div = przygotowanie_box_oryginal.cloneNode(true)
        klon_div.querySelector(".textarea-krok-przygotowania").value = ""
        //
        przygotowanie_box_div.appendChild(klon_div)
        //
        if(przygotowanie_box_div.children.length > 1) {
            przygotowanie_przycisk_usun.disabled = false
        }
    } else {
        if(przygotowanie_box_div.children.length > 1) {
            przygotowanie_box_div.removeChild(przygotowanie_box_div.lastChild)
        }
        if(przygotowanie_box_div.children.length <= 1) {
            przygotowanie_przycisk_usun.disabled = true
        }
    }
}
function dodawanie_usuwanie_elementow_skladniki_przygotowanie() {
    //
    // SKŁADNIKI
    const skladniki_przycisk_dodaj = document.getElementById("skladniki-button-dodaj")
    const skladniki_przycisk_usun = document.getElementById("skladniki-button-usun")
    //
    // PRZYGOTOWANIE
    const przygotowanie_przycisk_dodaj = document.getElementById("przygotowanie-button-dodaj")
    const przygotowanie_przycisk_usun = document.getElementById("przygotowanie-button-usun")
    //
    skladniki_przycisk_dodaj.addEventListener('click', () => {
        dodaj_usun_skladniki(true)
    })
    skladniki_przycisk_usun.addEventListener('click', () => {
        dodaj_usun_skladniki(false)
    })
    //
    przygotowanie_przycisk_dodaj.addEventListener('click', () => {
        dodaj_usun_przygotowanie(true)
    })
    przygotowanie_przycisk_usun.addEventListener('click', () => {
        dodaj_usun_przygotowanie(false)
    })
    //
}

function get_txt(innerHTML, plusminus, tekst, minmax, liczbaZGory) {
    let liczba = Number(innerHTML.split(" ")[0])
    if(isNaN(liczba)) liczba = 1
    liczba += plusminus
    if(liczbaZGory) liczba = liczbaZGory
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
    //
    porcja_przycisk_zwieksz.addEventListener('click', () => {
        porcja_wartosc.innerHTML = get_txt(porcja_wartosc.innerHTML, 1, "osoby", [1, 30])
    })
    porcja_przycisk_zmniejsz.addEventListener('click', () => {
        porcja_wartosc.innerHTML = get_txt(porcja_wartosc.innerHTML, -1, "osoby", [1, 30])
    })
    //
    czasrealizacji_przycisk_zwieksz.addEventListener('click', () => {
        czasrealizacji_wartosc.innerHTML = get_txt(czasrealizacji_wartosc.innerHTML, 5, "minuty", [5, 120])
    })
    czasrealizacji_przycisk_zmniejsz.addEventListener('click', () => {
        czasrealizacji_wartosc.innerHTML = get_txt(czasrealizacji_wartosc.innerHTML, -5, "minuty", [5, 120])
    })
}

function wybierzZdjecia() {
    const input = document.createElement("input")
    input.type = "file"
    input.multiple = true
    input.accept = "image/jpeg, image/png"
    input.addEventListener("change", wyswietlPodgladZdjec)
    input.click()
}

function wyswietlPodgladZdjec() {
    const podglad = document.querySelector(".podglad-zdjecia")
    podglad.innerHTML = ""

    const pliki = Array.from(this.files)

    if (pliki.length > 5) {
        alert("Można wybrać maksymalnie 5 plików!")
        return
    }

    pliki.forEach((plik) => {
        const reader = new FileReader()
        reader.onload = function () {
            const miniatura = document.createElement("img")
            miniatura.src = this.result
            miniatura.classList.add("src-dodane-zdjecie")
            podglad.appendChild(miniatura)
        }
        reader.readAsDataURL(plik)
    })
}

function sprawdzanieCzyEdytujePrzepis() {
    const params = new URLSearchParams(window.location.search)
    const przepisId = params.get('id_przepisu')
    if(!przepisId) return
    const dane_przepisu = { id: przepisId }
    //
    fetch("../php/pobierz_dane_przepisu.php", {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dane_przepisu)
    }).then(response => {
        if (response.ok) {
            return response.text()
        } else {
            throw new Error('Błąd sieci!')
        }
    }).then(json => {
        if(!json || json.length == 0) return
        json = JSON.parse(json)
        json.skladniki = JSON.parse(json.skladniki)
        json.przygotowanie = JSON.parse(json.przygotowanie)
        json.zdjecia = JSON.parse(json.zdjecia)
        console.log(json)
        //
        //
        // Nazwa
        let input_nazwa_przepisu = document.getElementById("nazwa-przepisu")
        input_nazwa_przepisu.value = json.nazwa
        //
        // Trudność
        const inputy_trudnosc = document.getElementsByName("trudnosc")
        inputy_trudnosc[Number(json.trudnosc)].checked = true
        //
        // Porcja
        let text_porcja_przepisu = document.getElementById("porcja-na-wartosc")
        text_porcja_przepisu.innerHTML = get_txt(text_porcja_przepisu.innerHTML, 1, "osoby", [1, 30], Number(json.porcja))
        //
        // Czas realizacji
        let text_czas_realizacji = document.getElementById("czas-realizacji-wartosc")
        text_czas_realizacji.innerHTML = get_txt(text_czas_realizacji.innerHTML, 5, "minuty", [5, 120], Number(json.czas_realizacji))
        //
        // Składniki
        let skladniki_all_div = document.querySelectorAll(".skladnik")
        for(i = 0; i < json.skladniki.length; i++) {
            if(!skladniki_all_div[i]) dodaj_usun_skladniki(true)
        }
        skladniki_all_div = document.querySelectorAll(".skladnik")
        for(i = 0; i < json.skladniki.length; i++) {
            const skladnik_div = skladniki_all_div[i]
            const nazwa = skladnik_div.querySelector(".skladnik-nazwa-input")
            const wielkosc = skladnik_div.querySelector(".skladnik-wielkosc-input")
            const typ_wielkosci = skladnik_div.querySelector(".skladnik-typ-wielkosci-select")
            //
            nazwa.value = json.skladniki[i].nazwa
            wielkosc.value = json.skladniki[i].wielkosc
            typ_wielkosci.value = json.skladniki[i].typ_wielkosci
        }
        //
        // Przygotowanie
        let przygotowanie_all_div = document.querySelectorAll(".krok-przygotowania")
        for(i = 0; i < json.przygotowanie.length; i++) {
            if(!przygotowanie_all_div[i]) dodaj_usun_przygotowanie(true)
        }
        przygotowanie_all_div = document.querySelectorAll(".krok-przygotowania")
        for(i = 0; i < json.przygotowanie.length; i++) {
            const przygotowanie_div = przygotowanie_all_div[i]
            const tresc = przygotowanie_div.querySelector(".textarea-krok-przygotowania")
            //
            tresc.value = json.przygotowanie[i]
        }
        //
        // Podgląd
        const podglad = document.querySelector(".podglad-zdjecia")
        json.zdjecia.forEach(src => {
            const miniatura = document.createElement("img")
            miniatura.src = `./../images/przepisy/${src}`
            miniatura.classList.add("src-dodane-zdjecie")
            podglad.appendChild(miniatura)
        })
        //
        // Przycisk
        const skladniki_przycisk_dodaj = document.getElementById("dodaj-przepis-button")
        skladniki_przycisk_dodaj.classList.add(`idprzepisu-${json.id}`)
        //
    }).catch(error => {
        console.error(error)
    })
}

function zmienKolejnoscZdjec() {
    let zdjecia = document.querySelectorAll(".src-dodane-zdjecie")
    if(zdjecia.length == 0) return
    //
    let pierwszy = zdjecia[0]
    let rodzic = pierwszy.parentNode
    rodzic.removeChild(pierwszy)
    rodzic.appendChild(pierwszy)
    //
}