<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = DB::select('Select * from users');
        $users = DB::select('Select users.id, users.name, users.email, users.user_zameranie, oddelenie.oddelenie_id, oddelenie.nazov, oddelenie.veduci from users
        join zaradenie on users.id = zaradenie.zamestnanec_id join oddelenie on zaradenie.oddelenie_id = oddelenie.oddelenie_id');
        // dd($users);
        return view('users.users')->with("users", $users); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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

        $user = new User;
        $max_id = DB::select('Select MAX(id) from users');
        $user->id = $max_id + 1;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user_zameranie = $request->input('zameranie');
        $user->password = $user->id + $user->name;
        $user->save();
        // DB::
        return redirect('/users');
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
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
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
        // treba doplnit overovanie ci som to naozaj ja !!!
        // if (auth()->user()->name == "null")
        // {
        //     return redirect('./')->with('error', 'Neopravneny pristup');
        // }
        // if(auth()->user()->user_zameranie != 0 OR auth()->user()->id != $id)
        // {
        //     // if($todo->user_id !== auth()->user()->id){
        //         return redirect('./')->with('error', 'Neopravneny pristup');
        //     // }
        // }
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_zameranie = $request->zameranie;
        // $todo->subject = $request->subject;
        $user->save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        // if(auth()->user()->user_zameranie != 0)
        // {
        //     return redirect('/users')->with('error', 'Neopravneny pristup');
        // }
        $data->delete();
        return redirect('/users');
    }
}
