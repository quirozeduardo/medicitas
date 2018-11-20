<?php

namespace App\Http\Controllers;

use App\Models\Medical\Doctor;
use App\Models\Medical\DoctorPatient;
use App\Models\Medical\Patient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myPatients = null;
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $patient = Patient::where('user_id', Auth::user()->id)->first();
        $patientsToAdd = null;

        if ($doctor)
        {
            $patients = Patient::select('patients.user_id','patients.id')
                ->join('doctor_patient','doctor_patient.patient_id','patients.id')
                ->where('doctor_patient.doctor_id',$doctor->id)->get();

            $myPatients = User::whereIn('id',$patients->pluck('user_id'))->get();
            if($patients)
            {
                if($patient)
                {
                    $patientsToAdd = Patient::whereNotIn('id', $patients->pluck('id'))
                        ->where('id', '!=', $patient->id)->get();
                }else {
                    $patientsToAdd = Patient::whereNotIn('id', $patients->pluck('id'))->get();
                }
            }else
            {
                if($patient)
                {
                    $patientsToAdd = Patient::where('id', '!=', $patient->id)->get();
                }else
                {
                    $patientsToAdd = Patient::get();
                }

            }
        }
        return view('patients')
            ->with('users', $myPatients)
            ->with('patients',$patientsToAdd);
    }
    public function addPatient($id){
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::where('patient_id',$id)
            ->where('doctor_id',$doctor->id)->first();
        if(!$doctorPatient)
        {
            $doctorPatient = new DoctorPatient;
            $doctorPatient->patient_id = $id;
            $doctorPatient->doctor_id = $doctor->id;
            $doctorPatient->save();
        }else
        {
            Flash::overlay('Y se envio la solicitud anteriormente','Mensaje');
        }
        return redirect(route('patients.index'));
    }
}
