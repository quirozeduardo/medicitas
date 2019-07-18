<?php

namespace App\Http\Controllers;

use App\Models\Medical\Doctor;
use App\Models\Medical\DoctorPatient;
use App\Models\Medical\Patient;
use App\Models\Notification;
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
                ->where('doctor_patient.doctor_id',$doctor->id)
                ->where('doctor_patient.accepted',1)->get();

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
    function getMyPatients() {
        $myPatients = null;
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $patientsToAdd = null;

        if ($doctor) {
            $myPatients = Patient::select('users.name', 'patients.id')
                ->join('doctor_patient', 'doctor_patient.patient_id', 'patients.id')
                ->join('users', 'users.id', '=', 'patients.user_id')
                ->where('doctor_patient.doctor_id', $doctor->id)
                ->where('doctor_patient.accepted', 1)->get();

        }
        if ($myPatients !== null) {
            return $myPatients->toJson();
        }
        return json_encode($myPatients);
    }
    public function addPatient($id){
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::where('patient_id',$id)
            ->where('doctor_id',$doctor->id)->first();
        if(!$doctorPatient)
        {
            $patient = Patient::where('id', $id)->first();
            $doctorPatient = new DoctorPatient;
            $doctorPatient->patient_id = $id;
            $doctorPatient->accepted = 0;
            $doctorPatient->doctor_id = $doctor->id;
            $doctorPatient->send_by = Auth::user()->id;
            $doctorPatient->save();

            $notification = new Notification;
            $notification->name = 'El doctor '.$doctor->user->name .' te envio una solicitud';
            $notification->is_seen = false;
            $notification->user_id = $patient->user->id;
            $notification->redirect= 'doctors.index';
            $notification->save();
        }else
        {
            Flash::success('Y se envio la solicitud anteriormente','Mensaje');
        }
        return redirect(route('patients.index'));
    }
    public function rejectPatient($id)
    {
        return $this->changeAccepted($id,2);
    }
    public function acceptPatient($id)
    {
        return $this->changeAccepted($id,1);

    }
    public function changeAccepted($id,$value)
    {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::where('patient_id',$id)
            ->where('doctor_id',$doctor->id)->first();
        if($doctorPatient)
        {
            $doctorPatient->accepted = $value;
            $doctorPatient->save();
        }
        if($value == 1)
        {
            $patient = Patient::where('id',$id)->first();
            $notification = new Notification;
            $notification->name = 'El doctor '.$doctor->user->name .' acepto tu solicitud';
            $notification->is_seen = false;
            $notification->user_id = $patient->user->id;
            $notification->redirect= 'profile.show';
            $notification->redirect_param_1= $doctor->user->id;
            $notification->save();
            Flash::success('Aceptado','Mensaje');
        }
        return redirect(route('patients.index'));
    }
}
