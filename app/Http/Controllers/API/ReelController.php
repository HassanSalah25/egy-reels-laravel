<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReelResource;
use App\Models\Reel;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

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
        $rules = [
            'name'=> 'required',
            'caption'=> 'required',
            'video_url'=> 'required',
            'likes_count'=> 'required',
            'comments_count' => 'required|'
        ];

        $validator = Validator::make($request->all(), $rules);
        //

//        # prevent HTML and JS tags from being executed
//        $cleaned_name = strip_tags($request->input('name'));
//
//        #SQL inject Prevention:is to rewrite the initial query using a parameterized query.
//        DB::table('users')
//            ->select('name', 'email')
//            ->whereRaw('uuid = ?', $uuid)->first();
//


        if ($validator->fails()) {
            abort(404);
        }else {
            //Run query
            # prevent HTML and JS tags from being executed
            $cleaned_name = strip_tags($request->get('name'));
            ###################

            $reel = new Reel();
            $reel->name = $request->get('name');
            $reel->caption = $request->get('email');
            $reel->video_url = $request->get('password');
            $reel->likes_count = $request->get('phone');
            $reel->comments_count = $request->get('birthdate');

            $reel->save();



            return $reel;


        }



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
        #SQL inject Prevention:is to rewrite the initial query using a parameterized query.
//        DB::table('reels')
//            ->s('id','name',
//                'caption',
//                'video_url',
//                'likes_count',
//                'comments_count')
//            ->whereRaw('id = ?', $id)->first();

        return redirect()->back();
    }
}
