<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller {

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     *
     * login
     */
    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        if (empty($email) or empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all fields']);
        }

        try {

            $tokenRequest = Request::create('/oauth/token', 'post', [
                'client_secret'  => config('service.passport.client_secret'),
                'grant_type'     => config('service.passport.grant_type'),
                'client_id'      => config('service.passport.client_id'),
                'username'       => $request->email,
                'password'       => $request->password
            ]);

            return app()->handle($tokenRequest);


        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     *
     * register
     */
    public function register(Request $request) {

        $email      = $request->email;
        $fname      = $request->first_name;
        $lname      = $request->last_name;
        $password   = $request->password;

        if(empty($email) || empty($fname) || empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'Please provide your email name and password']);
        }

        try {
            $user = new User();
            $user->first_name   = $fname;
            $user->last_name    = $lname;
            $user->email        = $email;
            $user->password     = app('hash')->make($password);

            if($user->save()) {
                return $this->login($request);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
