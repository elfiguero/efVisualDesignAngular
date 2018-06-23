<?php
require_once("objeto_respuesta.php");

function procesar(
        $objeto
) {
    $resultado = new objeto_respuesta();

    foreach ($objeto['campos'] as $key => $value) {
        eval(<<<procesar_eval
            \$resultado->append(
                OR_HTML,
                procesar_{$value['tipo']}(\$key, \$value)
            );
procesar_eval
        );
    }

    return $resultado;
}

require_once("procesar_text.php");
require_once("procesar_textarea.php");
require_once("procesar_select.php");
require_once("procesar_selectmodal.php");

/**
 * Convierte las tildes de un texto a sus entidades HTML.
 * 
 * @param string $cadena Cadena a modificar.
 * @return string Cadena de texto con codigos html.
 */
function QuitarTildesHtml(
        $cadena
) { 
    $k = str_replace(
        array(
            "á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"
        ),
        array(
            "a","e","i","o","u","n","A","E","I","O","U","N"
        ),
        $cadena
    );
    return str_replace(
        array(
            "&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
            "&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"
        ),
        array(
            "a","e","i","o","u","n","A","E","I","O","U","N"
        ),
        $k
    );
}