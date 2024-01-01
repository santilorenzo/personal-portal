<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\UserRecord;

class FirebaseUserProvider implements UserProvider
{
    protected $firebaseAuth;
    protected $hasher;
    protected $model;

    public function __construct(FirebaseAuth $firebaseAuth, $hasher, $model)
    {
        $this->firebaseAuth = $firebaseAuth;
        $this->hasher = $hasher;
        $this->model = $model;
    }

    private function getUser(UserRecord $userRecord) {
        $user = new $this->model;
        $user->id = $userRecord->uid;
        $user->name = $userRecord->displayName;
        $user->email = $userRecord->email;
        $user->picture = $userRecord->photoUrl;
        return $user;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier) {
        $user = $this->firebaseAuth->getUser($identifier);
        return $this->getUser($user);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token) {
        $user = $this->firebaseAuth->getUser($identifier);
        return $this->getUser($user);
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token) {
        // Do nothing
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials) {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
            array_key_exists('password', $credentials))) {
            return;
        }

        // Here, $credentials['idToken'] should contain the Firebase ID token sent by the client.
        // Verify the ID token and retrieve the user information.
        try {
            $verifiedToken = $this->firebaseAuth->verifyIdToken($credentials['idToken']);
            $uid = $verifiedToken->getClaim('sub');

            // Retrieve user information from Firebase or your database.
            // For example, using Firebase Auth to get additional user details:
            $userRecord = $this->firebaseAuth->getUser($uid);

            // Create a new instance of your User model or any class implementing Authenticatable.
            // You may need to map Firebase user details to your user model properties.
            return $this->getUser($userRecord);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., token verification failure)
            return null;
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials) {
        return $this->hasher->check($credentials['password'], $user->getAuthPassword());
    }

    public function check() {
        
    }
}
