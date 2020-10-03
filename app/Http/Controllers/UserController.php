<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function editProfile()
    {
        return view('user.editProfile');
    }

    public function updateProfile(Request $request)
    {
        try {

            $userID= Auth::user()->id;
            $user = User::find($userID);
            if ($user){
                if ($request->hasFile('avatar')){
                    $filename = $request->avatar->getClientOriginalName();
                    $this->deleteOldImage($user);
                    $request->avatar->storeAs('user/images', $filename, 'public');
                    $user->update(['avatar'=>'user/images/'.$filename]);
                    return back()->with('success', 'your photo has been updated');
                }

                $user->update($request->all());
                return redirect('profile')->with('success', 'Your profile has been updated successfully.');
            }
        }
        catch(Exception $e) {
            return back()-with($e->getMessage());
        }
    }

    protected function deleteOldImage($user){
        if ($user->avatar){
            Storage::delete('/public/'.$user->avatar);
        }
    }

}
