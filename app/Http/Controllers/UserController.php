<?php

namespace App\Http\Controllers;

use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

            $userID = Auth::user()->id;
            $user = User::find($userID);
            if ($user) {
                if ($request->hasFile('avatar')) {
                    $filename = $request->avatar->getClientOriginalName();
                    $this->deleteOldImage($user);
                    $request->avatar->storeAs('user/images', $filename, 'public');
                    $user->update(['avatar' => 'user/images/' . $filename]);
                    return back()->with('success', 'your photo has been updated');
                }

                $user->update($request->all());
                return redirect('profile')->with('success', 'Your profile has been updated successfully.');
            }
        } catch (Exception $e) {
            return back() - with($e->getMessage());
        }
    }

    protected function deleteOldImage($user)
    {
        if ($user->avatar) {
            Storage::delete('/public/' . $user->avatar);
        }
    }

    public function changePassword()
    {
        return view('user.password');
    }


    public function updatePassword(Request $request)
    {
        try {
            try {
                $validatedRequest = $request->validateWithBag('error', [
                    'oldPassword' => ['required'],
                    'newPassword' => ['required', 'string', 'min:9',],
                    'confirmPassword' => ['required', 'min:9', 'string']
                ]);
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }

            if (Hash::check($validatedRequest['oldPassword'], Auth::user()->password)) {
                if ($validatedRequest['newPassword'] === $validatedRequest['confirmPassword']) {
                    User::find(Auth::user()->id)->update([
                        'password' => Hash::make($validatedRequest['newPassword']),
                    ]);
                    Auth::logout();
                    return redirect()->route('login')->with('success', 'Password Successfully Updated. Login now ');
                }
                return back()->with('error', 'Passwords do not match');
            }
            return back()->with('error', '! Wrong password entered');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

}
