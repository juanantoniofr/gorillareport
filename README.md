## About GorillaReport

GorillaReport  es una utilidad web inspirada en <a href="https://github.com/munkireport/munkireport-php">MunkiReport</a>, que <b>aspira a ser</b> una herramienta de informes basada en web.

Su objetivo es centralizar los logs que genera <a href="https://github.com/1dustindavis/gorilla">Gorilla</a> en cada uno de los equipos con Sistemas Windows donde se ejecuta en un único lugar. Asícomo procesar y presentar información relevante sobre el estado de los pc's clientes.

## Config

* ./config/gorillareport.php

Define el array de rangos de ip permitidas para auto registro de pc-clients: para obtener el rango de la subnet asociada a una IP cualquiera del entorno puedes utilizar la siguiente herramienta: https://www.calculator.net/ip-subnet-calculator.html


Formato:

```

return [
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
];

```
* .env

Configura el acceso a BD

```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name_database
DB_USERNAME=user_database 
DB_PASSWORD=pass_database

```

## Synopsis

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

## Authors

- [Luis Vela](https://github.com/luivelmor)
- [Juan Antonio](https://github.com/juanantoniofr)

# Contact

- Email:  luisvela@us.es | juanafr@us.es


## License

The GorillaReport is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
