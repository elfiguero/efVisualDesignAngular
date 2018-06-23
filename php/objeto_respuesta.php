<?php
define("OR_CONSTANT", 1);
define("OR_ROUTET", 2);
define("OR_HTML", 3);
define("OR_CONTROLLER", 4);
define("OR_FACTORY", 5);

class objeto_respuesta
{
    public $constant;
    public $router;
    public $html="";
    public $controller;
    public $factory;

    public function append(
        $seccion,   // a que elemento se le adicionara
        $contenido  // El contenido a adicionar en formato texto
    ) {
        switch ($seccion) {
            case OR_CONSTANT:
                $constant .= $contenido;
                break;
            case OR_ROUTET:
                $router .= $contenido;
                break;
            case OR_HTML:
                $this->html .= $contenido;
                break;
            case OR_CONTROLLER:
                $controller .= $contenido;
                break;
            case OR_FACTORY:
                $factory .= $contenido;
                break;
            default:
                break;
        }
    }
}