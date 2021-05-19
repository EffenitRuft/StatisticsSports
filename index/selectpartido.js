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
    l1.innerHTML = "Numero de partido:"
    const inp1 = document.createElement("input")
    inp1.setAttribute("type", "text")
    inp1.setAttribute("id", "npartido")
    inp1.setAttribute("name", "npartido")
    const l2 = document.createElement("label")
    l2.setAttribute("for", "local")
    l2.innerHTML = "Equipo local:"
    const inp2 = document.createElement("input")
    inp2.setAttribute("type", "text")
    inp2.setAttribute("id", "local")
    inp2.setAttribute("name", "local")
    const l3 = document.createElement("label")
    l3.setAttribute("for", "visitante")
    l3.innerHTML = "Equipo vistante:"
    const inp3 = document.createElement("input")
    inp3.setAttribute("type", "text")
    inp3.setAttribute("id", "visitante")
    inp3.setAttribute("name", "visitante")
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
    formu.appendChild(sel1)
    formu.appendChild(document.createElement("br"))
    formu.appendChild(bt)
    di_form.appendChild(equis)
    di_form.appendChild(formu)
    di_padre.appendChild(di_form)

    bt.addEventListener("click", function (e) {
        e.preventDefault()
        const dat1 = document.getElementById("npartido").value
        const dat2 = document.getElementById("local").value
        const dat3 = document.getElementById("visitante").value
        const dat4 = document.getElementById("liga").value
        console.log(dat1 + " - " + dat2 + " - " + dat3 + " - " + dat4);
        const info = { "npartido": dat1, "local": dat2, "visitante": dat3, "liga": dat4 }
        localStorage.setItem("partido", JSON.stringify(info))
        /*
        HACER CONEXION 
        A LOCALSTORAGE IMAGINO */
        di_form.remove()
    })
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