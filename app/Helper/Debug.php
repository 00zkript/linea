<?php

if (! function_exists('dumpUnique')) {
    /**
     * Función para imprimir la data ingresada en un pre de forma unica
     * @return string
     */
    function dumpUnique($data)
    {
        echo("<pre style='background: black;color:lawngreen;padding: 20px;white-space: break-spaces;position: relative;margin: 10px;' >");
        print_r( $data );
        echo("</pre>");
    }
}

if (! function_exists('cdump')) {
    /**
     * Función para imprimir los multiples valores ingresados en un pre
     * @return string
     */
    function cdump()
    {
        foreach (func_get_args() as $data) {
            dumpUnique($data);
        }
    }
}


if (! function_exists('cdd')) {
    /**
     * Función para imprimir los multiples valores ingresados en un pre y leugo acabar con la ejecución
     * @return string
     */
    function cdd()
    {
        foreach (func_get_args() as $data) {
            dumpUnique($data);
        }
        exit;
    }
}


if (! function_exists('sqlDump')) {
    /**
     * Función para constuir el sql con sus valores correspondientes
     * @param object $query El query antes de la ejecución "get() | first()"
     * @return string
     */
    function sqlDump($query)
    {

        $sql = $query->toSql();
        $formatSql = str_replace('?', '%s', $sql);

        $data = collect($query->getBindings())
            ->map(function ($binding) {
                $binding = addslashes($binding);
                return is_numeric($binding) ? $binding : "'{$binding}'";
            })
            ->toArray();

        return vsprintf( $formatSql , $data );
    }
}
