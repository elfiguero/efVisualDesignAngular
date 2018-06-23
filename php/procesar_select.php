<?php
function procesar_select(
        $nombre,        // nombre del campo
        $objeto         // el objeto con el resto de los valores
) {
    // html_nombre
    if (is_null(@$objeto['html_nombre']) OR @$objeto['html_nombre']=="") {
        $objeto['html_nombre'] = ucwords($objeto['html_nombre']);
    }
    $objeto['html_nombre'] = htmlentities($objeto['html_nombre'], ENT_QUOTES, "UTF-8");

    // html_null
    if (is_null(@$objeto['html_null']) OR @$objeto['html_null']=="") {
        $objeto['html_null'] = "Seleccione " . strtolower($objeto['html_nombre']);
    } else {
        $objeto['html_null'] = htmlentities($objeto['html_null'], ENT_QUOTES, "UTF-8");
    }

    if (null === @$objeto['selecionado'] OR @$objeto['selecionado'] == "") {
        $objeto['selecionado'] = "";
        $lista_opciones = "        <option value=\"\" ng-selected=\"selected\">{$objeto['html_null']}</option>";
    } else {
        $lista_opciones = "";
    }
    foreach ($objeto['opciones'] as $key => $value) {
        $value = htmlentities($value, ENT_QUOTES, "UTF-8");
        if ($objeto['selecionado'] == $key) {
            $selecionado = " ng-selected=\"selected\"";
        } else {
            $selecionado = "";
        }
        if ($lista_opciones != "") {
            $lista_opciones .= "\n";
        }
        $lista_opciones .= "        <option value=\"$key\"$selecionado>$value</option>";
    }
/*
        <option value="" ng-selected="selected">Seleccione un estado</option>
        <option value="A">Activo</option>
        <option value="I">Inactivo</option>
*/
    return <<<procesar_fin

<div class="form-group"
    ng-class="{'has-error':For.$nombre.\$dirty && Form.$nombre.\$invalid, 'has-success':Form.$nombre.\$valid}">
    <label class="control-label">
        {$objeto['html_nombre']}
        <span class="symbol required"></span>
    </label>
    <select class="form-control" name="$nombre"
        ng-model="objeto.$nombre" required>
$lista_opciones
    </select>
    <span class="error text-small block"
        ng-if="Form.$nombre.\$dirty && Form.$nombre.\$invalid">
        Incorrecto
    </span>
    <span class="success text-small"
        ng-if="Form.$nombre.\$valid">
        Listo
    </span>
</div>

procesar_fin;
}
