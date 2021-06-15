if (localStorage.getItem("usuario") != null) {
    /**
     * Si el usuario esta logeado crea el boton para deslogearse
     * y añade al navegador la seccion de DIRECTO para 
     * crear el partido, introducir datos, etc...
     */
    const usuario = localStorage.getItem("usuario")
    // BOTON DE DESCONEXION
    const di_cab = document.getElementById("cab")
    const bt_salir = document.createElement("button")
    bt_salir.innerHTML = "DESCONECTAR"
    di_cab.appendChild(bt_salir)
    bt_salir.addEventListener("click", function(){
        localStorage.removeItem("usuario")
        location.href = "./index.html"
    })
    // INTRODUCIR DIRECTO AL NAVEGADOR
    const nav = document.getElementById("barra-nav")
    const di_li = document.createElement("li")
    const di_a = document.createElement("a")
    di_a.setAttribute("href", "./directo.html")
    di_a.innerHTML = "DIRECTO"
    di_li.appendChild(di_a)
    nav.appendChild(di_li)
} else {
    /**
     * Cuando el usuario no este logeado se crea un formulario
     * para que pueda iniciar sesion.
     */

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
