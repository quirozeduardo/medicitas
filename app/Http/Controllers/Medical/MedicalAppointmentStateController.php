<?php

namespace App\Http\Controllers\Medical;

use App\DataTables\Medical\MedicalAppointmentStateDataTable;
use App\Http\Requests\Medical;
use App\Http\Requests\Medical\CreateMedicalAppointmentStateRequest;
use App\Http\Requests\Medical\UpdateMedicalAppointmentStateRequest;
use App\Repositories\Medical\MedicalAppointmentStateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MedicalAppointmentStateController extends AppBaseController
{
    /** @var  MedicalAppointmentStateRepository */
    private $medicalAppointmentStateRepository;

    public function __construct(MedicalAppointmentStateRepository $medicalAppointmentStateRepo)
    {
        $this->medicalAppointmentStateRepository = $medicalAppointmentStateRepo;
    }

    /**
     * Display a listing of the MedicalAppointmentState.
     *
     * @param MedicalAppointmentStateDataTable $medicalAppointmentStateDataTable
     * @return Response
     */
    public function index(MedicalAppointmentStateDataTable $medicalAppointmentStateDataTable)
    {
        return $medicalAppointmentStateDataTable->render('medical.medical_appointment_states.index');
    }

    /**
     * Show the form for creating a new MedicalAppointmentState.
     *
     * @return Response
     */
    public function create()
    {
        return view('medical.medical_appointment_states.create');
    }

    /**
     * Store a newly created MedicalAppointmentState in storage.
     *
     * @param CreateMedicalAppointmentStateRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicalAppointmentStateRequest $request)
    {
        $input = $request->all();

        $medicalAppointmentState = $this->medicalAppointmentStateRepository->create($input);

        Flash::success('Medical Appointment State saved successfully.');

        return redirect(route('medical.medicalAppointmentStates.index'));
    }

    /**
     * Display the specified MedicalAppointmentState.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicalAppointmentState = $this->medicalAppointmentStateRepository->findWithoutFail($id);

        if (empty($medicalAppointmentState)) {
            Flash::error('Medical Appointment State not found');

            return redirect(route('medical.medicalAppointmentStates.index'));
        }

        return view('medical.medical_appointment_states.show')->with('medicalAppointmentState', $medicalAppointmentState);
    }

    /**
     * Show the form for editing the specified MedicalAppointmentState.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicalAppointmentState = $this->medicalAppointmentStateRepository->findWithoutFail($id);

        if (empty($medicalAppointmentState)) {
            Flash::error('Medical Appointment State not found');

            return redirect(route('medical.medicalAppointmentStates.index'));
        }

        return view('medical.medical_appointment_states.edit')->with('medicalAppointmentState', $medicalAppointmentState);
    }

    /**
     * Update the specified MedicalAppointmentState in storage.
     *
     * @param  int              $id
     * @param UpdateMedicalAppointmentStateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicalAppointmentStateRequest $request)
    {
        $medicalAppointmentState = $this->medicalAppointmentStateRepository->findWithoutFail($id);

        if (empty($medicalAppointmentState)) {
            Flash::error('Medical Appointment State not found');

            return redirect(route('medical.medicalAppointmentStates.index'));
        }

        $medicalAppointmentState = $this->medicalAppointmentStateRepository->update($request->all(), $id);

        Flash::success('Medical Appointment State updated successfully.');

        return redirect(route('medical.medicalAppointmentStates.index'));
    }

    /**
     * Remove the specified MedicalAppointmentState from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicalAppointmentState = $this->medicalAppointmentStateRepository->findWithoutFail($id);

        if (empty($medicalAppointmentState)) {
            Flash::error('Medical Appointment State not found');

            return redirect(route('medical.medicalAppointmentStates.index'));
        }

        $this->medicalAppointmentStateRepository->delete($id);

        Flash::success('Medical Appointment State deleted successfully.');

        return redirect(route('medical.medicalAppointmentStates.index'));
    }
}
