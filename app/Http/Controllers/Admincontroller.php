<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Admincontroller extends Controller
{
    //
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'User logged out successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } // end method

//user profile login details
    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    } //end user profile.
//Edit Profile
    public function Editprofile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));

    }//end edit profile method


    // methodto store updated data in the database
    public function storeProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if($request->file('profile_image')){
            $file =$request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('admin.profile')->with($notification);

    } //end method

    //Change password
    public function ChangePassword(){

        return view('admin.admin_change_password');

    } // end of change password

    //update password
    public function UpdatePassword(Request $request){
    $validateData = $request->validate([
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'confirm_password' => 'required|same:newpassword',

    ]);
    $hashedPassword = Auth::user()->password;
    if(Hash::check($request->oldpassword, $hashedPassword)){
        $users = User::find(Auth::id());
        $users->password = bcrypt($request->newpassword);
        $users->save();
        session()->flash('message', 'Password Updated Successfully');
        return redirect()->back();
    }
    else{
        session()->flash('message', 'Old password did not match');
        return redirect()->back();
    }
   

    }//end of update password
}