<?php

namespace App\Http\Controllers;

use App\Models\Flit;
use Brainstud\FileVault\Facades\FileVault;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RahulHaque\Filepond\Facades\Filepond;

class FlitController extends Controller
{
    private $slug;

    private $filesize;

    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|max:255',
        ]);

        $this->generateSlug();
        $this->moveUploadedFile($request->upload);

        Flit::create([
            'slug' => $this->slug,
            'filesize' => $this->filesize,
            'password' => Hash::make($request->password),
            'expires' => Carbon::now()->addDay(1)->toDateTimeString(),
        ]);

        return redirect('result')->with('slug', $this->slug);
    }

    public function show(Flit $flit)
    {
        $path = Storage::disk('share')->files($flit->slug)[0];

        return view('download', [
            'filename' => pathinfo($path, PATHINFO_FILENAME),
            'filesize' => $this->formatBytes($flit->filesize),
            'slug' => $flit->slug,
            'expires' => $flit->expires,
        ]);
    }

    public function result()
    {
        $resultSlug = session()->get('slug');
        if ($resultSlug) {
            return view('result', compact('resultSlug'));
        }

        return back();
    }

    public function destroy(Flit $flit)
    {
        $flit->delete();

        Storage::disk('share')->deleteDirectory($flit->slug);

        return redirect()->route('flit.index');
    }

    public function download(Flit $flit, Request $request)
    {
        $request->validate([
            'password' => 'required|max:255',
        ]);

        // verify password
        $hashedPassword = $flit->password;
        if (! Hash::check($request->password, $hashedPassword)) {
            return back()->withErrors(['password' => 'The password you entered is incorrect']);
        }

        $this->slug = $flit->slug;
        $path = Storage::disk('share')->files($this->slug)[0];
        $filename = pathinfo($path, PATHINFO_FILENAME);

        return response()->streamDownload(function () use ($path) {
            // decrypt file to download
            FileVault::disk('share')->streamDecrypt($path);
            //delete file folder
            Storage::disk('share')->deleteDirectory($this->slug);
            // delete from database
            Flit::where('slug', $this->slug)->delete();
        }, $filename);
    }

    private function generateSlug(): void
    {
        $slug = Str::random(8);
        while (Flit::where('slug', $slug)->exists()) {
            $slug = Str::random(8);
        }
        $this->slug = $slug;
    }

    private function moveUploadedFile($field): void
    {
        $file = Filepond::field($field)->getFile();
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $path = $this->slug.DIRECTORY_SEPARATOR.$filename;
        $this->filesize = $file->getSize();

        Filepond::moveTo($path, 'share');
        FileVault::disk('share')->encrypt($this->slug.DIRECTORY_SEPARATOR.$file->getClientOriginalName());
    }

    private function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'T'];

        return round(pow(1024, $base - floor($base)), $precision).' '.$suffixes[floor($base)];
    }
}
