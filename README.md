## About GorillaReport

GorillaReport  es una utilidad web inspirada en <a href="https://github.com/munkireport/munkireport-php">MunkiReport</a>, que <b>aspira a ser</b> una herramienta de informes basada en web.

Su objetivo es centralizar los logs que genera <a href="https://github.com/1dustindavis/gorilla">Gorilla</a> en cada uno de los equipos con Sistemas Windows donde se ejecuta en un único lugar. Asícomo procesar y presentar información relevante sobre el estado de los pc's clientes.

## Config

* ./config/gorillareport.php

Definir el array de rangos de ip permitidas para auto registro de pc-clients.

Formato:

`return [
        'allowed_ip_ranges' => [
            [
                'start' => 'AA.BB.XX.YY',
                'end' => 'AA.BB.XX.ZZ'
            ],
            [
                'start' => 'CC.DD.XX.YY',
                 'end' => 'CC.DD.ZZ.WW'
            ],
        ]
];`


## SYNOPSIS: 

API

* ./api/login

Autentica el pc-client.
Devuelve token de acceso.

* ./api/client/register

Auto registra pc-client.
Requiere token de acceso.

* ./api/client/updateBasicInformation

Registra información básica del equipo: SO, build, CPU, RAM...
Requiere token de acceso.

* ./api/client/updateReport

Registra logs de la última ejecución de gorilla.
Requiere token de acceso.

## License

The GorillaReport is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
