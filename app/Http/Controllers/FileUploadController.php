<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $model = new File();

            $files = $model::where('user_id', Auth::id())
                ->orderBy('id', 'desc')->paginate(0);
            $response = [
                'data' => $files
            ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:' . File::getAllExtensions() . '|max:' . File::getMaxSize()
        ]);

        $file = new File();
        $uploaded_file = $request->file('file');
        $original_ext = $uploaded_file->getClientOriginalExtension();
        $name = time().'.'.$original_ext;
        $thumbnail = "thumbnail_".$name;

        $type = $file->getType($original_ext);

        if ($file->upload($type, $uploaded_file, $name)) {
            $file->createThumbnail($type, $name);

            return $file::create([
                'original_image' => $name,
                'thumbnail_image' => $thumbnail,
                'user_id' => Auth::id()
            ]);
        }

        return response()->json(false);
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);

        if (Storage::disk('local')->exists($file->getName('image', $file->original_image))) {
            if (Storage::disk('local')->delete($file->getName('image', $file->original_image))) {
                return response()->json($file->delete());
            }
        }

        return response()->json(false);
    }
}
