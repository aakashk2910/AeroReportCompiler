<?php
/**
 * Aakash Kamble
 * Created: 27/6/16 11:33 PM
 * Copyright (c) 2016
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Pic;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class FileEntryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return view('profile');
    }

    public function add() {

        $file = Request::file('filefield');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        $id = DB::table('pics')->where('id', Auth::user()->id);
        if($id){
            $entry = Pic::FindOrNew($id);
        }
        else{
            $entry = new Pic();
        }
        $entry->userId = Auth::user()->id;
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;
        $entry->country = Request::input('country');
        $entry->state = Request::input('state');
        $entry->city = Request::input('city');
        $entry->profession = Request::input('profession');

        $entry->save();

        return redirect('/profile');

    }

    public function get($filename){

        $entry = Pic::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);
    }

}