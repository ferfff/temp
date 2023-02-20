<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Rol::create(['name' => 'Administrador']);
        $operador = Rol::create(['name' => 'Operador']);
        $gastos = Rol::create(['name' => 'Gastos']);

        Permiso::create([
            'name' => 'home.index',
            'description' => 'Ver Dashboard',
            'help' => 'Este permiso te permite ver el Dashboard.',
            'modulo_id' => 1,
        ])->syncRoles([$admin, $operador]);

        Permiso::create([
            'name' => 'usuarios.index',
            'description' => 'Ver Usuarios',
            'help' => 'Este permiso te permite acceder al modulo de usuarios pero solo podras consultar la informacion.',
            'modulo_id' => 2,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'usuarios.store',
            'description' => 'Agregar Usuarios',
            'help' => 'Este permiso te permite dar de alta nuevos usuarios.',
            'modulo_id' => 2,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'usuarios.update',
            'description' => 'Editar Usuarios',
            'help' => 'Este permiso te permite modificar los usuarios ya existentes.',
            'modulo_id' => 2,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'usuarios.destroy',
            'description' => 'Deshabilitar Usuarios',
            'help' => 'Este permiso te permite dar de baja temporal a usuarios ya creados.',
            'modulo_id' => 2,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'roles.index',
            'description' => 'Ver Rol',
            'help' => 'Este permiso te permite acceder al modulo de roles pero solo podras consultar la informacion.',
            'modulo_id' => 3,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'roles.store',
            'description' => 'Agregar Rol',
            'help' => 'Este permiso te permite dar de alta nuevos roles y asignarles los permisos que requieran.',
            'modulo_id' => 3,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'roles.update',
            'description' => 'Editar Rol',
            'help' => 'Este permiso te permite modificar el nombre del rol como los permisos que contenga',
            'modulo_id' => 3,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'estados.index',
            'description' => 'Ver Estado',
            'help' => 'Este permiso te permite acceder al modulo de estados pero solo podras consultar la informacion.',
            'modulo_id' => 4,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'estados.store',
            'description' => 'Agregar Estado',
            'help' => 'Este permiso te permite dar de alta nuevos estados.',
            'modulo_id' => 4,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'estados.update',
            'description' => 'Editar Estado',
            'help' => 'Este permiso te permite modificar los estados ya existentes.',
            'modulo_id' => 4,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'municipios.index',
            'description' => 'Ver Municipios',
            'help' => 'Este permiso te permite acceder al modulo de municipios pero solo podras consultar la informacion.',
            'modulo_id' => 5,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'municipios.store',
            'description' => 'Agregar Municipios',
            'help' => 'Este permiso te permite dar de alta nuevos municipios.',
            'modulo_id' => 5,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'municipios.update',
            'description' => 'Editar Municipios',
            'help' => 'Este permiso te permite modificar los municipios ya existentes.',
            'modulo_id' => 5,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'codigos-postales.index',
            'description' => 'Ver Codigos Postales',
            'help' => 'Este permiso te permite acceder al modulo de codigos postales pero solo podras consultar la informacion.',
            'modulo_id' => 6,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'codigos-postales.store',
            'description' => 'Agregar Codigos Postales',
            'help' => 'Este permiso te permite dar de alta nuevos codigos postales.',
            'modulo_id' => 6,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'codigos-postales.update',
            'description' => 'Editar Codigos Postales',
            'help' => 'Este permiso te permite modificar los codigos postales ya existentes.',
            'modulo_id' => 6,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'colonias.index',
            'description' => 'Ver Colonias',
            'help' => 'Este permiso te permite acceder al modulo de colonias pero solo podras consultar la informacion.',
            'modulo_id' => 7,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'colonias.store',
            'description' => 'Agregar Colonias',
            'help' => 'Este permiso te permite dar de alta nuevas colonias.',
            'modulo_id' => 7,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'colonias.update',
            'description' => 'Editar Colonias',
            'help' => 'Este permiso te permite modificar las colonias ya existentes.',
            'modulo_id' => 7,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'principal.index',
            'description' => 'Ver Banner y Footer',
            'help' => 'Este permiso te permite acceder al modulo de Banner y Footer pero solo podras consultar la informacion.',
            'modulo_id' => 8,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'principal.store',
            'description' => 'Agregar Banner y Footer',
            'help' => 'Este permiso te permite dar de alta el Banner y Footer.',
            'modulo_id' => 8,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'principal.update',
            'description' => 'Editar Banner y Footer',
            'help' => 'Este permiso te permite modificar el Banner y Footer.',
            'modulo_id' => 8,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'clientes.index',
            'description' => 'Ver Clientes',
            'help' => 'Este permiso te permite acceder al modulo de clientes pero solo podras consultar la informacion.',
            'modulo_id' => 9,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'clientes.store',
            'description' => 'Agregar Clientes',
            'help' => 'Este permiso te permite dar de alta nuevos clientes.',
            'modulo_id' => 9,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'clientes.update',
            'description' => 'Editar Clientes',
            'help' => 'Este permiso te permite modificar los clientes ya existentes.',
            'modulo_id' => 9,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'clientes.destroy',
            'description' => 'Deshabilitar Clientes',
            'help' => 'Este permiso te permite dar de baja temporal a clientes ya creados.',
            'modulo_id' => 9,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'definicion-documentos.index',
            'description' => 'Ver Definicion de documentos',
            'help' => 'Este permiso te permite acceder al modulo de Definicion de documentos pero solo podras consultar la informacion.',
            'modulo_id' => 10,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'definicion-documentos.store',
            'description' => 'Agregar documentos',
            'help' => 'Este permiso te permite dar de alta nuevos documentos.',
            'modulo_id' => 10,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'definicion-documentos.update',
            'description' => 'Editar documentos',
            'help' => 'Este permiso te permite modificar los documentos ya existentes.',
            'modulo_id' => 10,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'definicion-documentos.destroy',
            'description' => 'Deshabilitar documentos',
            'help' => 'Este permiso te permite dar de baja temporal a documentos ya creados.',
            'modulo_id' => 10,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'contratos.index',
            'description' => 'Ver Contratos',
            'help' => 'Este permiso te permite acceder al modulo de contratos pero solo podras consultar la informacion.',
            'modulo_id' => 11,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'contratos.store',
            'description' => 'Agregar Contratos',
            'help' => 'Este permiso te permite dar de alta nuevos contratos.',
            'modulo_id' => 11,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'contratos.update',
            'description' => 'Editar Contratos',
            'help' => 'Este permiso te permite modificar los contratos ya existentes.',
            'modulo_id' => 11,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'contratos.destroy',
            'description' => 'Deshabilitar Contratos',
            'help' => 'Este permiso te permite dar de baja temporal a contratos ya creados.',
            'modulo_id' => 11,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'expedientes.index',
            'description' => 'Ver Expedientes',
            'help' => 'Este permiso te permite acceder al modulo de expedientes pero solo podras consultar la informacion.',
            'modulo_id' => 12,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'expedientes.store',
            'description' => 'Agregar Expediente',
            'help' => 'Este permiso te permite agregar documentos al expediente.',
            'modulo_id' => 12,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'expedientes.update',
            'description' => 'Editar Expediente',
            'help' => 'Este permiso te permite cambiar el estado de los documentos del expedientes.',
            'modulo_id' => 12,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'expedientes.aprobar',
            'description' => 'Aprobar Documento',
            'help' => 'Este permiso te permite dar por valido un documento del expediente o rechazarlo.',
            'modulo_id' => 12,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'expedientes.destroy',
            'description' => 'Deshabilitar Expediente',
            'help' => 'Este permiso te permite dar de baja documentos del expediente ya creado.',
            'modulo_id' => 12,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'estimaciones.index',
            'description' => 'Ver Estimaciones',
            'help' => 'Este permiso te permite acceder al modulo de estimaciones pero solo podras consultar la informacion.',
            'modulo_id' => 13,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'estimaciones.store',
            'description' => 'Agregar Estimacion',
            'help' => 'Este permiso te permite agregar estimaciones.',
            'modulo_id' => 13,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'estimaciones.update',
            'description' => 'Editar Estimacion',
            'help' => 'Este permiso te permite modificar las estimaciones.',
            'modulo_id' => 13,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'estimaciones.responsable',
            'description' => 'Subir los documentos de recoleccion',
            'help' => 'Este permiso te permite subir los documentos de recoleccion.',
            'modulo_id' => 13,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'estimaciones.aprobar',
            'description' => 'Revisar Estimacion',
            'help' => 'Este permiso te permite Aprobar o regresar estimaciones.',
            'modulo_id' => 13,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'estimaciones.cliente',
            'description' => 'Enviar estimacion al cliente',
            'help' => 'Este permiso te permite enviar estimacion al cliente.',
            'modulo_id' => 13,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'estimaciones.destroy',
            'description' => 'Deshabilitar Estimacion',
            'help' => 'Este permiso te permite dar de baja documentos del estimaciones ya creadas.',
            'modulo_id' => 13,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'jornales.index',
            'description' => 'Ver Jornales',
            'help' => 'Este permiso te permite acceder al modulo de jornales pero solo podras consultar la informacion.',
            'modulo_id' => 14,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'jornales.store',
            'description' => 'Agregar Jornales',
            'help' => 'Este permiso te permite agregar jornales.',
            'modulo_id' => 14,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'jornales.update',
            'description' => 'Editar Jornales',
            'help' => 'Este permiso te permite modificar jornales.',
            'modulo_id' => 14,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'obras-extras.index',
            'description' => 'Ver Obras Extras',
            'help' => 'Este permiso te permite acceder al modulo de obras extras pero solo podras consultar la informacion.',
            'modulo_id' => 15,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'obras-extras.store',
            'description' => 'Agregar Obras Extras',
            'help' => 'Este permiso te permite agregar obras extras.',
            'modulo_id' => 15,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'obras-extras.update',
            'description' => 'Editar Obras Extras',
            'help' => 'Este permiso te permite modificar obras extras.',
            'modulo_id' => 15,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'obras-extras.destroy',
            'description' => 'Deshabilitar Obras Extras',
            'help' => 'Este permiso te permite dar de baja temporal obras extras.',
            'modulo_id' => 15,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'registros-patronales.index',
            'description' => 'Ver Registros Patronales',
            'help' => 'Este permiso te permite acceder al modulo de Registros patronales pero solo podras consultar la informacion.',
            'modulo_id' => 16,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'registros-patronales.store',
            'description' => 'Agregar Registros Patronales',
            'help' => 'Este permiso te permite agregar registros patronales.',
            'modulo_id' => 16,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'registros-patronales.update',
            'description' => 'Editar Registros Patronales',
            'help' => 'Este permiso te permite modificar registros patronales.',
            'modulo_id' => 16,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'obras.index',
            'description' => 'Ver Obras',
            'help' => 'Este permiso te permite acceder al modulo de obras pero solo podras consultar la informacion.',
            'modulo_id' => 17,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'obras.store',
            'description' => 'Agregar Obras',
            'help' => 'Este permiso te permite agregar obras.',
            'modulo_id' => 17,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'obras.update',
            'description' => 'Editar Obras',
            'help' => 'Este permiso te permite modificar obras.',
            'modulo_id' => 17,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'factores.index',
            'description' => 'Ver Factores',
            'help' => 'Este permiso te permite acceder al modulo de factores pero solo podras consultar la informacion.',
            'modulo_id' => 18,
        ])->syncRoles([$admin, $operador]);
        Permiso::create([
            'name' => 'factores.store',
            'description' => 'Agregar Factores',
            'help' => 'Este permiso te permite agregar factores.',
            'modulo_id' => 18,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'factores.update',
            'description' => 'Editar Factores',
            'help' => 'Este permiso te permite modificar obras.',
            'modulo_id' => 18,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'auditorias.index',
            'description' => 'Auditoria General',
            'help' => 'Este permiso te permite acceder al modulo de auditoria.',
            'modulo_id' => 19,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'auditorias.show',
            'description' => 'Auditoria Detalles',
            'help' => 'Este permiso te permite ver el detalle de cada movimiento realizado en el sistema.',
            'modulo_id' => 19,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'logs',
            'description' => 'Auditoria de los errores del sistema',
            'help' => 'Este permiso te permite ver el listado de errores del sistema.',
            'modulo_id' => 19,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'parametros.index',
            'description' => 'Ver Parametros',
            'help' => 'Este permiso te permite acceder al modulo de parametros los cuales afectan a todo el sistema.',
            'modulo_id' => 20,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'parametros.update',
            'description' => 'Modificar Paramteros',
            'help' => 'Este permiso te permite modificar los parametros del sistema.',
            'modulo_id' => 20,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'generales.index',
            'description' => 'Ver Configuracion General',
            'help' => 'Este permiso te permite acceder al modulo de configuraciones generales los cuales afectan a todo el sistema.',
            'modulo_id' => 21,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'generales.update',
            'description' => 'Modificar Configuracion General',
            'help' => 'Este permiso te permite modificar las configuraciones generales.',
            'modulo_id' => 21,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'presupuestos.index',
            'description' => 'Ver Presupuesto',
            'help' => 'Este permiso te permite acceder al modulo de presupuestos.',
            'modulo_id' => 22,
        ])->syncRoles([$admin, $gastos]);
        Permiso::create([
            'name' => 'presupuestos.store',
            'description' => 'Agregar Presupuesto',
            'help' => 'Este permiso te permite agregar presupuestos.',
            'modulo_id' => 22,
        ])->syncRoles([$admin, $gastos]);
        Permiso::create([
            'name' => 'presupuestos.update',
            'description' => 'Modificar Presupuesto',
            'help' => 'Este permiso te permite modificar presupuestos.',
            'modulo_id' => 22,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'presupuestos.aprobar',
            'description' => 'Aprobar Presupuesto',
            'help' => 'Este permiso te permite Aprobar o no los presupuestos.',
            'modulo_id' => 22,
        ])->syncRoles([$admin, $gastos]);

        Permiso::create([
            'name' => 'sirocs.index',
            'description' => 'Ver Siroc',
            'help' => 'Este permiso te permite acceder al modulo de siroc.',
            'modulo_id' => 23,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'sirocs.store',
            'description' => 'Agregar Siroc',
            'help' => 'Este permiso te permite agregar siroc.',
            'modulo_id' => 23,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'sirocs.update',
            'description' => 'Modificar Siroc',
            'help' => 'Este permiso te permite modificar siroc.',
            'modulo_id' => 23,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'plantilla-correos.index',
            'description' => 'Ver Plantilla',
            'help' => 'Este permiso te permite acceder al modulo de plantilla de correos.',
            'modulo_id' => 24,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'inbox.index',
            'description' => 'Ver Correo',
            'help' => 'Este permiso te permite acceder al modulo de correos para masi ver los correos enviados y recibidos generados en el sistema.',
            'modulo_id' => 24,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'post-ventas.index',
            'description' => 'Ver Post Ventas',
            'help' => 'Este permiso te permite acceder al modulo de post venta de correos.',
            'modulo_id' => 25,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'post-ventas.store',
            'description' => 'Agregar Post Venta',
            'help' => 'Este permiso te permite agregar una post venta.',
            'modulo_id' => 25,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'post-ventas.update',
            'description' => 'Modificar Post Venta',
            'help' => 'Este permiso te permite modificar una post venta.',
            'modulo_id' => 25,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'nota-de-credito.index',
            'description' => 'Ver Notas de Credito',
            'help' => 'Este permiso te permite acceder al modulo de notas de credito.',
            'modulo_id' => 26,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'nota-de-credito.store',
            'description' => 'Agregar Notas de Credito',
            'help' => 'Este permiso te permite agregar una nueva nota de credito.',
            'modulo_id' => 26,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'nota-de-credito.destroy',
            'description' => 'Eliminar Notas de Credito',
            'help' => 'Este permiso te permite dar de baja notas de credito ya creadas.',
            'modulo_id' => 26,
        ])->syncRoles([$admin]);

        Permiso::create([
            'name' => 'control-de-obras.index',
            'description' => 'Ver Control de obra',
            'help' => 'Este permiso te permite acceder al modulo de control de obra.',
            'modulo_id' => 27,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'control-de-obras.store',
            'description' => 'Modificar Partidas',
            'help' => '',
            'modulo_id' => 27,
        ])->syncRoles([$admin]);
        Permiso::create([
            'name' => 'destajo-de-obras.store',
            'description' => 'Modificar Destajo de obra',
            'help' => 'Este permiso te permite agregar partidas para realizar los destajos de la obra.',
            'modulo_id' => 27,
        ])->syncRoles([$admin]);
    }
}
