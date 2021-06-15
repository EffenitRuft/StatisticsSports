/*
* Constructor de jugadores. Sirve para poder asignar jugadores
* y poder cambiar el jugador de cada equipo.
*/
function jugadorBase() {
    let clicked = this.getAttribute("id")
    let idequip
    // Parte de cambiar de jugador
    if (clicked.includes("bt-editar-") === true) {
        document.getElementById("d-accion").remove()
        clicked = "jug-" + clicked.split("-")[2].toString()
        let nodo = document.getElementById(clicked)
        if (nodo.parentNode.getAttribute("id") == "campo") {
            idequip = JSON.parse(localStorage.getItem("partido"))["local"]
        } else if (nodo.parentNode.getAttribute("id") == "campo2") {
            idequip = JSON.parse(localStorage.getItem("partido"))["visitante"]
        }
    }
    // Separador para saber a que equipo pertenece.
    if (this.parentNode.getAttribute("id") == "campo") {
        idequip = JSON.parse(localStorage.getItem("partido"))["local"]
    } else if (this.parentNode.getAttribute("id") == "campo2") {
        idequip = JSON.parse(localStorage.getItem("partido"))["visitante"]
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
                jugadores(JSON.parse(req.response), clicked, idequip)
            }
        }
    }
    req.open("GET", "./basedatos.php?bt=damejugadores&equip=" + idequip);
    req.send()
}

// Constructor para elegir jugadores cuando salga la ventana.

function jugadores(equipo, clicked, idequip) {
    const idjug = clicked
    let div = document.createElement('div')
    div.setAttribute("id", "d-asignar")
    let select = document.createElement('select')
    select.setAttribute('name', "jugador")

    const dom_equipo1 = ["jug-1", "jug-2", "jug-3", "jug-4", "jug-5", "jug-6", "jug-7"]
    const dom_equipo2 = ["jug-12", "jug-22", "jug-32", "jug-42", "jug-52", "jug-62", "jug-72"]
    //RECOGE EQUIPO
    let opts = equipo
    // Comprobador para que no se repitan jugadores
    if (dom_equipo1.includes(clicked)) {
        let dom_campo1 = document.getElementById("campo").children
        let dentro = []
        for (let a = 0; a < dom_campo1.length; a++) {
            if (dom_campo1[a].hasChildNodes()) {
                //SI TIENE HIJO MIRA CUAL ES Y LO METE A JUGANDO
                dentro.push(dom_campo1[a].firstChild.innerHTML)
            }
        }
        for (let i = 0; i < dentro.length; i++) {
            for (let a = 0; a < opts.length; a++) {
                if (opts[a].idjugadorBase == dentro[i]) {
                    opts.splice(a, 1)
                }
            }
        }
        for (let a = 0; a < opts.length; a++) {
            let opt = document.createElement("option")
            opt.setAttribute('value', opts[a].idjugadorBase)
            opt.innerHTML = opts[a].nombre
            select.appendChild(opt)
        }
    } else if (dom_equipo2.includes(clicked)) {
        let dom_campo2 = document.getElementById("campo2").children
        let dentro = []
        for (let a = 0; a < dom_campo2.length; a++) {
            if (dom_campo2[a].hasChildNodes()) {
                //SI TIENE HIJO MIRA CUAL ES Y LO METE A JUGANDO
                dentro.push(dom_campo2[a].firstChild.innerHTML)
            }
        }
        for (let i = 0; i < dentro.length; i++) {
            for (let a = 0; a < opts.length; a++) {
                if (opts[a].idjugadorBase == dentro[i]) {
                    opts.splice(a, 1)
                }
            }
        }
        for (let a = 0; a < opts.length; a++) {
            let opt = document.createElement("option")
            opt.setAttribute('value', opts[a].idjugadorBase)
            opt.innerHTML = opts[a].nombre
            select.appendChild(opt)
        }
    }
    let bt_asignar = document.createElement("button")
    bt_asignar.setAttribute('id', "bt-asignar")
    bt_asignar.innerHTML = "ASIGNAR JUGADOR"

    div.appendChild(select)
    div.appendChild(bt_asignar)
    document.getElementById('main').appendChild(div)

    document.getElementById(idjug).removeEventListener('click', jugadorBase)

    // Evento para añadir el numero del jugador al DOM
    bt_asignar.addEventListener('click', function (e) {
        let num_jugador = 0;
        e.preventDefault()
        let jug = document.getElementById(idjug)
        if (jug.hasChildNodes()) {
            let p = jug.firstChild
            p.innerHTML = select.options[select.selectedIndex].value
            num_jugador = p.innerHTML;
        } else {
            let p = document.createElement("p")
            p.innerHTML = select.options[select.selectedIndex].value
            jug.appendChild(p)
            num_jugador = p.innerHTML;
        }
        /*
        *  Se añade jugador a la base de datos 
        *  por partido y set, por lo que puede existir
        *  el mismo jugador en el mismo partido pero
        *  jugando diferentes sets.
        */

        let num_set = localStorage.getItem("set")
        let arrayJ = [parseInt(num_jugador), parseInt(idequip), num_partido, parseInt(num_set)]
        addJugador(arrayJ)
        document.getElementById('d-asignar').remove()
        div.remove()
        jug.addEventListener('click', tablaAcciones)
    })
}

// Añade jugador a la base de datos.
function addJugador(array) {
    var req
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = ActiveXObject("Microsoft.XMLHTTP");
    }
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
            }
        }
    }
    req.open("GET", "../server/servidor.php?addJugador=" + JSON.stringify(array));
    req.send()
}

/*
*  Al seleccionar equipo aparece en la pagina para identificar los campos 
*/
function darEquipo(id) {
    var req
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = ActiveXObject("Microsoft.XMLHTTP");
    }
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
            }
        }
    }
    req.open("GET", "./basedatos.php?equipos=" + idequip);
    req.send()
}