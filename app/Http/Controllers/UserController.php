<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class UserController extends Controller
{
    // Returns all users
    public function index()
    {
        $request = Request::create('/api/users', 'GET');
        $users = Route::dispatch($request);

        $response = [];
        if($users->getStatusCode() == 200) {

            $response = [
                'error' => false,
                'data' => $users->getData()->data
            ];
        }
        else{
            $response = [
                'error' => true,
                'message' => $users->exception->getMessage()
            ];
        }
        // echo '<pre>'.var_export($response, true).'</pre>';exit;

        return view('users/users', compact('response'));
    }

    // Returns specific user
    public function viewUser($userID) {
        
        $request = Request::create("/api/users/$userID", 'GET');
        $user = Route::dispatch($request);
        if($user->getStatusCode() == 200) {

            $response = [
                'error' => false,
                'data' => $user->getData()->data
            ];
        }
        else{
            $response = [
                'error' => true,
                'message' => $user->exception->getMessage()
            ];
        }
        // dd($response['data']->id);
        return view('users/single_user', compact('response'));
        // dd($user);
    }

    // Provides interface to update user
    public function editUser($userID) {
        
        $userData = $this->viewUser($userID)->getData();
        return view('users/edit_user')->with($userData);
    }
}
