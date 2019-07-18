<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medical\CreateMedicalAppointmentRequest;
use App\Models\Medical\Doctor;
use App\Models\Medical\DoctorPatient;
use App\Models\Medical\MedicalAppointment;
use App\Models\Medical\Patient;
use App\Repositories\Medical\MedicalAppointmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class SchedulePatientController extends Controller
{
    /** @var  MedicalAppointmentRepository */
    private $medicalAppointmentRepository;

    public function __construct(MedicalAppointmentRepository $medicalAppointmentRepo)
    {
        $this->medicalAppointmentRepository = $medicalAppointmentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::select('doctor_patient.patient_id')
            ->where('doctor_patient.doctor_id',$doctor->id)
            ->where('accepted',1)->get();
        $patients = Patient::join('users','patients.user_id','users.id')
            ->whereIn('patients.id',$doctorPatient)->pluck('users.name','patients.id');
        return view('schedule_patient')
            ->with('patients',$patients);
    }
    public function retrievePatients() {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::select('doctor_patient.patient_id')
            ->where('doctor_patient.doctor_id',$doctor->id)
            ->where('accepted',1)->get();
        $patients = Patient::select('users.name','patients.id')->join('users','patients.user_id','users.id')
            ->whereIn('patients.id',$doctorPatient)->get();
        $data = [];
        foreach ($patients as $patient) {
            $data[] = [
                'name' => $patient->name,
                'id' => $patient->id,
            ];
        }
        echo json_encode($data);
        exit();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMedicalAppointmentRequest $request)
    {
        $doctor = Doctor::where('user_id',Auth::user()->id)->first();
        if($doctor) {
            $input = $request->all();
            $input += array(
                'doctor_id' => $doctor->id,
                'medical_appointment_status_id' => 1
            );
            try {
                $medicalAppointment = $this->medicalAppointmentRepository->create($input);
            } catch (\Exception $exception) {
                echo json_encode([
                    'message'=> 'Datos incorrectos, completelos',
                    'code'=> 'fail',
                    'redirectUrl' => ''
                ], JSON_FORCE_OBJECT);
                exit;
            }
        }else{
            echo json_encode([
                'message'=> 'No eres Doctor, no puedes agendar una cita como doctor',
                'code'=> 'no-permission',
                'redirectUrl' => route('home')
            ], JSON_FORCE_OBJECT);
            exit();
        }

        echo json_encode([
            'message'=> 'Cita agendada Correctamente',
            'code'=> 'success',
            'redirectUrl' => route('home')
        ], JSON_FORCE_OBJECT);
        exit();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxAppointmentsPatient(Request $request){
        if($request->ajax())
        {
            $patient = Doctor::where('id',$request->input('patient_id'))->first();
            if($patient){
                $medicalAppointments =  MedicalAppointment::where('patient_id',$patient->id)
                    ->where('date',$request->input('date'))->orderBy('time_start', 'ASC')->get();
                if($medicalAppointments){
                    return json_encode($medicalAppointments->toArray());
                }

            }
            return "";
        }

        return '';
    }
}
