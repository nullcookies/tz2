<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Image;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_image',  'thumbnail_image', 'user_id'
    ];

    public static $image_ext = ['jpg', 'jpeg', 'png'];

    public static function getMaxSize()
    {
        return (int)ini_get('upload_max_filesize') * 1000;
    }

    public function getUserDir()
    {
        return Auth::user()->name . '_' . Auth::id();
    }

    public static function getAllExtensions()
    {
        $merged_arr = array_merge(self::$image_ext);
        return implode(',', $merged_arr);
    }

    public function getType($ext)
    {
        if (in_array($ext, self::$image_ext)) {
            return 'image';
        }

    }

    public function getName($type, $name)
    {
        return 'public/' . $this->getUserDir() . '/' . $type . '/' . $name;
    }

    public function upload($type, $file, $name)
    {
        $path = 'public/' . $this->getUserDir() . '/' . $type;

        return Storage::putFileAs($path, $file, $name);
    }

    public function createThumbnail($type, $name)
    {
        $img = Image::make(public_path('/storage/'.$this->getUserDir() . '/' . $type.'/'.$name));
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save(public_path('/storage/'.$this->getUserDir() . '/' . $type.'/thumbnail_'.$name));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
