<?php

namespace App\Http\Controllers\Medical;

use App\DataTables\Medical\PatientDataTable;
use App\Http\Requests\Medical;
use App\Http\Requests\Medical\CreatePatientRequest;
use App\Http\Requests\Medical\UpdatePatientRequest;
use App\Repositories\Medical\PatientRepository;
use App\User;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PatientController extends AppBaseController
{
    /** @var  PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
     *
     * @param PatientDataTable $patientDataTable
     * @return Response
     */
    public function index(PatientDataTable $patientDataTable)
    {
        return $patientDataTable->render('medical.patients.index');
    }

    /**
     * Show the form for creating a new Patient.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::get()->pluck('name','id');
        return view('medical.patients.create')
            ->with('users',$users);
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param CreatePatientRequest $request
     *
     * @return Response
     */
    public function store(CreatePatientRequest $request)
    {
        $input = $request->all();

        $patient = $this->patientRepository->create($input);

        Flash::success('Patient saved successfully.');

        return redirect(route('medical.patients.index'));
    }

    /**
     * Display the specified Patient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('medical.patients.index'));
        }

        return view('medical.patients.show')->with('patient', $patient);
    }

    /**
     * Show the form for editing the specified Patient.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('medical.patients.index'));
        }
        $users = User::get()->pluck('name','id');

        return view('medical.patients.edit')
            ->with('users',$users)
            ->with('patient', $patient);
    }

    /**
     * Update the specified Patient in storage.
     *
     * @param  int              $id
     * @param UpdatePatientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePatientRequest $request)
    {
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('medical.patients.index'));
        }

        $patient = $this->patientRepository->update($request->all(), $id);

        Flash::success('Patient updated successfully.');

        return redirect(route('medical.patients.index'));
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $patient = $this->patientRepository->findWithoutFail($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('medical.patients.index'));
        }

        $this->patientRepository->delete($id);

        Flash::success('Patient deleted successfully.');

        return redirect(route('medical.patients.index'));
    }
}
