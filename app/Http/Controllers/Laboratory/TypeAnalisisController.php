<?php

namespace App\Http\Controllers\Laboratory;

use App\DataTables\Laboratory\TypeAnalisisDataTable;
use App\Http\Requests\Laboratory;
use App\Http\Requests\Laboratory\CreateTypeAnalisisRequest;
use App\Http\Requests\Laboratory\UpdateTypeAnalisisRequest;
use App\Repositories\Laboratory\TypeAnalisisRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TypeAnalisisController extends AppBaseController
{
    /** @var  TypeAnalisisRepository */
    private $typeAnalisisRepository;

    public function __construct(TypeAnalisisRepository $typeAnalisisRepo)
    {
        $this->typeAnalisisRepository = $typeAnalisisRepo;
    }

    /**
     * Display a listing of the TypeAnalisis.
     *
     * @param TypeAnalisisDataTable $typeAnalisisDataTable
     * @return Response
     */
    public function index(TypeAnalisisDataTable $typeAnalisisDataTable)
    {
        return $typeAnalisisDataTable->render('laboratory.type_analises.index');
    }

    /**
     * Show the form for creating a new TypeAnalisis.
     *
     * @return Response
     */
    public function create()
    {
        return view('laboratory.type_analises.create');
    }

    /**
     * Store a newly created TypeAnalisis in storage.
     *
     * @param CreateTypeAnalisisRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeAnalisisRequest $request)
    {
        $input = $request->all();

        $typeAnalisis = $this->typeAnalisisRepository->create($input);

        Flash::success('Type Analisis saved successfully.');

        return redirect(route('laboratory.typeAnalises.index'));
    }

    /**
     * Display the specified TypeAnalisis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $typeAnalisis = $this->typeAnalisisRepository->findWithoutFail($id);

        if (empty($typeAnalisis)) {
            Flash::error('Type Analisis not found');

            return redirect(route('laboratory.typeAnalises.index'));
        }

        return view('laboratory.type_analises.show')->with('typeAnalisis', $typeAnalisis);
    }

    /**
     * Show the form for editing the specified TypeAnalisis.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $typeAnalisis = $this->typeAnalisisRepository->findWithoutFail($id);

        if (empty($typeAnalisis)) {
            Flash::error('Type Analisis not found');

            return redirect(route('laboratory.typeAnalises.index'));
        }

        return view('laboratory.type_analises.edit')->with('typeAnalisis', $typeAnalisis);
    }

    /**
     * Update the specified TypeAnalisis in storage.
     *
     * @param  int              $id
     * @param UpdateTypeAnalisisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeAnalisisRequest $request)
    {
        $typeAnalisis = $this->typeAnalisisRepository->findWithoutFail($id);

        if (empty($typeAnalisis)) {
            Flash::error('Type Analisis not found');

            return redirect(route('laboratory.typeAnalises.index'));
        }

        $typeAnalisis = $this->typeAnalisisRepository->update($request->all(), $id);

        Flash::success('Type Analisis updated successfully.');

        return redirect(route('laboratory.typeAnalises.index'));
    }

    /**
     * Remove the specified TypeAnalisis from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $typeAnalisis = $this->typeAnalisisRepository->findWithoutFail($id);

        if (empty($typeAnalisis)) {
            Flash::error('Type Analisis not found');

            return redirect(route('laboratory.typeAnalises.index'));
        }

        $this->typeAnalisisRepository->delete($id);

        Flash::success('Type Analisis deleted successfully.');

        return redirect(route('laboratory.typeAnalises.index'));
    }
}
