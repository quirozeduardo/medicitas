<?php

namespace App\Http\Controllers;

use App\Models\Medical\Doctor;
use App\Models\Medical\DoctorPatient;
use App\Models\Medical\Patient;
use App\Models\Notification;
use App\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

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
                ->join('users', 'users.id', '=', 'doctors.user_id')
                ->where('doctor_patient.patient_id',$patient->id)
                ->where('doctor_patient.accepted',1)->get();
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
    function setRating(Request $request) {
        $user = Auth::user();
        if ($user) {
            $ratingMy = Rating::where('user_id', $user->id)->where('doctor_id', $request->doctor)->first();
            if(!$ratingMy) {
                $rating = new Rating;
                $rating->user_id = $user->id;
                $rating->doctor_id = $request->doctor;
                $rating->rating = $request->rating;
                $rating->save();
            }else {
                $ratingMy->rating = $request->rating;
                $ratingMy->save();
            }
            return json_encode([
                'response'=>'success'
            ]);
        }else {
            return json_encode(null);
        }
    }
    public function addDoctor($id)
    {
        $patient = Patient::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::where('doctor_id',$id)
            ->where('patient_id',$patient->id)->first();
        if(!$doctorPatient)
        {
            $doctor = Doctor::where('id', $id)->first();
            $doctorPatient = new DoctorPatient;
            $doctorPatient->patient_id = $patient->id;
            $doctorPatient->doctor_id = $id;
            $doctorPatient->accepted = 0;
            $doctorPatient->send_by = Auth::user()->id;
            $doctorPatient->save();

            $notification = new Notification;
            $notification->name = 'El paciente '.$patient->user->name .' te envio una solicitud';
            $notification->is_seen = false;
            $notification->user_id = $doctor->user->id;
            $notification->redirect= 'patients.index';
            $notification->save();
        }else
        {
            Flash::success('Y se envio la solicitud anteriormente','Mensaje');
        }
        return redirect(route('doctors.index'));
    }
    public function rejectDoctor($id)
    {
        return $this->changeAccepted($id,2);
    }
    public function acceptDoctor($id)
    {
        return $this->changeAccepted($id,1);
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
            if($value == 1)
            {
                $doctor = Doctor::where('id',$id)->first();
                $notification = new Notification;
                $notification->name = 'El paciente '.$patient->user->name .' acepto tu solicitud';
                $notification->is_seen = false;
                $notification->user_id = $doctor->user->id;
                $notification->redirect= 'profile.show';
                $notification->redirect_param_1= $patient->user->id;
                $notification->save();

                Flash::success('Aceptado','Mensaje');
            }
        }
        return redirect(route('doctors.index'));
    }
}
