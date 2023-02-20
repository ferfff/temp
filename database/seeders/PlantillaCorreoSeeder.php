<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlantillaCorreoSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('plantilla_correos')->insert(array(
            0 => array(
                'id' => 1,
                'nombre' => 'Alta Presupuestos',
                'img' => 'img/logo2.png',
                'correo' => '&lt;meta charset=&quot;UTF-8&quot;&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;ie=edge&quot;&gt;
&lt;table style=&quot;width:100.0%;background:#edf2f7&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:18.75pt 0cm 18.75pt 0cm&quot;&gt;
&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:center&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/home&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=jornales.mustango.com.mx/admin&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw0Qep-T-cs07RK7hzlcfhAE&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.5pt;color:#3d4852;text-decoration:none&quot;&gt;
&lt;img src=&quot;http://jornales.mustango.com.mx/img/logo2.png&quot;&gt;
&lt;/span&gt;&lt;/b&gt;&lt;/a&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;width:100.0%;border-top:solid #edf2f7 1.0pt;border-left:none;border-bottom:solid #edf2f7 1.0pt;border-right:none;background:#edf2f7;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot; width=&quot;100%&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;background:white;box-sizing:border-box;border-radius:2px&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box;max-width:100vw&quot;&gt;
&lt;h1 style=&quot;margin-top:0cm;box-sizing:border-box&quot;&gt;&lt;span style=&quot;font-size:13.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#3d4852&quot;&gt;&iexcl;Hola {@usuario}!&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/h1&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Un
nuevo Presupuesto se ha registrado.&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;&lt;p&gt;{@descripcion}&lt;/p&gt;
&lt;p&gt;&lt;/p&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;box-sizing:border-box&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p class=&quot;MsoNormal&quot;&gt;
&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:white;border:solid #2d3748 6.0pt;padding:0cm;background:#2d3748;text-decoration:none&quot;&gt;Puedes
visitarlo
dando
click
aqu&iacute;.&lt;/span&gt;&lt;/a&gt;
&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;&lt;br&gt;&lt;/p&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Saludos,&lt;br&gt;Jornales&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;table style=&quot;width:100.0%;border:none;border-top:solid #e8e5ef 1.0pt;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;1&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;border:none;padding:18.75pt 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:10.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;Si
tiene problemas para hacer clic en
&#039;Puedes visitarlo dando clic aqu&iacute;&#039;.
bot&oacute;n, copie y pegue la URL a
continuaci&oacute;n en su navegador web:
&lt;span class=&quot;m_-5040165421015974043break-all&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:#3869d4&quot;&gt;http://jornales.mustango.com.&lt;wbr&gt;mx/admin/presupuestos/{@id}/edit&lt;/span&gt;&lt;/a&gt;&lt;br&gt;&lt;br&gt;&lt;/span&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;box-sizing:border-box&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;text-align:center;line-height:18.0pt;box-sizing:border-box&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:9.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#b0adc5&quot;&gt;&copy;
2022 Jornales. Todos los derechos
reservados.&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;',
                'variables' => '{@id},{@descripcion},{@usuario}',
                'created_at' => '2022-08-29 18:15:40',
                'updated_at' => '2022-09-05 11:19:32',
            ),
            1 => array(
                'id' => 2,
                'nombre' => 'Siroc',
                'img' => 'img/logo2.png',
                'correo' => '&lt;meta charset=&quot;UTF-8&quot;&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;ie=edge&quot;&gt;
&lt;table style=&quot;width:100.0%;background:#edf2f7&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:18.75pt 0cm 18.75pt 0cm&quot;&gt;
&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:center&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/home&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=jornales.mustango.com.mx/admin&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw0Qep-T-cs07RK7hzlcfhAE&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.5pt;color:#3d4852;text-decoration:none&quot;&gt;
&lt;img src=&quot;http://jornales.mustango.com.mx/img/logo2.png&quot;&gt;
&lt;/span&gt;&lt;/b&gt;&lt;/a&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;width:100.0%;border-top:solid #edf2f7 1.0pt;border-left:none;border-bottom:solid #edf2f7 1.0pt;border-right:none;background:#edf2f7;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot; width=&quot;100%&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;background:white;box-sizing:border-box;border-radius:2px&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box;max-width:100vw&quot;&gt;
&lt;h1 style=&quot;margin-top:0cm;box-sizing:border-box&quot;&gt;&lt;span style=&quot;font-size:13.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#3d4852&quot;&gt;&iexcl;Hola {@usuario}!&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/h1&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Una nueva alta de siroc se a registrado.&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;/span&gt;
&lt;/p&gt;&lt;p&gt;{@descripcion}&lt;/p&gt;
&lt;p&gt;&lt;/p&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;box-sizing:border-box&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p class=&quot;MsoNormal&quot;&gt;
&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:white;border:solid #2d3748 6.0pt;padding:0cm;background:#2d3748;text-decoration:none&quot;&gt;Puedes
visitarlo
dando
click
aqui.&lt;/span&gt;&lt;/a&gt;
&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Gracias
por usar nuestra aplicacion!&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Saludos,&lt;br&gt;Jornales&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;table style=&quot;width:100.0%;border:none;border-top:solid #e8e5ef 1.0pt;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;1&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;border:none;padding:18.75pt 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:10.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;Si
tiene problemas para hacer clic en
&#039;Puedes visitarlo dando clic aqu&iacute;&#039;.
bot&oacute;n, copie y pegue la URL a
continuaci&oacute;n en su navegador web:
&lt;span class=&quot;m_-5040165421015974043break-all&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:#3869d4&quot;&gt;http://jornales.mustango.com.&lt;wbr&gt;mx/admin/presupuestos/{@id}/edit&lt;/span&gt;&lt;/a&gt;&lt;/span&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;box-sizing:border-box&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;text-align:center;line-height:18.0pt;box-sizing:border-box&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:9.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#b0adc5&quot;&gt;&copy;
2022 Jornales. Todos los derechos
reservados.&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;',
                'variables' => '{@id},{@usuario},{@descripcion}',
                'created_at' => '2022-09-05 10:14:44',
                'updated_at' => '2022-09-05 10:14:44',
            ),
            2 => array(
                'id' => 3,
                'nombre' => 'Presupuesto Autorizado',
                'img' => 'img/logo2.png',
                'correo' => '&lt;meta charset=&quot;UTF-8&quot;&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;ie=edge&quot;&gt;
&lt;table style=&quot;width:100.0%;background:#edf2f7&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:18.75pt 0cm 18.75pt 0cm&quot;&gt;
&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:center&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/home&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=jornales.mustango.com.mx/admin&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw0Qep-T-cs07RK7hzlcfhAE&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.5pt;color:#3d4852;text-decoration:none&quot;&gt;
&lt;img src=&quot;http://jornales.mustango.com.mx/img/logo2.png&quot;&gt;
&lt;/span&gt;&lt;/b&gt;&lt;/a&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;width:100.0%;border-top:solid #edf2f7 1.0pt;border-left:none;border-bottom:solid #edf2f7 1.0pt;border-right:none;background:#edf2f7;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot; width=&quot;100%&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;background:white;box-sizing:border-box;border-radius:2px&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box;max-width:100vw&quot;&gt;
&lt;h1 style=&quot;margin-top:0cm;box-sizing:border-box&quot;&gt;&lt;span style=&quot;font-size:13.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#3d4852&quot;&gt;&iexcl;Hola {@usuario}!&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/h1&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Su presupuesto fue autorizado.&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;/span&gt;
&lt;/p&gt;&lt;p&gt;{@descripcion}&lt;/p&gt;
&lt;p&gt;&lt;/p&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;box-sizing:border-box&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p class=&quot;MsoNormal&quot;&gt;
&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:white;border:solid #2d3748 6.0pt;padding:0cm;background:#2d3748;text-decoration:none&quot;&gt;Puedes
visitarlo
dando
click
aqu&iacute;.&lt;/span&gt;&lt;/a&gt;
&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;&lt;br&gt;&lt;/p&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Saludos,&lt;br&gt;Jornales&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;table style=&quot;width:100.0%;border:none;border-top:solid #e8e5ef 1.0pt;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;1&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;border:none;padding:18.75pt 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:10.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;Si
tiene problemas para hacer clic en
&#039;Puedes visitarlo dando clic aqu&iacute;&#039;.
bot&oacute;n, copie y pegue la URL a
continuaci&oacute;n en su navegador web:
&lt;span class=&quot;m_-5040165421015974043break-all&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:#3869d4&quot;&gt;http://jornales.mustango.com.&lt;wbr&gt;mx/admin/presupuestos/{@id}/edit&lt;/span&gt;&lt;/a&gt;&lt;br&gt;&lt;br&gt;&lt;/span&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;box-sizing:border-box&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;text-align:center;line-height:18.0pt;box-sizing:border-box&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:9.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#b0adc5&quot;&gt;&copy;
2022 Jornales. Todos los derechos
reservados.&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;',
                'variables' => '{@id},{@descripcion},{@usuario}',
                'created_at' => '2022-08-29 18:15:40',
                'updated_at' => '2022-09-05 12:50:25',
            ),
            3 => array(
                'id' => 4,
                'nombre' => 'Jornales',
                'img' => 'img/logo2.png',
                'correo' => '&lt;meta charset=&quot;UTF-8&quot;&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;ie=edge&quot;&gt;
&lt;table style=&quot;width:100.0%;background:#edf2f7&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:18.75pt 0cm 18.75pt 0cm&quot;&gt;
&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:center&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/home&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=jornales.mustango.com.mx/admin&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw0Qep-T-cs07RK7hzlcfhAE&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.5pt;color:#3d4852;text-decoration:none&quot;&gt;
&lt;img src=&quot;http://jornales.mustango.com.mx/img/logo2.png&quot;&gt;
&lt;/span&gt;&lt;/b&gt;&lt;/a&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;width:100.0%;border-top:solid #edf2f7 1.0pt;border-left:none;border-bottom:solid #edf2f7 1.0pt;border-right:none;background:#edf2f7;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot; width=&quot;100%&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;background:white;box-sizing:border-box;border-radius:2px&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box;max-width:100vw&quot;&gt;
&lt;h1 style=&quot;margin-top:0cm;box-sizing:border-box&quot;&gt;&lt;span style=&quot;font-size:13.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#3d4852&quot;&gt;&iexcl;Hola {@usuario}!&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/h1&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Un
nuevo Jornal se ha registrado.&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;/span&gt;
&lt;/p&gt;&lt;p&gt;{@descripcion}&lt;/p&gt;
&lt;p&gt;&lt;/p&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;box-sizing:border-box&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p class=&quot;MsoNormal&quot;&gt;
&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:white;border:solid #2d3748 6.0pt;padding:0cm;background:#2d3748;text-decoration:none&quot;&gt;Puedes
visitarlo
dando
click
aqu&iacute;.&lt;/span&gt;&lt;/a&gt;
&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;&lt;br&gt;&lt;/p&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Saludos,&lt;br&gt;Jornales&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;table style=&quot;width:100.0%;border:none;border-top:solid #e8e5ef 1.0pt;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;1&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;border:none;padding:18.75pt 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:10.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;Si
tiene problemas para hacer clic en
&#039;Puedes visitarlo dando clic aqu&iacute;&#039;.
bot&oacute;n, copie y pegue la URL a
continuaci&oacute;n en su navegador web:
&lt;span class=&quot;m_-5040165421015974043break-all&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:#3869d4&quot;&gt;http://jornales.mustango.com.&lt;wbr&gt;mx/admin/presupuestos/{@id}/edit&lt;/span&gt;&lt;/a&gt;&lt;br&gt;&lt;br&gt;&lt;/span&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;box-sizing:border-box&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;text-align:center;line-height:18.0pt;box-sizing:border-box&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:9.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#b0adc5&quot;&gt;&copy;
2022 Jornales. Todos los derechos
reservados.&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;',
                'variables' => '{@id},{@descripcion},{@usuario}',
                'created_at' => '2022-08-29 18:15:40',
                'updated_at' => '2022-09-05 12:50:51',
            ),
            4 => array(
                'id' => 5,
                'nombre' => 'Estimaciones',
                'img' => 'img/logo2.png',
                'correo' => '&lt;meta charset=&quot;UTF-8&quot;&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;ie=edge&quot;&gt;
&lt;table style=&quot;width:100.0%;background:#edf2f7&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:18.75pt 0cm 18.75pt 0cm&quot;&gt;
&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:center&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/home&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=jornales.mustango.com.mx/admin&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw0Qep-T-cs07RK7hzlcfhAE&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.5pt;color:#3d4852;text-decoration:none&quot;&gt;
&lt;img src=&quot;http://jornales.mustango.com.mx/img/logo2.png&quot;&gt;
&lt;/span&gt;&lt;/b&gt;&lt;/a&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;width:100.0%;border-top:solid #edf2f7 1.0pt;border-left:none;border-bottom:solid #edf2f7 1.0pt;border-right:none;background:#edf2f7;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot; width=&quot;100%&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;background:white;box-sizing:border-box;border-radius:2px&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box;max-width:100vw&quot;&gt;
&lt;h1 style=&quot;margin-top:0cm;box-sizing:border-box&quot;&gt;&lt;span style=&quot;font-size:13.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#3d4852&quot;&gt;&iexcl;Hola {@usuario}!&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/h1&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Una
nueva Estimacion se ha registrado.&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;&lt;p&gt;{@descripcion}&lt;/p&gt;
&lt;p&gt;&lt;/p&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;box-sizing:border-box&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p class=&quot;MsoNormal&quot;&gt;
&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:white;border:solid #2d3748 6.0pt;padding:0cm;background:#2d3748;text-decoration:none&quot;&gt;Puedes
visitarlo
dando
click
aqu&iacute;.&lt;/span&gt;&lt;/a&gt;
&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;&lt;br&gt;&lt;/p&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Saludos,&lt;br&gt;Jornales&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;table style=&quot;width:100.0%;border:none;border-top:solid #e8e5ef 1.0pt;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;1&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;border:none;padding:18.75pt 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:10.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;Si
tiene problemas para hacer clic en
&#039;Puedes visitarlo dando clic aqu&iacute;&#039;.
bot&oacute;n, copie y pegue la URL a
continuaci&oacute;n en su navegador web:
&lt;span class=&quot;m_-5040165421015974043break-all&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:#3869d4&quot;&gt;http://jornales.mustango.com.&lt;wbr&gt;mx/admin/presupuestos/{@id}/edit&lt;/span&gt;&lt;/a&gt;&lt;br&gt;&lt;br&gt;&lt;/span&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;box-sizing:border-box&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;text-align:center;line-height:18.0pt;box-sizing:border-box&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:9.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#b0adc5&quot;&gt;&copy;
2022 Jornales. Todos los derechos
reservados.&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;',
                'variables' => '{@id},{@descripcion},{@usuario}',
                'created_at' => '2022-08-29 18:15:40',
                'updated_at' => '2022-09-05 12:51:08',
            ),
            5 => array(
                'id' => 6,
                'nombre' => 'Presupuesto Rechazado',
                'img' => 'img/logo2.png',
                'correo' => '&lt;meta charset=&quot;UTF-8&quot;&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;ie=edge&quot;&gt;
&lt;table style=&quot;width:100.0%;background:#edf2f7&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:18.75pt 0cm 18.75pt 0cm&quot;&gt;
&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:center&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/home&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=jornales.mustango.com.mx/admin&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw0Qep-T-cs07RK7hzlcfhAE&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.5pt;color:#3d4852;text-decoration:none&quot;&gt;
&lt;img src=&quot;http://jornales.mustango.com.mx/img/logo2.png&quot;&gt;
&lt;/span&gt;&lt;/b&gt;&lt;/a&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;width:100.0%;border-top:solid #edf2f7 1.0pt;border-left:none;border-bottom:solid #edf2f7 1.0pt;border-right:none;background:#edf2f7;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot; width=&quot;100%&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;background:white;box-sizing:border-box;border-radius:2px&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box;max-width:100vw&quot;&gt;
&lt;h1 style=&quot;margin-top:0cm;box-sizing:border-box&quot;&gt;&lt;span style=&quot;font-size:13.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#3d4852&quot;&gt;&iexcl;Hola {@usuario}!&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/h1&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Su presupuesto fue rechazado, corrija la informacion.&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;/span&gt;
&lt;/p&gt;&lt;p&gt;{@descripcion}&lt;/p&gt;
&lt;p&gt;&lt;/p&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;box-sizing:border-box&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p class=&quot;MsoNormal&quot;&gt;
&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:white;border:solid #2d3748 6.0pt;padding:0cm;background:#2d3748;text-decoration:none&quot;&gt;Puedes
visitarlo
dando
click
aqu&iacute;.&lt;/span&gt;&lt;/a&gt;
&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;&lt;br&gt;&lt;/p&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Saludos,&lt;br&gt;Jornales&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;table style=&quot;width:100.0%;border:none;border-top:solid #e8e5ef 1.0pt;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;1&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;border:none;padding:18.75pt 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:10.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;Si
tiene problemas para hacer clic en
&#039;Puedes visitarlo dando clic aqu&iacute;&#039;.
bot&oacute;n, copie y pegue la URL a
continuaci&oacute;n en su navegador web:
&lt;span class=&quot;m_-5040165421015974043break-all&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:#3869d4&quot;&gt;http://jornales.mustango.com.&lt;wbr&gt;mx/admin/presupuestos/{@id}/edit&lt;/span&gt;&lt;/a&gt;&lt;br&gt;&lt;br&gt;&lt;/span&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;box-sizing:border-box&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;text-align:center;line-height:18.0pt;box-sizing:border-box&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:9.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#b0adc5&quot;&gt;&copy;
2022 Jornales. Todos los derechos
reservados.&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;',
                'variables' => '{@id},{@descripcion},{@usuario}',
                'created_at' => '2022-09-06 09:17:10',
                'updated_at' => '2022-09-06 09:17:10',
            ),
            6 => array(
                'id' => 7,
                'nombre' => 'Presupuesto Modificado',
                'img' => 'img/logo2.png',
                'correo' => '&lt;meta charset=&quot;UTF-8&quot;&gt;
&lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1.0&quot;&gt;
&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;ie=edge&quot;&gt;
&lt;table style=&quot;width:100.0%;background:#edf2f7&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:18.75pt 0cm 18.75pt 0cm&quot;&gt;
&lt;p class=&quot;MsoNormal&quot; style=&quot;text-align:center&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/home&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=jornales.mustango.com.mx/admin&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw0Qep-T-cs07RK7hzlcfhAE&quot;&gt;&lt;b&gt;&lt;span style=&quot;font-size:14.5pt;color:#3d4852;text-decoration:none&quot;&gt;
&lt;img src=&quot;http://jornales.mustango.com.mx/img/logo2.png&quot;&gt;
&lt;/span&gt;&lt;/b&gt;&lt;/a&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;width:100.0%;border-top:solid #edf2f7 1.0pt;border-left:none;border-bottom:solid #edf2f7 1.0pt;border-right:none;background:#edf2f7;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot; width=&quot;100%&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;background:white;box-sizing:border-box;border-radius:2px&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box;max-width:100vw&quot;&gt;
&lt;h1 style=&quot;margin-top:0cm;box-sizing:border-box&quot;&gt;&lt;span style=&quot;font-size:13.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#3d4852&quot;&gt;&iexcl;Hola {@usuario}!&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/h1&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Su presupuesto fue modificado, corriga la informacion.&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;/span&gt;
&lt;/p&gt;&lt;p&gt;{@descripcion}&lt;/p&gt;
&lt;p&gt;&lt;/p&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:100.0%;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;box-sizing:border-box&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p class=&quot;MsoNormal&quot;&gt;
&lt;span style=&quot;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:white;border:solid #2d3748 6.0pt;padding:0cm;background:#2d3748;text-decoration:none&quot;&gt;Puedes
visitarlo
dando
click
aqu&iacute;.&lt;/span&gt;&lt;/a&gt;
&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;&lt;br&gt;&lt;/p&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:black&quot;&gt;Saludos,&lt;br&gt;Jornales&lt;/span&gt;&lt;span style=&quot;font-size:12.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;table style=&quot;width:100.0%;border:none;border-top:solid #e8e5ef 1.0pt;box-sizing:border-box&quot; width=&quot;100%&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;1&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;border:none;padding:18.75pt 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;line-height:18.0pt;box-sizing:border-box&quot;&gt;
&lt;span style=&quot;font-size:10.5pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif&quot;&gt;Si
tiene problemas para hacer clic en
&#039;Puedes visitarlo dando clic aqu&iacute;&#039;.
bot&oacute;n, copie y pegue la URL a
continuaci&oacute;n en su navegador web:
&lt;span class=&quot;m_-5040165421015974043break-all&quot;&gt;&lt;a href=&quot;http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&quot; target=&quot;_blank&quot; data-saferedirecturl=&quot;https://www.google.com/url?q=http://jornales.mustango.com.mx/admin/presupuestos/{@id}/edit&amp;amp;source=gmail&amp;amp;ust=1660866227941000&amp;amp;usg=AOvVaw2bdhSzg8CtSEPY7Prfg-ZH&quot;&gt;&lt;span style=&quot;color:#3869d4&quot;&gt;http://jornales.mustango.com.&lt;wbr&gt;mx/admin/presupuestos/{@id}/edit&lt;/span&gt;&lt;/a&gt;&lt;br&gt;&lt;br&gt;&lt;/span&gt;&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;
&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:0cm 0cm 0cm 0cm;box-sizing:border-box&quot;&gt;
&lt;div align=&quot;center&quot;&gt;
&lt;table style=&quot;width:427.5pt;box-sizing:border-box&quot; width=&quot;570&quot; cellspacing=&quot;0&quot; cellpadding=&quot;0&quot; border=&quot;0&quot;&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td style=&quot;padding:24.0pt 24.0pt 24.0pt 24.0pt;box-sizing:border-box&quot;&gt;
&lt;p style=&quot;margin-top:0cm;text-align:center;line-height:18.0pt;box-sizing:border-box&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:9.0pt;font-family:&amp;quot;Segoe UI&amp;quot;,sans-serif;color:#b0adc5&quot;&gt;&copy;
2022 Jornales. Todos los derechos
reservados.&lt;u&gt;&lt;/u&gt;&lt;u&gt;&lt;/u&gt;&lt;/span&gt;&lt;/p&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;',
                'variables' => '{@id},{@descripcion},{@usuario}',
                'created_at' => '2022-09-06 09:17:10',
                'updated_at' => '2022-09-06 09:17:10',
            ),
        ));

    }
}
