
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
                jugadores(JSON.parse(req.response), clicked,idequip)
            }
        }
    }
    req.open("GET", "./basedatos.php?bt=damejugadores&equip=" + idequip);
    req.send()
}

function jugadores(equipo, clicked, idequip) {
    const idjug = clicked
    let div = document.createElement('div')
    div.setAttribute("id", "d-asignar")
    let select = document.createElement('select')
    select.setAttribute('name', "jugador")
   
    const dom_equipo1 = ["jug-1", "jug-2", "jug-3", "jug-4", "jug-5", "jug-6","jug-7"]
    const dom_equipo2 = ["jug-12", "jug-22", "jug-32", "jug-42", "jug-52", "jug-62","jug-72"]
    //RECOGE EQUIPO
    let opts = equipo
        if (dom_equipo1.includes(clicked)) {
            let dom_campo1 = document.getElementById("campo").children
            let dentro = []
            for (let a = 0; a < dom_campo1.length; a++) {
                if(dom_campo1[a].hasChildNodes()){
                    //SI TIENE HIJO MIRA CUAL ES Y LO METE A JUGANDO
                    dentro.push(dom_campo1[a].firstChild.innerHTML)
                }
            }
            for (let i = 0; i < dentro.length; i++) {
                for (let a = 0; a < opts.length; a++) {
                    if(opts[a].idjugadorBase == dentro[i]){
                        opts.splice(a,1)
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
                if(dom_campo2[a].hasChildNodes()){
                    //SI TIENE HIJO MIRA CUAL ES Y LO METE A JUGANDO
                    dentro.push(dom_campo2[a].firstChild.innerHTML)
                }
            }
            for (let i = 0; i < dentro.length; i++) {
                for (let a = 0; a < opts.length; a++) {
                    if(opts[a].idjugadorBase == dentro[i]){
                        opts.splice(a,1)
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

    bt_asignar.addEventListener('click', function (e) {
        let num_jugador=0;
        e.preventDefault()
        let jug = document.getElementById(idjug)
        if (jug.hasChildNodes()) {
            let p = jug.firstChild
            p.innerHTML = select.options[select.selectedIndex].value
            num_jugador=p.innerHTML;
        } else {
            let p = document.createElement("p")
            p.innerHTML = select.options[select.selectedIndex].value
            jug.appendChild(p)
            num_jugador=p.innerHTML;
        }
        //NUEVO *******************************************************************************************
        let num_set = localStorage.getItem("set")
        let arrayJ = [parseInt(num_jugador),parseInt(idequip),num_partido,parseInt(num_set)]
        console.log(arrayJ);
        addJugador(arrayJ)
        document.getElementById('d-asignar').remove()
        div.remove()
        jug.addEventListener('click', tablaAcciones)
    })
}

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
                console.log("JUGADOR INSERTADO")
                console.log(req.responseText)
            }
        }
    }
    req.open("GET", "../server/servidor.php?addJugador="+JSON.stringify(array));
    req.send()
}

function darEquipo(id){
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
                console.log(JSON.parse(req.response))
            }
        }
    }
    req.open("GET", "./basedatos.php?equipos=" + idequip);
    req.send()
}
    /*
    CODIGO DE PRUEBA PARA ELIMINAR DE OPCIONES
    
    let banquillo = equipo
        for (let i = 0; i < banquillo.length; i++) {
            let opt = document.createElement("option")
            opt.setAttribute('value', banquillo[i].id_jugador)
            opt.innerHTML = banquillo[i].nombre
            select.appendChild(opt)
        }

    
    let vacio = [] // PORQUE VACIO SIEMPRE SE LLENA DE 1 
    let jugando
    let banquillo = equipo
    let cont = 0
    console.log(banquillo);//  SI
    if (dom_equipo1.includes(clicked)) {
        
        console.log(dom_equipo1.includes(clicked)); 
        for (let i = 0; i < dom_equipo1.length; i++) {
            for (let a = 0; a < banquillo.length; a++) {
                if (document.getElementById(dom_equipo1[i]).hasChildNodes() && parseInt(document.getElementById(dom_equipo1[i]).children[0].innerHTML) == banquillo[a].idjugadorBase) {
                    console.log("SE REPITE: " + dom_equipo1[i]);
                    vacio[i] = 0
                } else {
                    console.log("NO SE REPITE");
                    vacio[i] = 1
                    /*let opt = document.createElement("option")
                    opt.setAttribute('value', banquillo[a].idjugadorBase)
                    opt.innerHTML = banquillo[a].nombre
                    select.appendChild(opt)
                }
            }
        }
        console.log(vacio);
        for (let i = 0; i < vacio.length; i++) {
            if(vacio[i] == 1){
                cont += 1
            }
        }
        if(cont == dom_equipo1.length){
            for (let a = 0; a < banquillo.length; a++) {
                let opt = document.createElement("option")
                opt.setAttribute('value', banquillo[a].idjugadorBase)
                opt.innerHTML = banquillo[a].nombre
                select.appendChild(opt)
            }
        }else{
            console.log("NO PASA NADA");
        }
    }
    /*for (let i = 0; i < banquillo.length; i++) {
        let opt = document.createElement("option")
        opt.setAttribute('value', banquillo[i].idjugadorBase)
        opt.innerHTML = banquillo[i].nombre
        console.log(banquillo[i].nombre);
        select.appendChild(opt)
    }*/