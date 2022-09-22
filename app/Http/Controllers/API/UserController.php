<?php

namespace App\Http\Controllers\API;

use App\Models\VerifyUser;
use App\Mail\VerifyMail;
use App\Http\Resources\UserResource;
use App\Models\Following;
use App\Models\Like;    
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

#########
use Haruncpi\LaravelIdGenerator\IdGenerator;


class UserController extends Controller
{
    use GeneralTrait;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//
////        $id = IdGenerator::generate(['table' => 'users', 'length' => 6, 'prefix' => date('y')]);
//
//        //
////        User::create($request->validate([
////            'name'=> 'required',
////            'password'=> 'required',
////            'mobile'=> 'required',
////            'email' => 'required|unique:Students'
////        ]));
////
//
//    $user = new User();
//    $user->name = $request->get('name');
//    $user->email = $request->get('email');
//    $user->password = $request->get('password');
//    $user->phone = $request->get('phone');
//    $user->birthdate = $request->get('birthdate');
//    $user->image = $request->get('image');
//    $user->gender = $request->get('gender');
//    $user->notify = $request->get('notify');
//    $user->email = $request->get('email');
//    $user->save();
//
//    return $this -> returnData('user',$user);
//    }

    protected function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->phone = $request->get('phone');
        $user->birthdate = $request->get('birthdate');
        $user->image = $request->get('image');
        $user->gender = $request->get('gender');
        $user->notify = $request->get('notify');
        $user->email = $request->get('email');
        $user->save();

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        \Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $users =  User::all();
        $user =  UserResource::collection($users) ;
        return $this -> returnData('Table OF users allowd admins only!!',$user);

//        return response()->json($user);

//        return new UserResource( User::all());

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $User = User::find($request->id);
        $User->name = $request->name;
        $User->password = $request->password;
        $User->mobile = $request->mobile;
        $User->email = $request->email;
        $User->save();

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
        User::where('id', $id)->delete();
    }

    public function createComment(Request $request)
    {
        //
        Comment::create($request->validate([
            'reel_id'=> 'required',
            'content'=> 'required'
            ]));
    }
    public function destroyComment(Request $request)
    {
        //
        Comment::where('id', $request->id)->delete();
    }
    public function showComments()
    {

        $comments =  Comment::all();
        $comment =  ReelResource::collection($comments) ;
        return $this -> returnData('Table OF COMMENTS allowd admins only!!',$comment);
    }
    public function updateComment(Request $request)
    {
        //
        $comment = Comment::find($request->id);
        $comment->reel_id = $request->reel_id;
        $comment->content = $request->contents;
        $comment->save();
    }

    public function followUser(Request $request)
    {
        //
        Following::create($request->validate([
                'user_id'=> 'required',
                'duser_id'=> 'required',
            ]));
    }
    public function removeFollowing(Request $request)
    {
        //
        Comment::where('fuser_id', $request->id)->delete();
    }
    public function showFollowings()
    {

        $follows =   Following::all();
        $follow =  UserResource::collection($follows) ;
        return $this -> returnData('Table OF follows allowd admins only!!',$follow);
    }
    public function like(Request $request)
    {
        Like::create($request->validate([
            'reel_id'=>'required',
            'user_id'=>'required',
            'active'=>'required',
        ]));
    }
    public function unlike(Request $request)
    {
        Like::where('id', $request->id)->delete();
    }
    public function showLikes(Request $request)
    {
        Like::find($request->id);
    }
}
