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
            //Path to service account file
            ->withServiceAccount(storage_path('app/firebase_credentials.json'))
            //Change This to firebase realtime database path
            ->withDatabaseUri('https://inventory-uas-web-default-rtdb.firebaseio.com');

        $this->database = $factory->createDatabase();
        $this->messaging = $factory->createMessaging();
    }

    public function getDatabase()
{
    return (new Factory)
        ->withServiceAccount(
            base_path(env('FIREBASE_CREDENTIALS'))
        )
        ->withDatabaseUri(env('FIREBASE_DATABASE_URL'))
        ->createDatabase();
}

    public function getMessaging(): Messaging
    {
        return $this->messaging;
    }
}
