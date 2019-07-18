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

class ScheduleController extends Controller
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

        return view('schedule');
    }

    public function retrieveDoctors() {
        $patient = Patient::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::select('doctor_patient.doctor_id')
            ->where('doctor_patient.patient_id',$patient->id)
            ->where('accepted',1)->get();
        $doctors = Doctor::select('users.name','doctors.id')->join('users','doctors.user_id','users.id')
            ->whereIn('doctors.id',$doctorPatient)->get();
        $data = [];
        foreach ($doctors as $doctor) {
            $data[] = [
                'name' => $doctor->name,
                'id' => $doctor->id,
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
        $patient = Patient::where('user_id',Auth::user()->id)->first();
        if($patient) {
                $input = $request->all();
                $input += array(
                    'patient_id' => $patient->id,
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
            //Flash::success('Cita agendada Correctamente');
        }else{
            //Flash::error('No eres paciente, no puedes agendar una cita como paciente');
            echo json_encode([
                'message'=> 'No eres paciente, no puedes agendar una cita como paciente',
                'code'=> 'no-permission',
                'redirectUrl' => route('home')
            ], JSON_FORCE_OBJECT);
            //return redirect(route('schedule.index'));
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

    public function ajaxAppointmentsDoctor(Request $request){
        if($request->ajax())
        {
            $doctor = Doctor::where('id',$request->input('doctor_id'))->first();
            if($doctor){
                $medicalAppointments =  MedicalAppointment::where('doctor_id',$doctor->id)
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
