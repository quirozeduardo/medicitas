<?php

namespace App\Http\Controllers\Administration;

use App\DataTables\Administration\UserDataTable;
use App\Http\Requests\Administration\CreateUserRequest;
use App\Http\Requests\Administration\UpdateUserRequest;
use App\Models\UserDetails;
use App\Repositories\Administration\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Hash;
use Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Doctor.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('administration.users.index');
    }

    /**
     * Show the form for creating a new Doctor.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::get()->pluck('name','id');
        $permissions = Permission::get()->pluck('name','id');

        return view('administration.users.create')
            ->with('permissions',$permissions)
            ->with('roles',$roles);
    }

    /**
     * Store a newly created Doctor in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {

        $input = $request->except(['roles','permissions']);
        $input['password'] = Hash::make($input['password']);

        $user = $this->userRepository->create($input);

        $permissions=$request->input('permissions');
        $roles=$request->input('roles');
        $user->syncRoles($roles);
        $user->syncPermissions($permissions);

        Flash::success('Doctor saved successfully.');

        return redirect(route('administration.users.index'));
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
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Doctor not found');

            return redirect(route('administration.users.index'));
        }

        return view('administration.users.show')->with('user', $user);
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
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Doctor not found');

            return redirect(route('administration.users.index'));
        }

        $roles = Role::get()->pluck('name','id');
        $permissions = Permission::get()->pluck('name','id');



        return view('administration.users.edit')->with('user', $user)
            ->with('permissions',$permissions)
            ->with('roles',$roles);
    }

    /**
     * Update the specified Doctor in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Doctor not found');

            return redirect(route('administration.users.index'));
        }
        if($request->input('password') != '') {
            $requestUser = $request->except(['roles', 'permissions']);
            $requestUser['password'] = Hash::make($requestUser['password']);
        }else{
            $requestUser = $request->except(['roles', 'permissions','password']);
        }
        $user = $this->userRepository->update($requestUser, $id);

        $permissions=$request->input('permissions');
        $roles=$request->input('roles');
        $user->syncRoles($roles);
        $user->syncPermissions($permissions);

        Flash::success('Doctor updated successfully.');

        return redirect(route('administration.users.index'));
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
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('Doctor not found');

            return redirect(route('administration.users.index'));
        }

        $user->syncRoles();
        $user->syncPermissions();

        $this->userRepository->delete($id);

        Flash::success('Doctor deleted successfully.');

        return redirect(route('administration.users.index'));
    }
}
