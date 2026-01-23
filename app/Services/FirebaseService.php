<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Messaging;

class FirebaseService
{
    protected Database $database;
    protected Messaging $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount([
                "type" => "service_account",
                "project_id" => env('FIREBASE_PROJECT_ID'),
                "private_key_id" => env('FIREBASE_PRIVATE_KEY_ID'),
                "private_key" => str_replace('\\n', "\n", env('FIREBASE_PRIVATE_KEY')),
                "client_email" => env('FIREBASE_CLIENT_EMAIL'),
                "client_id" => env('FIREBASE_CLIENT_ID'),
                "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                "token_uri" => "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url" => env('FIREBASE_CLIENT_CERT_URL'),
            ])
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

        $this->database = $factory->createDatabase();
        $this->messaging = $factory->createMessaging();
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function getMessaging(): Messaging
    {
        return $this->messaging;
    }
}
