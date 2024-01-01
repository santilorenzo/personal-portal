<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Exception\Auth\UserNotFound;

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }

    // Register a new user using Firebase
    public function register(Request $request)
    {
        // Validate the request data (you may customize this based on your requirements).
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Extract user credentials from the request.
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            // Create the user in Firebase Authentication.
            $user = Firebase::auth()->createUserWithEmailAndPassword($email, $password);

            // You can customize this part based on your application's requirements.
            // For example, you might want to store additional user information in your database.
            // You can store the generated uid as your user's id in your database
            // and retrieve it when authenticating your users.
            $userProperties = [
                'email' => $user->email,
                'emailVerified' => $user->emailVerified,
                'uid' => $user->uid,
            ];

            // Create the user in your Firebase realtime database
            // using the data obtained from the Firebase Authentication API
            $user = Firebase::database()->getReference('users')
                ->push($userProperties);

            // Authenticate the user with Firebase.
            $customToken = Firebase::auth()->createCustomToken($userProperties['uid']);

            // Sign the user in to your application.
            $signInResult = Firebase::auth()->signInWithCustomToken($customToken);

            // Retrieve the Firebase session variables.
            $idToken = $signInResult->idToken();
            $accessToken = $signInResult->refreshToken();

            // Set session variables.
            session()->put('uid', $userProperties['uid']);
            session()->put('email', $userProperties['email']);
            session()->put('idToken', $idToken);
            session()->put('accessToken', $accessToken);

            // Redirect to the home page.
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Handle Firebase authentication errors.
            return response()->json(['message' => 'User creation failed', 'error' => $e->getMessage()], 500);
        }
    }
}
