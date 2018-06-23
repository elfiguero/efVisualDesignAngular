<?php
function procesar_textarea(
        $nombre,        // nombre del campo
        $objeto         // el objeto con el resto de los valores
) {
    // sololectura
    if (!is_null(@$objeto['sololectura']) AND @$objeto['sololectura']!="") {
        $objeto['sololectura'] = ' ng-disabled="true"';
    } else {
        $objeto['sololectura'] = "";
    }

    // editar_sololectura
    if (!is_null(@$objeto['editar_sololectura']) AND @$objeto['editar_sololectura']!="") {
        $objeto['editar_sololectura'] = ' ng-disabled="!nuevoar"';
    } else {
        $objeto['editar_sololectura'] = "";
    }

    // html_nombre
    if (is_null(@$objeto['html_nombre']) OR @$objeto['html_nombre']=="") {
        $objeto['html_nombre'] = ucwords($objeto['html_nombre']);
    }
    $objeto['html_nombre'] = htmlentities($objeto['html_nombre'], ENT_QUOTES, "UTF-8");

    // html_null
    if (is_null(@$objeto['html_null']) OR @$objeto['html_null']=="") {
        $objeto['html_null'] = "Escriba un " . strtolower($objeto['html_nombre']);
    } else {
        $objeto['html_null'] = htmlentities($objeto['html_null'], ENT_QUOTES, "UTF-8");
    }

    $k = <<<procesar_text_fin

<div class="form-group"
    ng-class="{'has-error':For.$nombre.\$dirty && Form.$nombre.\$invalid, 'has-success':Form.$nombre.\$valid}">
    <label class="control-label">
        {$objeto['html_nombre']}
        <span class="symbol required"></span>
    </label>
    <textarea name="$nombre" rows="5" style="width: 100%" placeholder="{$objeto['html_null']}"
        class="form-control" ng-model="objeto.$nombre"
        required{$objeto['editar_sololectura']}{$objeto['sololectura']}>
    </textarea>
    <span class="error text-small block"
        ng-if="Form.$nombre.\$dirty && Form.$nombre.\$invalid">
        Incorrecto
    </span>
    <span class="success text-small"
        ng-if="Form.$nombre.\$valid">
        Listo
    </span>
</div>

procesar_text_fin;
    return $k;
}
