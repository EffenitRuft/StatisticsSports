seleccionarPartido()

function seleccionarPartido() {
    ///FORMULARIO PARA ASIGNAR PARTIDO PARA INSERTAR DATOS///

    /* ------------------------------------------------- */
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
    // EQUIPO LOCAL
    const l2 = document.createElement("label")
    l2.setAttribute("for", "local")
    l2.innerHTML = "EQUIPO LOCAL"
    const inp2 = document.createElement("select")
    inp2.setAttribute("id", "local")
    inp2.setAttribute("name", "local")
    // EQUIPO VISITANTE
    const l3 = document.createElement("label")
    l3.setAttribute("for", "visitante")
    l3.innerHTML = "EQUIPO VISITANTE"
    const inp3 = document.createElement("select")
    inp3.setAttribute("id", "visitante")
    inp3.setAttribute("name", "visitante")
    // SELECCIONAR LIGA
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
    /* ------------------------------------------------- */
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

    //PIDO LOS DE MASCULINO SUPERLIGA 1 - INICIALMENTE
    damEquipos(sel1.value,inp2,inp3)
    
    /* ------------------------------------------------- */
    bt.addEventListener("click", function (e) {
        e.preventDefault()
        const dat1 = document.getElementById("npartido").value
        const dat2 = document.getElementById("local").value
        const dat3 = document.getElementById("visitante").value
        const dat4 = document.getElementById("liga").value
        console.log(dat1 + " - " + dat2 + " - " + dat3 + " - " + dat4);
        const info = { "npartido": dat1, "local": dat2, "visitante": dat3, "liga": dat4 }
        localStorage.setItem("partido", JSON.stringify(info))
        //MARTA NUEVO************************************************************************
        localStorage.setItem("set", 1)

        /* Identficar equipos */
        const partido = JSON.parse(localStorage.getItem("partido"))
        console.log(partido);

        buscarEquipo(partido["local"])
        buscarEquipo(partido["visitante"])

        num_partido = parseInt(JSON.parse(localStorage.getItem("partido"))["npartido"])
        let arrayP = [parseInt(dat2), parseInt(dat3), parseInt(dat1), dat4]
        addPartido(arrayP)
        /*HACER CONEXION A LOCALSTORAGE IMAGINO */
        /* LOCAL DEBERIA SER SIEMPRE EL USUARIO LOGEADO */
        di_form.remove()
    })

    sel1.addEventListener("change", function () {
        // CADA VEZ QUE HAYA UN CAMBIO LE PIDO EQUIPOS AL SERVIDOR
        damEquipos(sel1.value,inp2,inp3)
    })
}

//CONSTRUCTOR DE EQUIPOS
function selectEquipos(eqs,domeqs) {
    //SPLITEO LOS RESULTADO
    equipos = eqs.split(":")
    //SACO EL ULTIMO
    equipos.pop()
    //RECORRO LOS DOS SELECTS
    for (let a = 0; a < domeqs.length; a++) {
        domeqs[a].innerHTML = ""
        //ASIGNO LAS OPCIONES PARA LOS DOS EQUIPOS
        for (let i = 0; i < equipos.length; i++) {
            let opcion = document.createElement("option")
            opcion.setAttribute("value",equipos[i].split("-")[0])
            opcion.innerHTML = equipos[i].split("-")[1]
            domeqs[a].appendChild(opcion)
        }
    }
}

function damEquipos(valor,inp2,inp3) {
    var req
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = ActiveXObject("Microsoft.XMLHTTP");
    }
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
                selectEquipos(req.responseText,[inp2,inp3])
            }
        }
    }
    req.open("GET", "./basedatos.php?equipoLiga=" + valor);
    req.send()
}


//AÑADIR

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
                console.log("PARTIDO INSERTADO")
                console.log(req.responseText)
            }
        }
    }
    req.open("GET", "../server/servidor.php?addPartido=" + JSON.stringify(array));
    req.send()
}

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
                console.log("PARTIDO INSERTADO")
                console.log(req.responseText)
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
/**
 <div id="form">
    <form>
        <label for="npartido">Numero de partido:</label><br>
        <input type="text" id="npartido" name="npartido"><br>
        <label for="local">Equipo local:</label><br>
        <input type="text" id="local" name="local"><br>
        <label for="visitante">Equipo visitante:</label><br>
        <input type="text" id="visitante" name="visitante"><br><br>
        <select name="id_liga" id="liga">
            <option value="SM">SM</option>
            <option value="SF">SF</option>
            <option value="SM2">SM2</option>
            <option value="SF2">SF2</option>
        </select>
        <!--Falta conexion-->
        <button id="datosform">Enviar</button> <br>
    </form>
</div>
 */