<?php

namespace App\Http\Controllers\Medical;

use App\DataTables\Medical\MedicalAppointmentDataTable;
use App\Http\Requests\Medical;
use App\Http\Requests\Medical\CreateMedicalAppointmentRequest;
use App\Http\Requests\Medical\UpdateMedicalAppointmentRequest;
use App\Models\Medical\Doctor;
use App\Models\Medical\MedicalAppointmentState;
use App\Models\Medical\MedicalConsultant;
use App\Models\Medical\Patient;
use App\Repositories\Medical\MedicalAppointmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MedicalAppointmentController extends AppBaseController
{
    /** @var  MedicalAppointmentRepository */
    private $medicalAppointmentRepository;

    public function __construct(MedicalAppointmentRepository $medicalAppointmentRepo)
    {
        $this->medicalAppointmentRepository = $medicalAppointmentRepo;
    }

    /**
     * Display a listing of the MedicalAppointment.
     *
     * @param MedicalAppointmentDataTable $medicalAppointmentDataTable
     * @return Response
     */
    public function index(MedicalAppointmentDataTable $medicalAppointmentDataTable)
    {
        return $medicalAppointmentDataTable->render('medical.medical_appointments.index');
    }

    /**
     * Show the form for creating a new MedicalAppointment.
     *
     * @return Response
     */
    public function create()
    {
        $patients = Patient::join('users','patients.user_id','users.id')->pluck('users.name','patients.id');
        $doctors = Doctor::join('users','doctors.user_id','users.id')->pluck('users.name','doctors.id');
        $medicalConsultants = MedicalConsultant::get()->pluck('name','id');
        $medicalAppointmentStates = MedicalAppointmentState::get()->pluck('name','id');
        return view('medical.medical_appointments.create')
            ->with('patients',$patients)
            ->with('doctors',$doctors)
            ->with('medicalConsultants',$medicalConsultants)
            ->with('medicalAppointmentStates',$medicalAppointmentStates);
    }

    /**
     * Store a newly created MedicalAppointment in storage.
     *
     * @param CreateMedicalAppointmentRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicalAppointmentRequest $request)
    {
        $input = $request->all();

        $medicalAppointment = $this->medicalAppointmentRepository->create($input);

        Flash::success('Medical Appointment saved successfully.');

        return redirect(route('medical.medicalAppointments.index'));
    }

    /**
     * Display the specified MedicalAppointment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicalAppointment = $this->medicalAppointmentRepository->findWithoutFail($id);

        if (empty($medicalAppointment)) {
            Flash::error('Medical Appointment not found');

            return redirect(route('medical.medicalAppointments.index'));
        }

        return view('medical.medical_appointments.show')->with('medicalAppointment', $medicalAppointment);
    }

    /**
     * Show the form for editing the specified MedicalAppointment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicalAppointment = $this->medicalAppointmentRepository->findWithoutFail($id);

        if (empty($medicalAppointment)) {
            Flash::error('Medical Appointment not found');

            return redirect(route('medical.medicalAppointments.index'));
        }
        $patients = Patient::join('users','patients.user_id','users.id')->pluck('users.name','patients.id');
        $doctors = Doctor::join('users','doctors.user_id','users.id')->pluck('users.name','doctors.id');
        $medicalConsultants = MedicalConsultant::get()->pluck('name','id');
        $medicalAppointmentStates = MedicalAppointmentState::get()->pluck('name','id');


        return view('medical.medical_appointments.edit')
            ->with('medicalAppointment', $medicalAppointment)
            ->with('patients',$patients)
            ->with('doctors',$doctors)
            ->with('medicalConsultants',$medicalConsultants)
            ->with('medicalAppointmentStates',$medicalAppointmentStates);
    }

    /**
     * Update the specified MedicalAppointment in storage.
     *
     * @param  int              $id
     * @param UpdateMedicalAppointmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicalAppointmentRequest $request)
    {
        $medicalAppointment = $this->medicalAppointmentRepository->findWithoutFail($id);

        if (empty($medicalAppointment)) {
            Flash::error('Medical Appointment not found');

            return redirect(route('medical.medicalAppointments.index'));
        }

        $medicalAppointment = $this->medicalAppointmentRepository->update($request->all(), $id);

        Flash::success('Medical Appointment updated successfully.');

        return redirect(route('medical.medicalAppointments.index'));
    }

    /**
     * Remove the specified MedicalAppointment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicalAppointment = $this->medicalAppointmentRepository->findWithoutFail($id);

        if (empty($medicalAppointment)) {
            Flash::error('Medical Appointment not found');

            return redirect(route('medical.medicalAppointments.index'));
        }

        $this->medicalAppointmentRepository->delete($id);

        Flash::success('Medical Appointment deleted successfully.');

        return redirect(route('medical.medicalAppointments.index'));
    }
}
