<?php

use Illuminate\Database\Seeder;

class MedicalAppointmentsStates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            'Agendado',
            'Pendiente',
            'En Curso',
            'Finalizada'
        ];
        foreach ($states as $state)
        {
            \App\Models\Medical\MedicalAppointmentState::create(['name' => $state]);
        }
    }
}
