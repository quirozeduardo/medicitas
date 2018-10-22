<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\Administration\RoleDataTable;
use App\Http\Requests\Administration\CreateRoleRequest;
use App\Http\Requests\Administration\UpdateRoleRequest;
use App\Repositories\Administration\RoleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Spatie\Permission\Models\Permission;

class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param RoleDataTable $roleDataTable
     * @return Response
     */
    public function index(RoleDataTable $roleDataTable)
    {
        return $roleDataTable->render('administration.roles.index');
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::get()->pluck('name','id');
        return view('administration.roles.create')
            ->with('permissions',$permissions);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->except(['permissions']);

        $role = $this->roleRepository->create($input);
        $permissions=$request->input('permissions');
        $role->syncPermissions($permissions);

        Flash::success('Role saved successfully.');

        return redirect(route('administration.roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('administration.roles.index'));
        }

        return view('administration.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->findWithoutFail($id);
        $permissions = Permission::get()->pluck('name','id');

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('administration.roles.index'));
        }

        return view('administration.roles.edit')->with('role', $role)
            ->with('permissions',$permissions);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param  int              $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('administration.roles.index'));
        }

        $role = $this->roleRepository->update($request->except(['permissions']), $id);

        $permissions=$request->input('permissions');
        $role->syncPermissions($permissions);

        Flash::success('Role updated successfully.');

        return redirect(route('administration.roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->findWithoutFail($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('administration.roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role deleted successfully.');

        return redirect(route('administration.roles.index'));
    }
}
