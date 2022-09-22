<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReelResource;
use App\Models\Reel;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;


class ReelController extends Controller
{
    use GeneralTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Reel::create($request->validate([
            'name'=> 'required',
            'password'=> 'required',
            'mobile'=> 'required',
            'email' => 'required|unique:Students'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $reels = Reel::all();
        $reel =  ReelResource::collection($reels) ;
//        return 'HOLAA!!!';
        return $this -> returnData('Table OF Reels allowd admins only!!',$reel);


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $Reel = Reel::find($id);
        $Reel->name = $request->name;
        $Reel->password = $request->password;
        $Reel->mobile = $request->mobile;
        $Reel->email = $request->email;
        $Reel->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Reel::where('id', $id)->delete();
        return redirect('students');
    }
}
