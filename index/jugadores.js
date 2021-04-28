
function jugadorBase() {
    var clicked = this.getAttribute('id')
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
    // TODO: HAY QUE ENVIAR UN EQUIPO QUE LA CUENTA YA TENDRA
    req.open("GET", "./basedatos.php?bt=damejugadores&equip=2");
    req.send()
}

function jugadores(equipo, clicked) {
    const idjug = clicked
    let div = document.createElement('div')
    div.setAttribute("id", "d-asignar")
    let select = document.createElement('select')
    select.setAttribute('name', "jugador")
    let opts = equipo
    for (let i = 0; i < opts.length; i++) {
        let opt = document.createElement("option")
        opt.setAttribute('value', opts[i].id_jugador)
        opt.innerHTML = opts[i].nombre
        select.appendChild(opt)
    }
    let bt_asignar = document.createElement("button")
    bt_asignar.setAttribute('id', "bt-asignar")
    bt_asignar.innerHTML = "ASIGNAR JUGADOR"

    div.appendChild(select)
    div.appendChild(bt_asignar)
    document.getElementById('main').appendChild(div)

    bt_asignar.addEventListener('click', function(e){
        e.preventDefault()
        let jug = document.getElementById(idjug)
        let p = document.createElement("p")
        p.innerHTML = select.options[select.selectedIndex].value
        jug.appendChild(p)
        document.getElementById('d-asignar').remove()
        jug.addEventListener('click', tablaAcciones)
    })
}
