<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Chat;
use Auth;
use App\UserRequest;

class ChatController extends Controller
{
    public function index()
    {
        // Get all users except current logged in
        $users = User::where('id', '!=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(8);
        return view('chatapp.inicio', compact('users'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('entrar');
    }

    public function usersChat($id)
    {
        $receptorUser = User::where('id', '=', $id)->first();
        if($receptorUser == null) {
            return view('chatapp.nousernamefinded', compact('userName'));
        }else {
            $users = User::where('id', '!=', Auth::user()->id)->take(10)->get();
            $chat = $this->hasChatWith($receptorUser->id);
            return view('chatapp.chat', compact('receptorUser', 'chat', 'users'));
        }
    }

    public function hasChatWith($userId)
    {
        $chat = Chat::where('user_id1', Auth::user()->id)
            ->where('user_id2', $userId)
            ->orWhere('user_id1', $userId)
            ->where('user_id2', Auth::user()->id)
            ->get();
        if(!$chat->isEmpty()){
          $updateChat = Chat::find($chat[0]['id']);
          if(Auth::user()->id == $updateChat->user_id1){
            $updateChat->user_id1_read="2";
          }
          if(Auth::user()->id == $updateChat->user_id2){
            $updateChat->user_id2_read="2";
          }
          $updateChat->save();
          return $chat->first();
        }else{
            return $this->createChat(Auth::user()->id, $userId);;
        }
    }

    public function createChat($userId1, $userId2)
    {
        $chat = Chat::create([
            'user_id1' => $userId1,
            'user_id2' => $userId2
        ]);
        return $chat;
    }

    public function updateMessageMysql()
    {
        $apidata = request();
        $updateChat = Chat::find($apidata['chatId']);
        $updateChat->message=$apidata['textmessage'];
        if($apidata['userId'] == $updateChat->user_id1){
          $updateChat->user_id1_read="2";
          $updateChat->user_id2_read="1";
        }else{
          $updateChat->user_id1_read="1";
          $updateChat->user_id2_read="2";
        }
        $updateChat->updated_at=date('Y-m-d H:i:s');
        $updateChat->save();
    }

    public function adminUsersChat($id){

        $receptorUser = User::where('id', '=', $id)->first();
        if($receptorUser == null) {
            return view('admin.chatapp.chat', compact('userName'));
        }else {
            $users = User::where('id', '!=', Auth::user()->id)->take(10)->get();
            $chat = $this->hasChatWith($receptorUser->id);
            return view('admin.chatapp.chat', compact('receptorUser', 'chat', 'users'));
        }
    }

}
