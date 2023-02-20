<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('estados')->insert(array(
            0 => array(
                'id' => 1,
                'nombre' => 'AGUASCALIENTES',
                'slug' => 'aguascalientes',
                'codigo_sat' => 'AGU',
            ),
            1 => array(
                'id' => 2,
                'nombre' => 'BAJA CALIFORNIA',
                'slug' => 'baja-california',
                'codigo_sat' => 'BCN',
            ),
            2 => array(
                'id' => 3,
                'nombre' => 'BAJA CALIFORNIA SUR',
                'slug' => 'baja-california-sur',
                'codigo_sat' => 'BCS',
            ),
            3 => array(
                'id' => 4,
                'nombre' => 'CAMPECHE',
                'slug' => 'campeche',
                'codigo_sat' => 'CAM',
            ),
            4 => array(
                'id' => 5,
                'nombre' => 'COAHUILA DE ZARAGOZA',
                'slug' => 'coahuila-de-zaragoza',
                'codigo_sat' => 'COA',
            ),
            5 => array(
                'id' => 6,
                'nombre' => 'COLIMA',
                'slug' => 'colima',
                'codigo_sat' => 'COL',
            ),
            6 => array(
                'id' => 7,
                'nombre' => 'CHIAPAS',
                'slug' => 'chiapas',
                'codigo_sat' => 'CHP',
            ),
            7 => array(
                'id' => 8,
                'nombre' => 'CHIHUAHUA',
                'slug' => 'chihuahua',
                'codigo_sat' => 'CHH',
            ),
            8 => array(
                'id' => 9,
                'nombre' => 'CIUDAD DE MÉXICO',
                'slug' => 'ciudad-de-mexico',
                'codigo_sat' => 'CMX',
            ),
            9 => array(
                'id' => 10,
                'nombre' => 'DURANGO',
                'slug' => 'durango',
                'codigo_sat' => 'DUR',
            ),
            10 => array(
                'id' => 11,
                'nombre' => 'GUANAJUATO',
                'slug' => 'guanajuato',
                'codigo_sat' => 'GUA',
            ),
            11 => array(
                'id' => 12,
                'nombre' => 'GUERRERO',
                'slug' => 'guerrero',
                'codigo_sat' => 'GRO',
            ),
            12 => array(
                'id' => 13,
                'nombre' => 'HIDALGO',
                'slug' => 'hidalgo',
                'codigo_sat' => 'HID',
            ),
            13 => array(
                'id' => 14,
                'nombre' => 'JALISCO',
                'slug' => 'jalisco',
                'codigo_sat' => 'JAL',
            ),
            14 => array(
                'id' => 15,
                'nombre' => 'MÉXICO',
                'slug' => 'mexico',
                'codigo_sat' => 'MEX',
            ),
            15 => array(
                'id' => 16,
                'nombre' => 'MICHOACÁN DE OCAMPO',
                'slug' => 'michoacan-de-ocampo',
                'codigo_sat' => 'MIC',
            ),
            16 => array(
                'id' => 17,
                'nombre' => 'MORELOS',
                'slug' => 'morelos',
                'codigo_sat' => 'MOR',
            ),
            17 => array(
                'id' => 18,
                'nombre' => 'NAYARIT',
                'slug' => 'nayarit',
                'codigo_sat' => 'NAY',
            ),
            18 => array(
                'id' => 19,
                'nombre' => 'NUEVO LEÓN',
                'slug' => 'nuevo-leon',
                'codigo_sat' => 'NLE',
            ),
            19 => array(
                'id' => 20,
                'nombre' => 'OAXACA',
                'slug' => 'oaxaca',
                'codigo_sat' => 'OAX',
            ),
            20 => array(
                'id' => 21,
                'nombre' => 'PUEBLA',
                'slug' => 'puebla',
                'codigo_sat' => 'PUE',
            ),
            21 => array(
                'id' => 22,
                'nombre' => 'QUERÉTARO',
                'slug' => 'queretaro',
                'codigo_sat' => 'QUE',
            ),
            22 => array(
                'id' => 23,
                'nombre' => 'SAN LUIS POTOSÍ',
                'slug' => 'san-luis-potosi',
                'codigo_sat' => 'SLP',
            ),
            23 => array(
                'id' => 24,
                'nombre' => 'SINALOA',
                'slug' => 'sinaloa',
                'codigo_sat' => 'SIN',
            ),
            24 => array(
                'id' => 25,
                'nombre' => 'SONORA',
                'slug' => 'sonora',
                'codigo_sat' => 'SON',
            ),
            25 => array(
                'id' => 26,
                'nombre' => 'TABASCO',
                'slug' => 'tabasco',
                'codigo_sat' => 'TAB',
            ),
            26 => array(
                'id' => 27,
                'nombre' => 'TAMAULIPAS',
                'slug' => 'tamaulipas',
                'codigo_sat' => 'TAM',
            ),
            27 => array(
                'id' => 28,
                'nombre' => 'TLAXCALA',
                'slug' => 'tlaxcala',
                'codigo_sat' => 'TLA',
            ),
            28 => array(
                'id' => 29,
                'nombre' => 'VERACRUZ DE IGNACIO DE LA LLAVE',
                'slug' => 'veracruz-de-ignacio-de-la-llave',
                'codigo_sat' => 'VER',
            ),
            29 => array(
                'id' => 30,
                'nombre' => 'QUINTANA ROO',
                'slug' => 'quintana-roo',
                'codigo_sat' => 'ROO',
            ),
            30 => array(
                'id' => 31,
                'nombre' => 'YUCATÁN',
                'slug' => 'yucatan',
                'codigo_sat' => 'YUC',
            ),
            31 => array(
                'id' => 32,
                'nombre' => 'ZACATECAS',
                'slug' => 'zacatecas',
                'codigo_sat' => 'ZAC',
            ),
        ));

    }
}
