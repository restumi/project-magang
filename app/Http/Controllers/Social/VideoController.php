<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\HttpCache\Store;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with(['user', 'comments'])->latest()->get();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url_video' => 'required|file|mimes:mp4,mov,avi,wmv,flv,webm|max:51200'
        ],
        [
            'url_video.required' => 'Video wajib diupload.',
            'url_video.file' => 'File yang diupload harus berupa video.',
            'url_video.mimes' => 'Format video tidak didukung. Gunakan: MP4, MOV, AVI, WMV, FLV, atau WebM.',
            'url_video.max' => 'Ukuran video maksimal 50MB.'
        ]);

        $path = $request->file('url_video')->store('videos', 'public');

        Video::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'url_video' => $path
        ]);

        return redirect()->route('videos.index')->with('success', 'new video uploaded!');
    }

    public function update(Request $request, Video $video)
    {
        if($video->user_id != auth()->id()){
            abort(403);
        }

        $request->validate([
            'title' => 'required|string',
            'url_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,flv,webm|max:51200'
        ],
        [
            'url_video.file' => 'File yang diupload harus berupa video.',
            'url_video.mimes' => 'Format video tidak didukung. Gunakan: MP4, MOV, AVI, WMV, FLV, atau WebM.',
            'url_video.max' => 'Ukuran video maksimal 50MB.'
        ]);

        $data = [
            'title' => $request->title
        ];

        if($request->hasFile('url_video')){
            if($video->url_video){
                Storage::disk('public')->delete($video->url_video);
            }

            $newPath = $request->file('url_video')->store('videos', 'public');
            $data['url_video'] = $newPath;
        }

        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'video updated!');
    }

    public function destroy(Video $video)
    {
        if($video->user_id != auth()->id()){
            abort(403);
        }

        if($video->url_video){
            Storage::disk('public')->delete($video->url_video);
        }

        $video->comments()->delete();
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'video deleted!');
    }
}
