<?php

function fechadevolucion($fechadeinicio, $limiteprestamo){

        //Arreglo con todos los feriados
        $feriados = array(
            '2020-10-12',
            '2020-11-23',
            '2020-12-07',
            '2020-12-08',
            '2020-12-25',
            '2021-01-01',
            '2021-03-24',
            '2021-04-02',
            '2021-05-25',
            '2021-07-09',
            '2021-12-08',
            );

              //Timestamp De Fecha De Comienzo
        $comienzo = strtotime($fechadeinicio);

             //Inicializo la Fecha Final
        $fecha_venci_noti = $comienzo;

            //Inicializo El Contador
        $i = 1;
         while ($i < $limiteprestamo) {
            //Le Sumo un Dia a La Fecha Final (86400 Segundos)
        $fecha_venci_noti += 86400;

          //Inicializo a FALSE La Variable Para Saber Si Es Feriado
        $es_feriado = FALSE;

            //Recorro Todos Los Feriados
        foreach ($feriados as $key => $feriado) {
            //Verifico Si La Fecha Final Actual Es Feriado O No
            if (date("Y-m-d", $fecha_venci_noti) == date("Y-m-d", strtotime($feriado))) {
                //En Caso de Ser feriado Cambio Mi variable A TRUE
                $es_feriado = TRUE; }
        }
        //Verifico Que No Sea Un Sabado, Domingo O Feriado
        if (!(date("w", $fecha_venci_noti) == 6 || date("w", $fecha_venci_noti) == 0 || $es_feriado)) {
            //En Caso De No Ser Sabado, Domingo O Feriado Aumentamos Nuestro contador
            $i++; }}
    $new_date_format = date('Y-m-d H:i:s', $fecha_venci_noti);
    return $new_date_format;
}
