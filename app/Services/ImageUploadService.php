<?php

namespace App\Services;

use App\Models\Topic;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadService
{
    protected $allowedExt = ['jpg', 'gif', 'png', 'jpeg'];

    /**
     * Process image upload
     *
     * @param $file
     * @param $folder
     * @param string $picture
     * @param bool $maxWidth
     * @return array|bool
     */
    public function imageUpload($file, $picture, $folder, $maxWidth = false)
    {
        $folderName = "uploads/images/$folder/";
        $uploadPath = public_path() . '/' .$folderName;
        //delete images old and not file default if using update topic
        if (!empty($picture) && file_exists(public_path(Topic::DEFAULT_PATH_TOPIC))) {
            $filePictureOld = public_path($picture);
            if (file_exists($filePictureOld)) {
                unlink($filePictureOld);
            }
        }
        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';
        $fileName = time() . '_' . Str::random(10) . '.' .$extension;
        if (!in_array($extension, $this->allowedExt)) {
            return false;
        }

        $file->move($uploadPath, $fileName);

        if ($maxWidth && $extension != 'gif') {
            $this->reduceSize($uploadPath . '/' . $fileName, $maxWidth);
        }

        return [
            'path' => $fileName,
        ];
    }

    /**
     * Reduce size file
     *
     * @param $filePath
     * @param $maxWidth
     */
    public function reduceSize($filePath, $maxWidth)
    {
        $image = Image::make($filePath);
        //resize the image to a max width and constrain aspect ratio (auto height)
        $image->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save();
    }
}