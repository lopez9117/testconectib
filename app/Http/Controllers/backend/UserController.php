<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllUser()
    {
        $all = DB::table('users')
                ->get();
        return view('backend.user.all-user', compact('all')); 
    }
    //AddUser,InsertUser
    public function AddUserIndex()
    {
        return view('backend.user.add_user'); 
    }

    public function InsertUser(Request $request)
    {
        $data = array();
        $data['identificador'] = $request->identificador;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['numero_celular'] = $request->celular;
        $data['cedula'] = $request->cedula;
        $data['fecha_de_nacimiento'] = $request->birthdate;
        $data['Codigo_de_ciudad'] = $request->CódigoDeCiudad;
        $data['role'] = $request->role;
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $insert = DB::table('users')->insert($data);
        if($insert)
        {
            $notification=array
            (
                'message'=>'Successfully User Inserted',
                'alert-type'=>'success'
            );
            return redirect()->route('alluser')->with($notification);
        }
        else{
            $notification=array
            (
                'message'=>'Something is wrong, please try again!',
                'alert-type'=>'success'
            );
            return redirect()->route('alluser')->with($notification);

        }
    }

    public function Edituser($id)
    {
        $edit = DB::table('users')->where('id',$id)->first();
        return view('backend.user.edit_user',compact('edit'));
    }

    public function UpdateUser(Request $request,$id)
    {
        $data = array();
        $data['identificador'] = $request->identificador;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['numero_celular'] = $request->celular;
        $data['cedula'] = $request->cedula;
        $data['fecha_de_nacimiento'] = $request->birthdate;
        $data['Codigo_de_ciudad'] = $request->CódigoDeCiudad;
        $data['role'] = $request->role;
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $update = DB::table('users')
        ->where('id',$id)
        ->update($data);
        if($update)
        {
            $notification=array
            (
                'message'=>'Successfully User Update',
                'alert-type'=>'success'
            );
            return redirect()->route('alluser')->with($notification);
        }
        else{
            $notification=array
            (
                'message'=>'Something is wrong, please try again!',
                'alert-type'=>'success'
            );
            return redirect()->route('alluser')->with($notification);

        }
    }

    public function DeleteUser($id)
    {
        $delete = DB::table('users')->where('id',$id)->delete();
        if($delete)
        {
            $notification=array
            (
                'message'=>'Successfully User Deleted',
                'alert-type'=>'success'
            );
            return redirect()->route('alluser')->with($notification);
        }
        else{
            $notification=array
            (
                'message'=>'Something is wrong, please try again!',
                'alert-type'=>'success'
            );
            return redirect()->route('alluser')->with($notification);

        }
    }
}