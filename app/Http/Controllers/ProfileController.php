<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\UserDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $avatarUrl = $this->getAvatarUrl();

        $model = $this->modelProfile(Auth::user()->id);

        return view('profile.edit')
            ->with('model',$model)
            ->with('avatarUrl',$avatarUrl);
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
        $avatarUrl = self::getAvatarUrlUser(User::where('id',$id)->first());

        $model = $this->modelProfile($id);

        return view('profile.show')
            ->with('model',$model)
            ->with('avatarUrl',$avatarUrl);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('profile');
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
        $user = User::where('id',Auth::user()->id)->first();
        $profile = $user->userDetails;
        //Storage::disk('images')->delete(''.$profile->image);
        $guid = File::guidDistinct();
        if($request->file('image')) {
            $nameImage = $this->storeImageOrReplace($request->file('image'), $guid);
            $file = File::create([
                'guid' => $guid
            ]);
            $path = Storage::disk('images')->url($nameImage);
            $file->name = $nameImage;
            $file->local_url = $path;
            $file->save();

            if($profile->image_guid){
                Storage::disk('images')->delete(''.$profile->fileImage->name);
                $profile->fileImage->delete();
            }

            $profile->image_guid = $file->guid;
        }

        $profile->city = $request->input('city');
        $profile->address = $request->input('address');
        $profile->save();

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->birthdate = $request->input('birthdate');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->save();

        Flash::success('UserDetails updated successfully.');

        return redirect(route('profile.index'));
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

    private function storeImageOrReplace($image,$guid){
        $name = $guid.'.'.$image->getClientOriginalExtension();
        Storage::disk('images')->put($name, \File::get($image));
        return $name;
    }

    public static function getAvatarUrl(){
        return self::getAvatarUrlUser(Auth::user());
    }
    public static function getAvatarUrlUser($user){
        $avatarUrl = asset('storage/default-user.png');
        if(!Auth::guest()) {
            $userDetails = $user->userDetails;
            if($userDetails->fileImage != null) {
                $localUrl = $userDetails->fileImage->local_url;
                $url = $userDetails->fileImage->url;
                if ($localUrl) {
                    $avatarUrl = asset($localUrl);
                } else if ($url) {
                    $avatarUrl = $url;
                }
            }
        }
        return $avatarUrl;
    }

    private function modelProfile($id){

        $user = User::where('id',$id)->first();
        $userDetails = $user->userDetails;
        $model = [
            'name' => $user->name,
            'last_name' => $user->last_name,
            'birthdate' => $user->birthdate,
            'gender' => $user->gender,
            'email' => $user->email,
            'city' => $userDetails->city,
            'address' => $userDetails->address
        ];
        return $model;
    }
}
