/*
 *  Este archivo sirve para asignar los jugadores de manera visual y en la base de datos. 
 */

/*
*  Esta funcion lo que hace es buscar en la base de datos los jugadores 
*  y los pasa por otra funcion.
*/
function jugadorBase() {
    let clicked = this.getAttribute("id")
    let idequip
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

/*
 * Esta funcion lo que hace es crear un select con jugadores.
 * @param equipo 
 * @param clicked 
 * @param idequip 
 * Toma como parametros equipo que es un array de jugadores,
 * clicked que es el div clickeado y idequip que es el id del equipo al
 * que pertenece
 */

function jugadores(equipo, clicked, idequip) {
    const idjug = clicked
    let div = document.createElement('div')
    div.setAttribute("id", "d-asignar")
    let select = document.createElement('select')
    select.setAttribute('name', "jugador")

    const dom_equipo1 = ["jug-1", "jug-2", "jug-3", "jug-4", "jug-5", "jug-6", "jug-7"]
    const dom_equipo2 = ["jug-12", "jug-22", "jug-32", "jug-42", "jug-52", "jug-62", "jug-72"]

    let opts = equipo
    if (dom_equipo1.includes(clicked)) {
        let dom_campo1 = document.getElementById("campo").children
        let dentro = []
        for (let a = 0; a < dom_campo1.length; a++) {
            if (dom_campo1[a].hasChildNodes()) {
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

    /*
     *  Este evento lo que hace es al clickear se pone el numero del jugador,
     *  añade a la base de datos un jugador por partido y set.
     */
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
        let num_set = localStorage.getItem("set")
        let arrayJ = [parseInt(num_jugador), parseInt(idequip), num_partido, parseInt(num_set)]
        addJugador(arrayJ)
        document.getElementById('d-asignar').remove()
        div.remove()
        jug.addEventListener('click', tablaAcciones)
    })
}

/*
 *  Esta funcion lo que hace es añadir a la base de datos el jugador.
 *  @param array 
 *  Toma como parametro un array con el numero de jugador, id del equipo, partido y set.
 */
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
 *  Esta funcion lo que hace buscar en la base de datos el equipo
 *  @param {*} id 
 *  Toma como parametro el id del equipo
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