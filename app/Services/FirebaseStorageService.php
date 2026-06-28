<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Illuminate\Http\UploadedFile;
use Exception;

class FirebaseStorageService
{
    protected $storage;
    protected $bucket;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/service-account.json'))
            ->withDefaultStorageBucket(config('firebase.projects.app.storage.bucket'));

        $this->storage = $factory->createStorage();
        $this->bucket = $this->storage->getBucket();
    }

    public function uploadFile(UploadedFile $file, string $path): ?string
    {
        try {
            $fileName = $path . '/' . uniqid() . '_' . $file->getClientOriginalName();
            
            $object = $this->bucket->upload(
                fopen($file->getRealPath(), 'r'),
                [
                    'name' => $fileName,
                    'metadata' => [
                        'contentType' => $file->getMimeType(),
                    ],
                ]
            );

            // Buat URL publik
            $object->update(['acl' => []], ['predefinedAcl' => 'publicRead']);
            
            return "https://storage.googleapis.com/" . config('firebase.projects.app.storage.bucket') . "/" . $fileName;
        } catch (Exception $e) {
            \Log::error('Firebase Storage Error: ' . $e->getMessage());
            return null;
        }
    }

    public function deleteFile(string $fileUrl): bool
    {
        try {
            $path = parse_url($fileUrl, PHP_URL_PATH);
            $path = ltrim($path, '/');
            $bucketName = config('firebase.projects.app.storage.bucket') . '/';
            $path = str_replace($bucketName, '', $path);
            
            $this->bucket->object($path)->delete();
            return true;
        } catch (Exception $e) {
            \Log::error('Firebase Delete Error: ' . $e->getMessage());
            return false;
        }
    }
}