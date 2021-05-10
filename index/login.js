if (localStorage.getItem("usuario") != null) {
    const usuario = localStorage.getItem("usuario")
    console.log("El usuario esta logeado: " + usuario);

    // CONTROL DEL FORMULARIO
    const di_cab = document.getElementById("cab")
    const bt_salir = document.createElement("button")
    bt_salir.innerHTML = "DESCONECTAR"
    di_cab.appendChild(bt_salir)
    bt_salir.addEventListener("click", function(){
        localStorage.removeItem("usuario")
        location.href = "./index.html"
    })
    // NAVEGADOR DIRECTO

    const nav = document.getElementById("barra-nav")

    const di_li = document.createElement("li")
    const di_a = document.createElement("a")
    di_a.setAttribute("href", "./directo.html")
    di_a.innerHTML = "DIRECTO"

    di_li.appendChild(di_a)
    nav.appendChild(di_li)
} else {
    console.log("El usuario NO esta logeado.");
    // CONTROL DEL FORMULARIO
    const di_cab = document.getElementById("cab")
    const di_login = document.createElement('div')
    di_login.setAttribute("id", "login")
    const di_nombre = document.createElement("h2")
    di_nombre.innerHTML = "Inicio de sesion"
    const form_login = document.createElement("form")
    form_login.setAttribute("method", "post")
    form_login.setAttribute("action", "#")
    const lab1 = document.createElement("label")
    lab1.setAttribute("for","Usuario")
    lab1.innerHTML = "Usuario"
    const inp1 = document.createElement("input")
    inp1.setAttribute("type","text")
    inp1.setAttribute("name","usu")
    inp1.setAttribute("id","usu")
    const lab2 = document.createElement("label")
    lab2.setAttribute("for", "Contra")
    lab2.innerHTML = "Contraseña"
    const inp2 = document.createElement("input")
    inp2.setAttribute("type","password")
    inp2.setAttribute("name","pass")
    inp2.setAttribute("id","pass")
    const inp3 = document.createElement("input")
    inp3.setAttribute("type","submit")
    inp3.setAttribute("name","log")
    inp3.setAttribute("id","log")
    inp3.setAttribute("value","Entrar")

    di_login.appendChild(di_nombre)
    form_login.appendChild(lab1)
    form_login.appendChild(inp1)
    form_login.appendChild(lab2)
    form_login.appendChild(inp2)
    form_login.appendChild(inp3)
    di_login.appendChild(form_login)
    di_cab.appendChild(di_login)

    
}
/**
 * <div id="login">
        <h2>Inicio de sesion</h2>
        <form action="#" method="post">
                <label for="Usuario">Usuario</label>
                <input type="text" name="usu" id="usu">
                <label for="Contraseña">Contraseña</label>
                <input type="password" name="pass" id="pass">
                <input type="submit" name="log" value="Entrar" id="log">
        </form>
    </div>
 */
