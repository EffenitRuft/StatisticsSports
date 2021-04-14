<?php
    echo'<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="style.css">
    <title>Registro - StatisticSports</title>';

    echo"<form method='POST'>
    <label for='nom_reg'>Nombre de usuario</label>
    <input type='text' name='nom_reg' required>
    <label for='pass_reg'>Contraseña</label>
    <input type='password' name='pass_reg' required>
    <label for=''>Elegir tipo de cuenta</label>
    <select name='tipo_reg'>
        <option value='t_cl'>CLUB</option>
        <option value='t_us'>USUARIO</option>
    </select>
    <input type='submit' value='Registrarse'>
    </form>";
?>