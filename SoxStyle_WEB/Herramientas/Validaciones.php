<?php
function comprobarVacioRgister($dato1,$dato2,$dato3,$dato4,$dato5)
{
    if (trim(!empty($dato1)) && trim(!empty($dato2)) && trim(!empty($dato3)) && trim(!empty($dato4)) && trim(!empty($dato5))) {
        return true;
    } else {
        return false;
    }
}

function longitudPass($dato)
{
    $longitud_pass = strlen($dato);
    if ($longitud_pass >= 14) {
        return true;
    } else {
        return false;
    }
}

function caracteresPass($dato)
{
    if (preg_match('/^(?=.*[A-Z])(?=.*\d{5})/', $dato)) {
        return true;
    } else {
        return false;
    }
}

function comprobarFechaNacimiento($dato)
{
    $fecha_actual = date('Y-m-d');

    $fecha1_obj = DateTime::createFromFormat('Y-m-d', $dato);
    $fecha2_obj = DateTime::createFromFormat('Y-m-d', $fecha_actual);

    $diferencia = $fecha1_obj->diff($fecha2_obj);

    $anios_diferencia = $diferencia->y;

    if ($anios_diferencia >= 18) {
        return true;
    } else {
        return false;
    }
}
