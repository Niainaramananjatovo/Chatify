<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Inscription;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Inscription $request){
         $request->validate([
            'nom'=>['required'], 
            'email'=>['required', 'email'],
            'pswd'=>['required', 'min:8'], 
            'cpswd'=>['same:pswd']
        ]); 
        $name = str_replace(' ', '', $request->nom);
        User::create([
            'nom' =>$name, 
            'email' => $request->email,
            'password' => Hash::make($request->pswd),
        ]); 
        return response()->json(['success'=> 'creaction de votre compte avec succes']);
    } 

    public function authentification(Request $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json(['success'=> 'vérifiaction de votre compte avec succes']);
        } else {
            return response()->json(['error'=> 'erreur de votre mot de passe ou votre adresse Email']);
        }
    } 
    public function searchPerson($data){
        return User::where('nom', 'like', "%$data%")->get();
    }
}
