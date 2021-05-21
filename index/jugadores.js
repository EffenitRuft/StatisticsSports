
function jugadorBase() {
    let clicked = this.getAttribute("id")
    let idequip
    if (clicked.includes("bt-editar-") === true) {
        document.getElementById("d-accion").remove()
        clicked = "jug-" + clicked.split("-")[2].toString()
        let nodo = document.getElementById(clicked)
        if (nodo.parentNode.getAttribute("id") == "campo") {
            idequip = JSON.parse(localStorage.getItem("partido"))["local"]
            console.log(idequip);
        } else if (nodo.parentNode.getAttribute("id") == "campo2") {
            idequip = JSON.parse(localStorage.getItem("partido"))["visitante"]
            console.log(idequip);
        }
    }
    if (this.parentNode.getAttribute("id") == "campo") {
        idequip = JSON.parse(localStorage.getItem("partido"))["local"]
        console.log(idequip);
    } else if (this.parentNode.getAttribute("id") == "campo2") {
        idequip = JSON.parse(localStorage.getItem("partido"))["visitante"]
        console.log(idequip);
    }
    var req
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = ActiveXObject("Microsoft.XMLHTTP");
    }
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
                console.log("DATOS RECIBIDOS CON ÉXITO")
                jugadores(JSON.parse(req.response), clicked)
            }
        }
    }
    req.open("GET", "./basedatos.php?bt=damejugadores&equip=" + idequip);
    req.send()
}

function jugadores(equipo, clicked) {
    const idjug = clicked
    let div = document.createElement('div')
    div.setAttribute("id", "d-asignar")
    let select = document.createElement('select')
    select.setAttribute('name', "jugador")

    const dom_equipo1 = ["jug-1", "jug-2", "jug-3", "jug-4", "jug-5", "jug-6"]
    const dom_equipo2 = ["jug-12", "jug-22", "jug-32", "jug-42", "jug-52", "jug-62"]

    let opts = equipo
    for (let i = 0; i < opts.length; i++) {
        let opt = document.createElement("option")
        // PARA QUE NO APAREZCAN EN LA LISTA DE OPCIONES
        if (dom_equipo1.includes(clicked)) {
            for (let a = 0; a < dom_equipo1.length; a++) {
                if (document.getElementById(dom_equipo1[a]).hasChildNodes()) {
                    if (parseInt(document.getElementById(dom_equipo1[a]).children[0].innerHTML) == opts[i].id_jugador) {
                        opts.splice(i, 1)
                        console.log("Ya esta asignado: " + opts[i].id_jugador);
                    } else {
                        opt.setAttribute('value', opts[i].id_jugador)
                        opt.innerHTML = opts[i].nombre
                        select.appendChild(opt)
                    }
                } else {
                    opt.setAttribute('value', opts[i].id_jugador)
                    opt.innerHTML = opts[i].nombre
                    select.appendChild(opt)
                }
            }
        } else if (dom_equipo2.includes(clicked)) {
            for (let a = 0; a < dom_equipo2.length; a++) {
                if (document.getElementById(dom_equipo2[a]).hasChildNodes()) {
                    if (parseInt(document.getElementById(dom_equipo2[a]).children[0].innerHTML) == opts[i].id_jugador) {
                        opts.splice(i, 1)
                        console.log("Ya esta asignado: " + opts[i].id_jugador);
                    } else {
                        opt.setAttribute('value', opts[i].id_jugador)
                        opt.innerHTML = opts[i].nombre
                        select.appendChild(opt)
                    }
                } else {
                    opt.setAttribute('value', opts[i].id_jugador)
                    opt.innerHTML = opts[i].nombre
                    select.appendChild(opt)
                }
            }
        }
    }
    let bt_asignar = document.createElement("button")
    bt_asignar.setAttribute('id', "bt-asignar")
    bt_asignar.innerHTML = "ASIGNAR JUGADOR"

    div.appendChild(select)
    div.appendChild(bt_asignar)
    document.getElementById('main').appendChild(div)

    document.getElementById(idjug).removeEventListener('click', jugadorBase)

    bt_asignar.addEventListener('click', function (e) {
        e.preventDefault()
        let jug = document.getElementById(idjug)
        if (jug.hasChildNodes()) {
            let p = jug.firstChild
            p.innerHTML = select.options[select.selectedIndex].value
        } else {
            let p = document.createElement("p")
            p.innerHTML = select.options[select.selectedIndex].value
            jug.appendChild(p)
        }
        document.getElementById('d-asignar').remove()
        div.remove()
        jug.addEventListener('click', tablaAcciones)
    })
}
