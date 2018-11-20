<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medical\CreateMedicalAppointmentRequest;
use App\Models\Medical\Doctor;
use App\Models\Medical\DoctorPatient;
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
        $patient = Patient::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::select('doctor_patient.doctor_id')
            ->where('doctor_patient.patient_id',$patient->id)->get();
        $doctors = Doctor::join('users','doctors.user_id','users.id')
            ->whereIn('doctors.id',$doctorPatient)->pluck('users.name','doctors.id');
        return view('schedule')
            ->with('doctors',$doctors);
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
            $medicalAppointment = $this->medicalAppointmentRepository->create($input);
            Flash::success('Cita agendada Correctamente');
        }else{
            Flash::error('No eres paciente, no puedes agendar una cita como paciente');
            return redirect(route('schedule.index'));
        }



        return redirect(route('home'));
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
}
