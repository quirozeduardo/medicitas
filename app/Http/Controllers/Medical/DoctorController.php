<?php

namespace App\Http\Controllers\Medical;

use App\DataTables\Medical\DoctorDataTable;
use App\Http\Requests\Medical;
use App\Http\Requests\Medical\CreateDoctorRequest;
use App\Http\Requests\Medical\UpdateDoctorRequest;
use App\Models\Medical\MedicalConsultant;
use App\Models\Medical\MedicalSpeciality;
use App\Repositories\Medical\DoctorRepository;
use App\User;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DoctorController extends AppBaseController
{
    /** @var  DoctorRepository */
    private $doctorRepository;

    public function __construct(DoctorRepository $doctorRepo)
    {
        $this->doctorRepository = $doctorRepo;
    }

    /**
     * Display a listing of the Doctor.
     *
     * @param DoctorDataTable $doctorDataTable
     * @return Response
     */
    public function index(DoctorDataTable $doctorDataTable)
    {
        return $doctorDataTable->render('medical.doctors.index');
    }

    /**
     * Show the form for creating a new Doctor.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::get()->pluck('name','id');
        $medicalSpecialties = MedicalSpeciality::get()->pluck('name','id');
        $medicalConsultants = MedicalConsultant::get()->pluck('name','id');
        return view('medical.doctors.create')
            ->with('users',$users)
            ->with('medicalSpecialties',$medicalSpecialties)
            ->with('medicalConsultants',$medicalConsultants);
    }

    /**
     * Store a newly created Doctor in storage.
     *
     * @param CreateDoctorRequest $request
     *
     * @return Response
     */
    public function store(CreateDoctorRequest $request)
    {
        $input = $request->all();

        $doctor = $this->doctorRepository->create($input);

        Flash::success('Doctor saved successfully.');

        return redirect(route('medical.doctors.index'));
    }

    /**
     * Display the specified Doctor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $doctor = $this->doctorRepository->findWithoutFail($id);

        if (empty($doctor)) {
            Flash::error('Doctor not found');

            return redirect(route('medical.doctors.index'));
        }

        return view('medical.doctors.show')->with('doctor', $doctor);
    }

    /**
     * Show the form for editing the specified Doctor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $doctor = $this->doctorRepository->findWithoutFail($id);

        if (empty($doctor)) {
            Flash::error('Doctor not found');

            return redirect(route('medical.doctors.index'));
        }
        $users = User::get()->pluck('name','id');
        $medicalSpecialties = MedicalSpeciality::get()->pluck('name','id');
        $medicalConsultants = MedicalConsultant::get()->pluck('name','id');


        return view('medical.doctors.edit')->with('doctor', $doctor)
            ->with('users',$users)
            ->with('medicalSpecialties',$medicalSpecialties)
            ->with('medicalConsultants',$medicalConsultants);
    }

    /**
     * Update the specified Doctor in storage.
     *
     * @param  int              $id
     * @param UpdateDoctorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDoctorRequest $request)
    {
        $doctor = $this->doctorRepository->findWithoutFail($id);

        if (empty($doctor)) {
            Flash::error('Doctor not found');

            return redirect(route('medical.doctors.index'));
        }
        $input = $request->all();
        $doctor = $this->doctorRepository->update($request->all(), $id);

        if(!array_key_exists('medical_consultant_id',$input)){
            $doctor->medical_consultant_id=null;
            $doctor->save();
        }
        Flash::success('Doctor updated successfully.');

        return redirect(route('medical.doctors.index'));
    }

    /**
     * Remove the specified Doctor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $doctor = $this->doctorRepository->findWithoutFail($id);

        if (empty($doctor)) {
            Flash::error('Doctor not found');

            return redirect(route('medical.doctors.index'));
        }

        $this->doctorRepository->delete($id);

        Flash::success('Doctor deleted successfully.');

        return redirect(route('medical.doctors.index'));
    }
}
