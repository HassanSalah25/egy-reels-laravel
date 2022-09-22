<?php

namespace App\Http\Controllers\API;
use App\Http\Resources\CommentResource;
use App\Http\Resources\FollowResources;
use App\Http\Resources\ReelResource;
use App\Http\Resources\UserResource;
use App\Models\Following;
use App\Models\Like;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
 use App\Helpers\Helper;
use Illuminate\Support\Str;
use Validator;
#########
use Haruncpi\LaravelIdGenerator\IdGenerator;


class UserController extends Controller
{
    use GeneralTrait;

    #####################################
    function save(Request $request){
        /** Validate name field */
        $request->validate([
            'name'=>'required',
        ]);

        $user = new User();
         $user_id =  Str::uuid()->toString();

        $user->user_id = $user_id;
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

        return $this -> returnData('user',$user);

//        if($user){
//            return back()->with('success','New user has been added');
//        }else{
//            return back()->with('faild','Something went wrong');
//        }


    }
    #############################################
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
    public function update(Request $request, $id)
    {
        //
        $User = User::find($id);
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
    public function destroyComment($id)
    {
        //
        Comment::where('id', $id)->delete();
    }
    public function showComments()
    {

        $comments =  Comment::all();
        $comment =  CommentResource::collection($comments) ;
        return $this -> returnData('Table OF COMMENTS allowd admins only!!',$comment);
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
    public function removeFollowing($id)
    {
        //
        Comment::where('fuser_id', $id)->delete();
    }
    public function showFollowings()
    {

        $follows =   Following::all();
        $follow =  FollowResources::collection($follows) ;
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
    public function unlike($id)
    {
        Like::where('id', $id)->delete();
    }
    public function showLikes($reel_id)
    {
        Like::find($reel_id);
    }
}
