<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Config;
use App\MyModel;
use Validator;

class UserController extends Controller
{

	 /**
    * [addFriend description]
    * @param [type] $id [description]
    */
    public function addFriend($id)
    {
        $user_id =Auth::user()->id;
        $user = User::find($user_id);
        $recipient = User::find($id);
        if (! $user->hasSentFriendRequestTo($recipient)) {
        $user->befriend($recipient);
        return redirect('friendSuggestionList')->with('success', 'friend request sent successfully');
        }
    }

    /**
    * [friendSuggestionList description]
    * @return [type] [description]
    */
    public function friendSuggestionList()
    {
        $user_id =Auth::user()->id;
        $user = User::find($user_id);
        $data['users'] = User::get()->toArray();
        $data['count'] = count($user->getFriendRequests()->toArray());
        $data['friends_count'] = count($user->getAcceptedFriendships()->toArray());
        foreach ($data['users'] as $key => $value) {
            $recipient_id = $data['users'][$key]['id'];
            $recipient = User::find($recipient_id);
            if ($user->hasSentFriendRequestTo($recipient)) {
                $data['users'][$key]["status"] = Config::get('constants.PENDING');
            } elseif ($user->isBlockedBy($recipient)) {
                $data['users'][$key]["status"] = Config::get('constants.BLOCKED');
            } elseif ($user->isFriendWith($recipient)) {
                $data['users'][$key]["status"] = Config::get('constants.ACCEPTED');
            } elseif ($user->hasFriendRequestFrom($recipient)) {
                $data['users'][$key]["status"] = Config::get('constants.INCOMING_PENDING');
            } else {
                $data['users'][$key]["status"] = Config::get('constants.NO_RELATION');
            }
        }
        return view('user.friendSuggestionList', $data);
    }

    public function friendsList()
    {
        $user_id =Auth::user()->id;
        $user = User::find($user_id);
        //$recipient = User::find($id);
        echo "<pre>";
        $friends = $user->getAcceptedFriendships()->toArray();
        print_r($friends);
        die();
       
    }
}
