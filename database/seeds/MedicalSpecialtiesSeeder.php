<?php

use Illuminate\Database\Seeder;

class MedicalSpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Alergología',
            'Anestesiología y reanimación',
            'Cardiología',
            'Gastroenterología',
            'Endocrinología',
            'Geriatría',
            'Hematología y hemoterapia',
            'Infectología',
            'Medicina aeroespacial',
            'Medicina del deporte',
            'Medicina del trabajo',
            'Medicina de urgencias',
            'Medicina familiar y comunitaria',
            'Medicina física y rehabilitación',
            'Medicina intensiva',
            'Medicina interna',
            'Medicina legal y forense',
            'Medicina preventiva y salud pública',
            'Medicina veterinaria',
            'Nefrología',
            'Neumología',
            'Neurología',
            'Nutriología',
            'Oftalmología',
            'Oncología médica',
            'Oncología radioterápica',
            'Pediatría',
            'Psiquiatría',
            'Rehabilitación',
            'Reumatología',
            'Toxicología',
            'Urología',
        ];


        foreach ($specialties as $speciality) {
            \App\Models\Medical\MedicalSpeciality::create(['name' => $speciality]);
        }
    }
}
