<?php

namespace App\Http\Controllers\Medical;

use App\DataTables\Medical\DoctorDataTable;
use App\Http\Requests\Medical;
use App\Http\Requests\Medical\CreateDoctorRequest;
use App\Http\Requests\Medical\UpdateDoctorRequest;
use App\Models\Medical\DoctorPatient;
use App\Models\Medical\MedicalConsultant;
use App\Models\Medical\MedicalSpeciality;
use App\Models\Medical\Patient;
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
        $patients = Patient::join('users','patients.user_id','users.id')->get()->pluck('user.name','id');
        return view('medical.doctors.create')
            ->with('users',$users)
            ->with('medicalSpecialties',$medicalSpecialties)
            ->with('medicalConsultants',$medicalConsultants)
            ->with('patients',$patients);
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

        $patients = $request->input('patients');
        $dataRelationDoctorPatient = array();
        if($patients) {
            foreach ($patients as $patient) {
                array_push($dataRelationDoctorPatient, array('patient_id' => $patient, 'doctor_id' => $doctor->id, 'accepted' => true));
            }
        }
        DoctorPatient::insert($dataRelationDoctorPatient);
        $user = User::where('id',$doctor->user_id)->first();
        $user->assignRole('doctor');
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
        $patients = Patient::join('users','patients.user_id','users.id')->get()->pluck('user.name','id');

        return view('medical.doctors.edit')->with('doctor', $doctor)
            ->with('users',$users)
            ->with('medicalSpecialties',$medicalSpecialties)
            ->with('medicalConsultants',$medicalConsultants)
            ->with('patients',$patients);
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

        $patients = $request->input('patients');
        $dataRelationDoctorPatient = array();
        if($patients) {
            foreach ($patients as $patient) {
                $dataRelationDoctorPatient[]= ['patient_id' => $patient, 'doctor_id' => $doctor->id, 'accepted' => true];
            }
        }

        DoctorPatient::where('doctor_id',$doctor->id)->delete();
        DoctorPatient::insert($dataRelationDoctorPatient);


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
