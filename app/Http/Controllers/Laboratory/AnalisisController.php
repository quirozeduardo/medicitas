<?php

namespace App\Http\Controllers\Laboratory;

use App\DataTables\Laboratory\AnalisisDataTable;
use App\Http\Requests\Laboratory;
use App\Http\Requests\Laboratory\CreateAnalisisRequest;
use App\Http\Requests\Laboratory\UpdateAnalisisRequest;
use App\Models\Laboratory\TypeAnalisis;
use App\Models\Medical\Doctor;
use App\Models\Medical\DoctorPatient;
use App\Models\Medical\Patient;
use App\Models\Notification;
use App\Repositories\Laboratory\AnalisisRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;

class AnalisisController extends AppBaseController
{
    /** @var  AnalisisRepository */
    private $analisisRepository;

    public function __construct(AnalisisRepository $analisisRepo)
    {
        $this->analisisRepository = $analisisRepo;
    }

    /**
     * Display a listing of the Analisis.
     *
     * @param AnalisisDataTable $analisisDataTable
     * @return Response
     */
    public function index(AnalisisDataTable $analisisDataTable)
    {

        return $analisisDataTable->render('laboratory.analises.index');
    }

    /**
     * Show the form for creating a new Analisis.
     *
     * @return Response
     */
    public function create()
    {
        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::select('doctor_patient.patient_id')
            ->where('doctor_patient.doctor_id',$doctor->id)
            ->where('accepted',true)->get();
        $patients = Patient::join('users','patients.user_id','users.id')
            ->whereIn('patients.id',$doctorPatient)->pluck('users.name','patients.id');
        $typeAnalisis = TypeAnalisis::get()->pluck('name','id');
        return view('laboratory.analises.create')
            ->with('typeAnalisis',$typeAnalisis)
            ->with('patients',$patients);
    }

    /**
     * Store a newly created Analisis in storage.
     *
     * @param CreateAnalisisRequest $request
     *
     * @return Response
     */
    public function store(CreateAnalisisRequest $request)
    {
        $input = $request->all();

        $analisis = $this->analisisRepository->create($input);
        $typeAnalisis = TypeAnalisis::where('id',$analisis->type_analisis_id)->first();

        Flash::success('Analisis saved successfully.');

        $notification = new Notification;
        $notification->name = '¿Agendar Cita?';
        $notification->description = 'Analisis listos para '.date('Y-m-d', strtotime($analisis->arrived_analysis_date. ' + '.intval($typeAnalisis->time_delay).' days'));;
        $notification->is_seen = false;
        $notification->user_id = Auth::user()->id;
        $notification->redirect= 'schedulePatient.index';
        $notification->save();


        echo json_encode([
            'message'=> 'Cita agendada Correctamente',
            'code'=> 'success',
            'redirectUrl' => route('laboratory.analises.index')
        ], JSON_FORCE_OBJECT);
    }

    /**
     * Display the specified Analisis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $analisis = $this->analisisRepository->findWithoutFail($id);

        if (empty($analisis)) {
            Flash::error('Analisis not found');

            return redirect(route('laboratory.analises.index'));
        }

        return view('laboratory.analises.show')->with('analisis', $analisis);
    }

    /**
     * Show the form for editing the specified Analisis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $analisis = $this->analisisRepository->findWithoutFail($id);

        if (empty($analisis)) {
            Flash::error('Analisis not found');

            return redirect(route('laboratory.analises.index'));
        }

        $doctor = Doctor::where('user_id', Auth::user()->id)->first();
        $doctorPatient = DoctorPatient::select('doctor_patient.patient_id')
            ->where('doctor_patient.doctor_id',$doctor->id)
            ->where('accepted',true)->get();
        $patients = Patient::join('users','patients.user_id','users.id')
            ->whereIn('patients.id',$doctorPatient)->pluck('users.name','patients.id');
        $typeAnalisis = TypeAnalisis::get()->pluck('name','id');

        return view('laboratory.analises.edit')
            ->with('analisis', $analisis)
            ->with('patients', $patients)
            ->with('typeAnalisis',$typeAnalisis);
    }

    /**
     * Update the specified Analisis in storage.
     *
     * @param  int              $id
     * @param UpdateAnalisisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAnalisisRequest $request)
    {
        $analisis = $this->analisisRepository->findWithoutFail($id);

        if (empty($analisis)) {
            Flash::error('Analisis not found');

            return redirect(route('laboratory.analises.index'));
        }

        $analisis = $this->analisisRepository->update($request->all(), $id);

        Flash::success('Analisis updated successfully.');

        return redirect(route('laboratory.analises.index'));
    }

    /**
     * Remove the specified Analisis from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $analisis = $this->analisisRepository->findWithoutFail($id);

        if (empty($analisis)) {
            Flash::error('Analisis not found');

            return redirect(route('laboratory.analises.index'));
        }

        $this->analisisRepository->delete($id);

        Flash::success('Analisis deleted successfully.');

        return redirect(route('laboratory.analises.index'));
    }
}
