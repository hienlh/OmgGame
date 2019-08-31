<?php

namespace OmgGame\Helpers\Firebase;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use OmgGame\Helpers\Firebase\Traits\FirebaseSingletonTrait;

class FirebaseHelper
{
    use FirebaseSingletonTrait;

    protected $serviceAccount;
    protected $storage;
    protected $bucket;
    protected $bucketName;

    private function __construct()
    {
        $this->serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/omggame.json');
        $this->storage = (new Factory)
            ->withServiceAccount($this->serviceAccount)
            ->create()->getStorage();
        $this->bucketName = env('FIREBASE_STORAGE_BUCKET', 'omggame-d441a.appspot.com');
        $this->bucket = $this->storage->getBucket($this->bucketName);
    }

    public function upload($file, $folder)
    {
        if ($folder) {
            if (!strpos($folder, '/')) $folder .= '/';
        }
        $new_name = ($folder ?? '') . time() . rand() . '.' . $file->getClientOriginalExtension();
        $this->bucket->upload(fopen($file, 'r'), [
            'name' => $new_name
        ]);
        return 'https://firebasestorage.googleapis.com/v0/b/' . $this->bucketName . '/o/' .
            str_ireplace('/', '%2F', $new_name) . '?alt=media';
    }

    /**
     * @param $url String Example: https://firebasestorage.googleapis.com/v0/b/omggame-d441a.appspot.com/o/games%2F15672438921622257668.jpg?alt=media
     * @return bool
     */
    public function delete($url)
    {
        try {
            $matches = array();
            preg_match('/\/b\/(.*?)\/o\//s', $url, $matches);
            if (count($matches) < 1) return false;
            $bucket_name = $matches[1];
            $matches = array();
            preg_match('/\/o\/(.*?)\?/s', $url, $matches);
            if (count($matches) < 1) return false;
            $file_name = str_ireplace('%2F', '/', $matches[1]);
            $this->storage->getBucket($bucket_name)->object($file_name)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
