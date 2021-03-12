<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $files = File::where('user_id', '=', auth()->id())->get();
            return view('file.fileList', compact('files'));
        } catch (\Exception $ex) {
            echo $ex->getMessage();

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = new File();
                $url = Storage::disk('public')->putFile('files/', $request->file);
                if ($url) {
                    $file->slug = $this->createSlug($this->generateRandomString(5));
                    $file->original_name = $request->file('file')->getClientOriginalName();
                    $file->path = $url;
                    $file->user_id = auth()->id();
                    $file->save();

                    $returnHTML = view('file.modal')->with('file', $file)->render();
                    return response()->json(array('success' => true, 'html' => $returnHTML));

                }
                return response()->json(array('success' => false, 'message' => 'Problem'));
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage();

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file, $slug)
    {
        try {
            $file = $file->where('slug', '=', $slug)->first();
            return view('file.details', compact('file'));
        } catch (\Exception $ex) {
            echo $ex->getMessage();

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        try {
            $delete = Storage::disk('public')->delete($file->path);
            if ($delete) {
                $file->delete();
                return response()->json(array('success' => $delete));
            }
            return response()->json(array('success' => $file->path));
        } catch (\Exception $ex) {
            echo $ex->getMessage();

        }

    }

    /**
     * @param $title
     * @param int $id
     * @return string
     */
    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    /**
     * @param $slug
     * @param int $id
     * @return mixed
     */
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return File::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    /**
     * @param int $length
     * @return string
     */
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param File $file
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(File $file, $id)
    {
        try {
            $file = $file->find($id);
            $file->update(['count_download' => $file->count_download + 1]);
            return response()->download(storage_path("app/public/{$file->path}"));
        } catch (\Exception $ex) {
            echo $ex->getMessage();

        }


    }
}
