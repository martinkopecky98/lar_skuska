<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Oddelenie;
use Auth;

class OddelenieController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $oddelenia = DB::select('Select * from oddelenie');
        // $data = Oddelenie::all();
        // dd($oddelenia);
        // return view('oddelenia.oddelenia')->with(["oddelenia", $oddelenia]);
        return view('oddelenia.oddelenia', compact('oddelenia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'neprihlaseny user');
        }
        if(auth()->user()->pozicia == 'manazer' OR auth()->user()->pozicia == 'root')
        {return view('oddelenia.create');}
        return redirect('/')->with('error', 'zamietnuty pristup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // najdi ci existuje taky user ak nie vyhod ho z funkcie ak hej musis aj userovi nastavit ze je veduci tohto projektu :(
        // dd("som v store");
        $veduci = DB::select('select * from users where email = ?',[$request->veduci]);
        // dd($veduci);
        if(!empty($veduci))
        {
            if( $veduci[0]->oddelenie_id == 0)
            {
                $oddelenie = new Oddelenie;
                $oddelenie->nazov = $request->input('nazov');
                $oddelenie->veduci = $request->input('veduci');
                // DB::insert('insert into oddelenia')
                $oddelenie->save();
                DB::update('update users set oddelenie_id = ? where email = ?',[$oddelenie->id, $oddelenie->veduci]);
                return redirect('/oddelenie')->with('success','oddelenie bolo pridane');

            }
        }
        
        return redirect('/oddelenie')->with('error', 'neexistuje taky user alebo uz ma oddelenie');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);

        // return "dobra cesta ";
        $oddelenie = DB::select('Select * from oddelenie where oddelenie_id = ?', [$id]);
        // dd($oddelenie);

        // $oddelenie = DB::select('Select * from cars where car_id = id');
        return view('oddelenia.oddelenie', compact($oddelenie));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 

        // $oddelenie = DB::select('Select * from oddelenie where oddelenie_id = ?', [$id]);
        // $data = DB::select('Select users.id, users.name, users.email, users.user_zameranie, oddelenie.oddelenie_id, oddelenie.nazov, oddelenie.veduci from users
        // join zaradenie on users.id = zaradenie.zamestnanec_id join oddelenie on zaradenie.oddelenie_id = oddelenie.oddelenie_id
        // where oddelenie_id = ?', [$id]);
        // $car = DB::select('Select * from  where car_id = ?', [$id]);
        $index= '0';
        if(is_string($id))
            {$index = $id;}
        else{$index = $id[0]->oddelenie_id;}
        // dd($index);
        // $oddelenie = DB::select('Select users.id, users.name, users.email, users.pozicia, oddelenie.oddelenie_id, oddelenie.nazov, oddelenie.veduci from users
        //  join zaradenie on users.id = zaradenie.zamestnanec_id join oddelenie on zaradenie.oddelenie_id = oddelenie.oddelenie_id 
        //  where oddelenie.oddelenie_id = ?', [$index]);
        $oddelenie = DB::select('Select * from users
         join oddelenie on users.oddelenie_id =  oddelenie.oddelenie_id 
         where oddelenie.oddelenie_id = ?', [$index]);
        // $data = array(
        //     'hovno' => 'hovnooooo',
        //     'oddelenie' => $oddelenie,
        //     'zamestnanci' => $zamestnanci
        // );
        // dd($oddelenie);
        // return view('oddelenia.edit', compact($data));
        return view('oddelenia.edit', )->with('oddelenie', $oddelenie)->with('success','oddelenie bolo upravene');
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
        // dd($request->);
        // return redirect('/todos');
        // dd($request->veduci);
        if(!Auth()->check()){return redirect('/oddelenia')->with('error','neprihlaseny user'); }
        if(auth()->user()->pozicia == 'root' OR auth()->user()->pozicia == 'manazer' )
        {
            $oddelenie = DB::select('select * from oddelenie where oddelenie_id = ?', [$id]);
            // dd($oddelenie);
            $user = DB::select('select * from users where id = ?', [$oddelenie[0]->veduci_id]);
            // dd($user);
            if(empty($user)){return redirect('/oddelenia')->with('error','taky user neexistuje'); }
            // DB::update('update users set oddelenie_id =  where email = ?',[$oddelenie->veduci]);
            DB::update('update oddelenie set veduci = ?, nazov = ? where oddelenie_id = ?', [$request->veduci, $request->nazov, $id]);
            return redirect('/oddelenie')->with('success', 'oddelenie bolo zmenene');
        }
        return redirect('/oddelenie')->with('error','neopravneny pristup'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = Oddelenie::find($id);
        // $data = DB::select('select * from oddelenie where oddelenie_id = ?',[$id]);
        if(Auth::check())
        {
            if(auth()->user()->pozicia == 'root' OR auth()->user()->pozicia == 'manazer' )
            {
                // $data->delete();
                DB::delete('delete from oddelenie WHERE oddelenie_id = ?',[$id]);
                DB::update('update users set oddelenie_id = 0 WHERE oddelenie_id = ?',[$id]);
                return redirect('/oddelenie')->with('success','oddelenie bolo vymazane');
            }
        }
        return redirect('./')->with('error', 'Neopravneny pristup');
       
    }

    public function removeUser($id)
    {
        
        $project_id = DB::select('Select oddelenie_id from zaradenie where zamestnanec_id = ?',[$id]);
        // dd($project_id);
        // dd('removeUser');

        // DB::delete('Delete from zaradenie where zamestnanec_id = ?',[$id]);

        // return  redirect("../$project_id/edit"); 
        //  edit($project_id);
        return $this->edit($project_id)->with('success','zamestnanec bod odobraty');
    }
}
    



