<?php

require_once("config.php");

function conectaDb()
{
    global $cfg;

    $dsn_conbbdd = "mysql:host=$cfg[mysqlHost];dbname=$cfg[mysqlDatabase];charset=utf8mb4";
    $dsn_sinbbdd = "mysql:host=$cfg[mysqlHost];charset=utf8mb4";
    $usuario = $cfg["mysqlUser"];
    $contraseña = $cfg["mysqlPassword"];

    try {
        //Conecto a una bbdd concreta
        $tmp = new PDO($dsn_conbbdd, $usuario, $contraseña);
    } catch (PDOException $e) {
        //Conecto pero sin escoger la bbdd. Por ejemplo, si voy a crearla
        $tmp = new PDO($dsn_sinbbdd, $usuario, $contraseña);
    } catch (PDOException $e) {
        print "    <p>Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        //return null;
        exit;
    } finally {
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        return $tmp;
    }
}



function pie()
{

    print "  <footer>\n";
    print "    <p class=\"ultmod\">\n";
    print "      Creado por Angel Porlan Garcia\n";
    print "    </p>\n";
    print "\n";
    print "  </footer>\n";
}

function cabecera($texto, $menu)
{
    print "  <header>\n";
    print "    <h1>Bases de datos - $texto</h1>\n";
    print "\n";
    print "    <nav>\n";
    print "      <ul>\n";
    if ($menu == 'MENU_PRINCIPAL') {
        print "        <li><a href='confirmar_borrado.php'>Borrar todo</a></li>";
        print "        <li><a href='anadir_registro.php'>Añadir registro</a></li>";
        print "        <li><a href='borrado.php'>Borrar</a></li>";
        print "        <li><a href='buscar.php'>Buscar</a></li>";
        print "        <li><a href='modificar.php'>Modificar</a></li>";
    } elseif ($menu == 'MENU_VOLVER') {
        print "        <li><a href='index.php'>Volver</a></li>\n";
    } else {
        print "        <li>Error en la selección de menú</li>\n";
    }
    print "      </ul>\n";
    print "    </nav>\n";
    print "  </header>\n";
    print "\n";
}

function recoge($var)
{
    if (isset($_REQUEST[$var])) {
        if ($_REQUEST[$var] != "") {
            $tmp = trim(htmlspecialchars(strip_tags($_REQUEST[$var])));
            return $tmp;
        }
    }
    return null;
}