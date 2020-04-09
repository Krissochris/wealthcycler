<?php

namespace App\Helpers;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileManager {

    public function __construct()
    {

    }

    public function upload(UploadedFile $file, $directory)
    {
        $input = null;

        $input['photo_name'] = time().'.'.$file->getClientOriginalExtension();

        $input['photo_url_part'] = "storage/images/$directory";
        $input['photo_url'] = null;

        try {

            $env = env('FILESYSTEM_DRIVER');
            if ($env === 'cloud') {

                $input['photo_url'] = env('AWS_URL').'/';
                $input['photo_url'] .= Storage::disk('s3')->putFileAs('/'.$input['photo_url_part'], $file,$input['photo_name'], 'public');
            } else {
                $input['photo_url'] = asset($input['photo_url_part']) .'/'. $input['photo_name'];
                $file->storeAs("public/images/$directory", $input['photo_name']);

            }
        } catch ( \Exception $exception) {
            return false;
        }

        if ($input['photo_url']) {
            return $input['photo_url'];
        }

        return false;
    }


    public function update(UploadedFile $file, $file_path, $directory)
    {
        if ($this->delete($file_path, $directory)) {
            return $this->upload($file, $directory);
        }

        return false;
    }


    public function delete($file_path, $directory)
    {
        if (!$file_path) {
            return true;
        }
        $env = env('FILESYSTEM_DRIVER');

        $photo_name =  (last(explode('/',$file_path)));

        try {
            if ($env === 'local') {

                $deleted = Storage::delete("public/images/$directory/".$photo_name);
                if ($deleted) {
                    return true;
                }

            } elseif ($env === 'cloud') {
                $file = substr($file_path, strlen(env('AWS_URL').'/'));

                $deleted = Storage::disk('s3')->delete($file);
                if ($deleted) {
                    return true;
                }
            }
        } catch ( \Exception $exception) {
            return false;
        }
        return false;

    }

}
