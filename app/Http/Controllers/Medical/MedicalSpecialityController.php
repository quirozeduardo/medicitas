<?php

namespace App\Http\Controllers\Medical;

use App\DataTables\Medical\MedicalSpecialityDataTable;
use App\Http\Requests\Medical;
use App\Http\Requests\Medical\CreateMedicalSpecialityRequest;
use App\Http\Requests\Medical\UpdateMedicalSpecialityRequest;
use App\Repositories\Medical\MedicalSpecialityRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MedicalSpecialityController extends AppBaseController
{
    /** @var  MedicalSpecialityRepository */
    private $medicalSpecialityRepository;

    public function __construct(MedicalSpecialityRepository $medicalSpecialityRepo)
    {
        $this->medicalSpecialityRepository = $medicalSpecialityRepo;
    }

    /**
     * Display a listing of the MedicalSpeciality.
     *
     * @param MedicalSpecialityDataTable $medicalSpecialityDataTable
     * @return Response
     */
    public function index(MedicalSpecialityDataTable $medicalSpecialityDataTable)
    {
        return $medicalSpecialityDataTable->render('medical.medical_specialties.index');
    }

    /**
     * Show the form for creating a new MedicalSpeciality.
     *
     * @return Response
     */
    public function create()
    {
        return view('medical.medical_specialties.create');
    }

    /**
     * Store a newly created MedicalSpeciality in storage.
     *
     * @param CreateMedicalSpecialityRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicalSpecialityRequest $request)
    {
        $input = $request->all();

        $medicalSpeciality = $this->medicalSpecialityRepository->create($input);

        Flash::success('Medical Speciality saved successfully.');

        return redirect(route('medical.medicalSpecialties.index'));
    }

    /**
     * Display the specified MedicalSpeciality.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicalSpeciality = $this->medicalSpecialityRepository->findWithoutFail($id);

        if (empty($medicalSpeciality)) {
            Flash::error('Medical Speciality not found');

            return redirect(route('medical.medicalSpecialties.index'));
        }

        return view('medical.medical_specialties.show')->with('medicalSpeciality', $medicalSpeciality);
    }

    /**
     * Show the form for editing the specified MedicalSpeciality.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicalSpeciality = $this->medicalSpecialityRepository->findWithoutFail($id);

        if (empty($medicalSpeciality)) {
            Flash::error('Medical Speciality not found');

            return redirect(route('medical.medicalSpecialties.index'));
        }

        return view('medical.medical_specialties.edit')->with('medicalSpeciality', $medicalSpeciality);
    }

    /**
     * Update the specified MedicalSpeciality in storage.
     *
     * @param  int              $id
     * @param UpdateMedicalSpecialityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicalSpecialityRequest $request)
    {
        $medicalSpeciality = $this->medicalSpecialityRepository->findWithoutFail($id);

        if (empty($medicalSpeciality)) {
            Flash::error('Medical Speciality not found');

            return redirect(route('medical.medicalSpecialties.index'));
        }

        $medicalSpeciality = $this->medicalSpecialityRepository->update($request->all(), $id);

        Flash::success('Medical Speciality updated successfully.');

        return redirect(route('medical.medicalSpecialties.index'));
    }

    /**
     * Remove the specified MedicalSpeciality from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicalSpeciality = $this->medicalSpecialityRepository->findWithoutFail($id);

        if (empty($medicalSpeciality)) {
            Flash::error('Medical Speciality not found');

            return redirect(route('medical.medicalSpecialties.index'));
        }

        $this->medicalSpecialityRepository->delete($id);

        Flash::success('Medical Speciality deleted successfully.');

        return redirect(route('medical.medicalSpecialties.index'));
    }
}
