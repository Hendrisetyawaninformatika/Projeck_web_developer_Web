<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\Auth\EmailExists;
use Exception;

class FirebaseAuthService
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/service-account.json'));
        
        $this->auth = $factory->createAuth();
    }

    public function createUser(string $email, string $password, string $name): array
    {
        try {
            $userProperties = [
                'email' => $email,
                'password' => $password,
                'displayName' => $name,
            ];

            $createdUser = $this->auth->createUser($userProperties);
            
            return [
                'success' => true,
                'uid' => $createdUser->uid,
                'email' => $createdUser->email,
            ];
        } catch (EmailExists $e) {
            return ['success' => false, 'error' => 'Email sudah terdaftar'];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function signIn(string $email, string $password): array
    {
        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            $idToken = $signInResult->idToken();
            
            return [
                'success' => true,
                'id_token' => $idToken,
                'uid' => $signInResult->data()['localId'] ?? null,
            ];
        } catch (InvalidPassword $e) {
            return ['success' => false, 'error' => 'Password salah'];
        } catch (UserNotFound $e) {
            return ['success' => false, 'error' => 'User tidak ditemukan'];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function verifyIdToken(string $idToken): array
    {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
            return [
                'success' => true,
                'uid' => $verifiedIdToken->claims()->get('sub'),
                'email' => $verifiedIdToken->claims()->get('email'),
            ];
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Token tidak valid'];
        }
    }

    public function sendPasswordReset(string $email): array
    {
        try {
            $this->auth->sendPasswordResetLink($email);
            return ['success' => true, 'message' => 'Email reset password telah dikirim'];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function getUser(string $uid): ?array
    {
        try {
            $user = $this->auth->getUser($uid);
            return [
                'uid' => $user->uid,
                'email' => $user->email,
                'displayName' => $user->displayName,
                'photoUrl' => $user->photoUrl,
            ];
        } catch (Exception $e) {
            return null;
        }
    }

    public function deleteUser(string $uid): bool
    {
        try {
            $this->auth->deleteUser($uid);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}