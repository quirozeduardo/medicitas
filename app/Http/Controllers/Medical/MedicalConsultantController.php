<?php

namespace App\Http\Controllers\Medical;

use App\DataTables\Medical\MedicalConsultantDataTable;
use App\Http\Requests\Medical;
use App\Http\Requests\Medical\CreateMedicalConsultantRequest;
use App\Http\Requests\Medical\UpdateMedicalConsultantRequest;
use App\Repositories\Medical\MedicalConsultantRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MedicalConsultantController extends AppBaseController
{
    /** @var  MedicalConsultantRepository */
    private $medicalConsultantRepository;

    public function __construct(MedicalConsultantRepository $medicalConsultantRepo)
    {
        $this->medicalConsultantRepository = $medicalConsultantRepo;
    }

    /**
     * Display a listing of the MedicalConsultant.
     *
     * @param MedicalConsultantDataTable $medicalConsultantDataTable
     * @return Response
     */
    public function index(MedicalConsultantDataTable $medicalConsultantDataTable)
    {
        return $medicalConsultantDataTable->render('medical.medical_consultants.index');
    }

    /**
     * Show the form for creating a new MedicalConsultant.
     *
     * @return Response
     */
    public function create()
    {
        return view('medical.medical_consultants.create');
    }

    /**
     * Store a newly created MedicalConsultant in storage.
     *
     * @param CreateMedicalConsultantRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicalConsultantRequest $request)
    {
        $input = $request->all();

        $medicalConsultant = $this->medicalConsultantRepository->create($input);

        Flash::success('Medical Consultant saved successfully.');

        return redirect(route('medical.medicalConsultants.index'));
    }

    /**
     * Display the specified MedicalConsultant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicalConsultant = $this->medicalConsultantRepository->findWithoutFail($id);

        if (empty($medicalConsultant)) {
            Flash::error('Medical Consultant not found');

            return redirect(route('medical.medicalConsultants.index'));
        }

        return view('medical.medical_consultants.show')->with('medicalConsultant', $medicalConsultant);
    }

    /**
     * Show the form for editing the specified MedicalConsultant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicalConsultant = $this->medicalConsultantRepository->findWithoutFail($id);

        if (empty($medicalConsultant)) {
            Flash::error('Medical Consultant not found');

            return redirect(route('medical.medicalConsultants.index'));
        }

        return view('medical.medical_consultants.edit')->with('medicalConsultant', $medicalConsultant);
    }

    /**
     * Update the specified MedicalConsultant in storage.
     *
     * @param  int              $id
     * @param UpdateMedicalConsultantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicalConsultantRequest $request)
    {
        $medicalConsultant = $this->medicalConsultantRepository->findWithoutFail($id);

        if (empty($medicalConsultant)) {
            Flash::error('Medical Consultant not found');

            return redirect(route('medical.medicalConsultants.index'));
        }

        $medicalConsultant = $this->medicalConsultantRepository->update($request->all(), $id);

        Flash::success('Medical Consultant updated successfully.');

        return redirect(route('medical.medicalConsultants.index'));
    }

    /**
     * Remove the specified MedicalConsultant from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicalConsultant = $this->medicalConsultantRepository->findWithoutFail($id);

        if (empty($medicalConsultant)) {
            Flash::error('Medical Consultant not found');

            return redirect(route('medical.medicalConsultants.index'));
        }

        $this->medicalConsultantRepository->delete($id);

        Flash::success('Medical Consultant deleted successfully.');

        return redirect(route('medical.medicalConsultants.index'));
    }
}
