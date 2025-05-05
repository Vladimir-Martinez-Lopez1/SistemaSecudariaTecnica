<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos =[
            // Permisos para el módulo de Expediente Médico
            'ver-expedienteMedico',
            'crear-expedienteMedico',
            'editar-expedienteMedico',
            'mostrar-expedienteMedico',

            // Permisos para el módulo de Expediente Disciplinario
            'ver-expedienteDisciplinario',
            'crear-expedienteDisciplinario',
            'editar-expedienteDisciplinario',
            'mostrar-expedienteDisciplinario',

            //permisos para el módulo de citatorio
            'ver-citatorio',
            'crear-citatorio',
            'editar-citatorio',
            'mostrar-citatorio',

            // Permisos para el módulo de citatorio General
            'ver-citatorioGeneral',
            'crear-citatorioGeneral',
            'editar-citatorioGeneral',
            'mostrar-citatorioGeneral',

            // Permisos para el módulo de informe de Salud
            'ver-informeSalud',
            'crear-informeSalud',
            'editar-informeSalud',
            'mostrar-informeSalud',

            // Permisos para el módulo de justificante medico
            'ver-justificanteMedico',
            'crear-justificanteMedico',
            'editar-justificanteMedico',
            'mostrar-justificanteMedico',

            // Permisos para el módulo de justificante de retardo Social
            'ver-justificanteRetardoSocial',
            'crear-justificanteRetardoSocial',
            'editar-justificanteRetardoSocial',
            'mostrar-justificanteRetardoSocial',

            // Permisos para el módulo de pase de salida
            'ver-paseSalida',
            'crear-paseSalida',
            'editar-paseSalida',
            'mostrar-paseSalida',

            // Permisos para el módulo de pase de salida social
            'ver-paseSalidaSocial',
            'crear-paseSalidaSocial',
            'editar-paseSalidaSocial',
            'mostrar-paseSalidaSocial',

            // Permisos para el módulo de reporte incidencias
            'ver-reporteIncidencia',
            'crear-reporteIncidencia',
            'editar-reporteIncidencia',
            'mostrar-reporteIncidencia',

            // Permisos para el módulo de suspencion clase
            'ver-suspencionClase',
            'crear-suspencionClase',
            'editar-suspencionClase',
            'mostrar-suspencionClase',
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }

    }
}
