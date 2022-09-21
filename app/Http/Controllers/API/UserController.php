<?php

namespace App\Http\Controllers\API;
use App\Mail\VerifyMail;
use App\Models\Following;
use App\Models\Like;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\VerifyUser;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

#########
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Hash;


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
//        //$id = IdGenerator::generate(['table' => 'users', 'length' => 6, 'prefix' => date('y')]);
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
//    $user->password = $request->get('password');
//    $user->phone = $request->get('phone');
//    $user->image = $request->get('image');
//    $user->gender = $request->get('gender');
//    $user->notify = $request->get('notify');
//    $user->email = $request->get('email');
//    $user->birthdate = $request->get('birthdate');
//    $user->save();
//    return $this->returnData("user",$user);
//
//    }
    protected function store(Request $request)
    {
        $user = User::create([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'image' => $request->get('image'),
            'gender' => $request->get('gender'),
            'notify' => $request->get('notify'),
            'birthdate' => $request->get('birthdate'),
            'password' => Hash::make($request->get('password')),
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        \Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect('/login')->with('status', $status);
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
        $user = User::all();
        return $this -> returnData('users',$user);
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
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->password = $request->get('password');
        $user->phone = $request->get('phone');
        $user->image = $request->get('image');
        $user->gender = $request->get('gender');
        $user->notify = $request->get('notify');
        $user->email = $request->get('email');
        $user->birthdate = $request->get('birthdate');
        $user->save();
        return $this->returnData("user",$user);
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
    public function destroyComment($id)
    {
        //
        Comment::where('id', $id)->delete();
    }
    public function showComments()
    {
        Comment::all();
    }
    public function updateComment(Request $request, $id)
    {
        //
        $comment = Comment::find($id);
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
    public function removeFolloing($id)
    {
        //
        Comment::where('fuser_id', $id)->delete();
    }
    public function showFollowings()
    {
        Following::all();
    }
    public function like(Request $request)
    {
        Like::create($request->validate([
            'reel_id'=>'required',
            'user_id'=>'required',
            'active'=>'required',
        ]));
    }
    public function unlike($id)
    {
        Like::where('id', $id)->delete();
    }
    public function showLikes($reel_id)
    {
        Like::find($reel_id);
    }
}
