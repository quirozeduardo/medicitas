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

class DoctorsController extends Controller
{
    public function index()
    {
        $myDoctors = null;
        $doctorsToAdd = null;
        $patient = Patient::where('user_id', Auth::user()->id)->first();
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        if ($patient)
        {
            $doctors = Doctor::select('doctors.user_id','doctors.id')
                ->join('doctor_patient','doctor_patient.doctor_id','doctors.id')
                ->where('doctor_patient.patient_id',$patient->id)
                ->where('doctor_patient.accepted',true)->get();
            $myDoctors = User::whereIn('id',$doctors->pluck('user_id'))->get();
            if($doctors)
            {
                if($doctor)
                {
                    $doctorsToAdd = Doctor::whereNotIn('id',$doctors->pluck('id'))
                        ->where('id', '!=', $doctor->id)->get();
                }else{
                    $doctorsToAdd = Doctor::whereNotIn('id',$doctors->pluck('id'))->get();
                }

            }
            else
            {
                if($doctor)
                {
                    $doctorsToAdd = Doctor::where('id', '!=', $doctor->id)->get();
                }else{
                    $doctorsToAdd = Doctor::get();
                }
            }
        }

        return view('doctors')
            ->with('users', $myDoctors)
            ->with('doctors',$doctorsToAdd);
    }
    public function addDoctor($id)
    {
        $patient = Patient::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::where('doctor_id',$id)
            ->where('patient_id',$patient->id)->first();
        if(!$doctorPatient)
        {
            $doctorPatient = new DoctorPatient;
            $doctorPatient->patient_id = $patient->id;
            $doctorPatient->doctor_id = $id;
            $doctorPatient->send_by_patient = true;
            $doctorPatient->save();
        }else
        {
            Flash::overlay('Y se envio la solicitud anteriormente','Mensaje');
        }
        return redirect(route('doctors.index'));
    }
    public function rejectDoctor($id)
    {
        return $this->changeAccepted($id,false);
    }
    public function acceptDoctor($id)
    {
        return $this->changeAccepted($id,true);
    }
    public function changeAccepted($id,$value)
    {
        $patient = Patient::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::where('doctor_id',$id)
            ->where('patient_id',$patient->id)->first();
        if($doctorPatient)
        {
            $doctorPatient->accepted = $value;
            $doctorPatient->save();
            if($value == true)
            {
                $doctor = Doctor::where('id',$id)->first();
                $notification = new Notification;
                $notification->name = 'El paciente '.$patient->user->name .' acepto tu solicitud';
                $notification->is_seen = false;
                $notification->user_id = $doctor->user->id;
                $notification->redirect= 'profile.show';
                $notification->redirect_param_1= $patient->user->id;
                $notification->save();
            }
        }
        return redirect(route('doctors.index'));
    }
}
