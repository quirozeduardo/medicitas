<?php

namespace App\Http\Controllers;

use App\Models\Medical\Doctor;
use App\Models\Medical\MedicalAppointment;
use App\Models\Medical\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::where('user_id',Auth::user()->id)->first();
        $doctor = Doctor::where('user_id',Auth::user()->id)->first();

        $patientAppointments = MedicalAppointment::where('patient_id',$patient->id)->get();
        $doctorAppointments = null;
        if($doctor)
        {
            $doctorAppointments = MedicalAppointment::where('doctor_id',$doctor->id)->get();
        }

        return view('calendar')
            ->with('patientAppointments',$patientAppointments)
            ->with('doctorAppointments',$doctorAppointments);
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
    public function store(Request $request)
    {
        //
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
