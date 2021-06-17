/**
 * Este archivo sirve para el inicio de directo donde se creara el equipo
 * y dar valores visuales para el reconocimiento.
 */
seleccionarPartido()
/**
 * Esta funcion sirve para la creacion de partidos
 * Este crea el formulario y los selects con opciones correspondientes.
 */
function seleccionarPartido() {

    const di_padre = document.getElementById("directo")
    const di_form = document.createElement("div")
    di_form.setAttribute("id", "form")
    const formu = document.createElement("form")
    const l1 = document.createElement("label")
    l1.setAttribute("for", "npartido")
    l1.innerHTML = "NUMERO DE PARTIDO"
    const inp1 = document.createElement("input")
    inp1.setAttribute("type", "text")
    inp1.setAttribute("id", "npartido")
    inp1.setAttribute("name", "npartido")
    inp1.setAttribute("required", "")

    const l2 = document.createElement("label")
    l2.setAttribute("for", "local")
    l2.innerHTML = "EQUIPO LOCAL"
    const inp2 = document.createElement("select")
    inp2.setAttribute("id", "local")
    inp2.setAttribute("name", "local")

    const l3 = document.createElement("label")
    l3.setAttribute("for", "visitante")
    l3.innerHTML = "EQUIPO VISITANTE"
    const inp3 = document.createElement("select")
    inp3.setAttribute("id", "visitante")
    inp3.setAttribute("name", "visitante")

    const l4 = document.createElement("label")
    l4.setAttribute("for", "id_liga")
    l4.innerHTML = "SELECCIONA LIGA"
    const sel1 = document.createElement("select")
    sel1.setAttribute("name", "id_liga")
    sel1.setAttribute("id", "liga")
    const opt1 = document.createElement("option")
    opt1.setAttribute("value", "SM")
    opt1.innerHTML = "SM"
    const opt2 = document.createElement("option")
    opt2.setAttribute("value", "SF")
    opt2.innerHTML = "SF"
    const opt3 = document.createElement("option")
    opt3.setAttribute("value", "SM2")
    opt3.innerHTML = "SM2"
    const opt4 = document.createElement("option")
    opt4.setAttribute("value", "SF2")
    opt4.innerHTML = "SF2"
    const bt = document.createElement("button")
    bt.setAttribute("id", "datosform")
    bt.innerHTML = "Enviar"

    sel1.appendChild(opt1)
    sel1.appendChild(opt2)
    sel1.appendChild(opt3)
    sel1.appendChild(opt4)
    formu.appendChild(l4)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(sel1)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(l1)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(inp1)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(l2)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(inp2)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(l3)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(inp3)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(bt)
    di_form.appendChild(formu)
    di_padre.appendChild(di_form)

    damEquipos(sel1.value, inp2, inp3)
    /**
     * Este evento lo que hace es que al clickear recoge los valores
     * y crea el partido en la base de datos.
     */
    bt.addEventListener("click", function (e) {
        e.preventDefault()
        const dat1 = document.getElementById("npartido").value
        const dat2 = document.getElementById("local").value
        const dat3 = document.getElementById("visitante").value
        const dat4 = document.getElementById("liga").value
        const info = { "npartido": dat1, "local": dat2, "visitante": dat3, "liga": dat4 }
        localStorage.setItem("partido", JSON.stringify(info))

        localStorage.setItem("set", 1)

        const partido = JSON.parse(localStorage.getItem("partido"))

        buscarEquipo(partido["local"])
        buscarEquipo(partido["visitante"])
        num_partido = parseInt(JSON.parse(localStorage.getItem("partido"))["npartido"])
        let arrayP = [parseInt(dat2), parseInt(dat3), parseInt(dat1), dat4]
        
        addPartido(arrayP)
        di_form.remove()
    })

    /**
     * Este evento lo que hace es que al haber un cambio se cambien los equipos 
     */
    sel1.addEventListener("change", function () {
        damEquipos(sel1.value, inp2, inp3)
    })
}
/**
 * Esta funcion lo que hace es crear las opciones del select con equipos
 * @param eqs 
 * @param domeqs 
 * Toma como parametros eqs que es un array de equipos y domeqs que es el select a crear.
 */
function selectEquipos(eqs, domeqs) {
    equipos = eqs.split(":")
    equipos.pop()
    for (let a = 0; a < domeqs.length; a++) {
        domeqs[a].innerHTML = ""
        for (let i = 0; i < equipos.length; i++) {
            let opcion = document.createElement("option")
            opcion.setAttribute("value", equipos[i].split("-")[0])
            opcion.innerHTML = equipos[i].split("-")[1]
            domeqs[a].appendChild(opcion)
        }
    }
}
/**
 * Esta funcion lo que hace es buscar en la base de datos los equipos.
 * @param valor 
 * @param inp2 
 * @param inp3 
 * Toma como parametro valor que es la liga, inp2 que es un select y inp3 que es otro select
 */
function damEquipos(valor, inp2, inp3) {
    var req
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = ActiveXObject("Microsoft.XMLHTTP");
    }
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
                selectEquipos(req.responseText, [inp2, inp3])
            }
        }
    }
    req.open("GET", "./basedatos.php?equipoLiga=" + valor);
    req.send()
}
/**
 * Esta funcion lo que hace es añadir un partido a la base de datos.
 * @param array 
 * Toma como parametro array que dentro lleva el id del partido, equipo local, equipo visitante y liga.
 */
function addPartido(array) {
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
    req.open("GET", "../server/servidor.php?addPartido=" + JSON.stringify(array));
    req.send()
}
/**
 * Lo que hace esta funcion es buscar el partido en la base de datos y añadir el nombre para identifcar en el dom.
 * @param {*} id 
 * Toma como parametro el id del partido.
 */
function buscarEquipo(id) {
    var req
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = ActiveXObject("Microsoft.XMLHTTP");
    }
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
                if (id == JSON.parse(localStorage.getItem("partido"))["local"]) {
                    const h2local = document.getElementById("c-local")
                    h2local.innerHTML = req.responseText
                } else if (id == JSON.parse(localStorage.getItem("partido"))["visitante"]) {
                    const h2visit = document.getElementById("c-visit")
                    h2visit.innerHTML = req.responseText
                }
            }
        }
    }
    req.open("GET", "./basedatos.php?buscarPartido=" + id);
    req.send()
}
