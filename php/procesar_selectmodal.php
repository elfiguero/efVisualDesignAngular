<?php
function procesar_selectmodal(
        $nombre,        // nombre del campo
        $objeto         // el objeto con el resto de los valores
) {
    // html_nombre
    if (is_null(@$objeto['html_nombre']) OR @$objeto['html_nombre']=="") {
        $objeto['html_nombre'] = ucwords($objeto['html_nombre']);
    }
    $objeto['html_nombre'] = htmlentities($objeto['html_nombre'], ENT_QUOTES, "UTF-8");

    $nombre_modulo = ucwords(QuitarTildesHtml($objeto['html_nombre']), ' ');
    $nombre_modulo = str_replace(' ', '', $nombre_modulo);

    // html_null
    if (is_null(@$objeto['html_null']) OR @$objeto['html_null']=="") {
        $objeto['html_null'] = "Seleccione " . strtolower($objeto['html_nombre']);
    } else {
        $objeto['html_null'] = htmlentities($objeto['html_null'], ENT_QUOTES, "UTF-8");
    }

    return <<<procesar_fin

<div class="form-group"
    ng-class="{'has-error':For.$nombre.\$dirty && Form.$nombre.\$invalid, 'has-success':Form.$nombre.\$valid}">
    <label class="control-label">
        {$objeto['html_nombre']}
        <span class="symbol required"></span>
    </label>
    <div class="input-group">
        <input type="text" placeholder="{$objeto['html_null']}"
            class="form-control" name="$nombre" ng-disabled="true"
            ng-model="objeto.$nombre">
        <span class="input-group-btn">
            <button type="button" class="btn btn-primary"
                ng-click="abrir$nombre_modulo()">
                <i class="fa fa-search"></i>
                Seleccione
            </button>
        </span>
    </div>
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
