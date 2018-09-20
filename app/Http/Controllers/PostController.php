<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
use App\MyModel;

class PostController extends Controller
{
    /**
     * [viewUserPosts description]
     * @return [type] [description]
     */
    public function viewUserPosts()
    {
        $user_id =Auth::user()->id;

        $user = User::find($user_id);
        $friends = $user->getFriends()->toArray();
        
        $array = [] ;
        foreach ($friends as $key=>$value) {
            $id =  $value['id'];
            array_push($array, $id);
        }
        $posts = MyModel::getPostData($array);

        
        $data['posts'] = json_decode(json_encode($posts), true);
        $data['count'] = count($user->getFriendRequests()->toArray());
        /*print_r($data['posts']);
        die();*/
        $data['friends_count'] = count($user->getAcceptedFriendships()->toArray());
        return view('post.viewMyPosts', $data);
    }
    /**
     * [addNewPost description]
     */
    public function addNewPost()
    {
        $user_id =Auth::user()->id;
        $user = User::find($user_id);
        $data['count'] = count($user->getFriendRequests()->toArray());
        $data['friends_count'] = count($user->getAcceptedFriendships()->toArray());
        return view('post.addNewPost', $data);
    }
    /**
     * [submitPost description]
     * @return [type] [description]
     */
    public function submitPost(Request $request)
    {
        $rules = array(
            'post_title'       => 'required',
            'post_description' => 'required',
            'post_image'       => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $file = $request->file('post_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = 'public/files';
            $file->move($destinationPath, $file->getClientOriginalName());
            $postData = array(
                'post_title'       => $request->input("post_title"),
                'post_description' => $request->input("post_description"),
                'post_image'       => $fileName,
                'user_id'          => Auth::user()->id
            );
            $user = MyModel::insert('posts', $postData);
            if ($user) {
                return redirect('/viewposts')->with('message', 'Post successfully added');
            } else {
                return redirect()->back()->withInput()->withErrors(__('messages.try_again'));
            }
        }
    }

    public function getLikes()
    {
        echo "hello";
        die();
    }
}
