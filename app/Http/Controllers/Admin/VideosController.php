<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideosRequest;
use App\Models\Department;
use App\Models\Language;
use App\Models\Question;
use App\Models\Video;
use Illuminate\Http\Request;use Illuminate\Support\Str;use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
class VideosController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Videos';

        $this->middleware(['permission:videos'])->only('index');
        $this->middleware(['permission:videos_create'])->only('create', 'store');
        $this->middleware(['permission:videos_edit'])->only('edit', 'update');
        $this->middleware(['permission:videos_delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Log::info('This is some useful information.');
        return view('admin.video.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['departments'] = Department::where('status', Status::ACTIVE)->get();
        $this->data['languages'] = Language::get();
        $this->data['questions'] = Question::get();
        return view('admin.video.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $video = new Video;

        $video->department_id = $request->department_id;
        $video->language_id = $request->language_id;
        $video->video_url = $request->video_url;
        $video->questions =         implode(',', $request->questions);
        $video->save();





//        Video::create($input);

        return redirect()->route('admin.videos.index')->with('success','Video created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LanguageLocation  $languageLocation
     * @return \Illuminate\Http\Response
     */
    public function show(Video $languageLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LanguageLocation  $languageLocation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['video']  = Video::findOrFail($id);
        $this->data['departments'] = Department::where('status', Status::ACTIVE)->get();
        $this->data['languages'] = Language::get();
        $this->data['questions'] = Question::get();

        return view('admin.video.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LanguageLocation  $languageLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $this->validate($request, ['name' => 'required|string|max:255|unique:video,name,' . $id]);
        $input = $request->all();
        $language = Video::findOrFail($id);
        $language->update($input);

        return redirect(route('admin.videos.index'))->withSuccess('The Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LanguageLocation  $languageLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect(route('admin.videos.index'))->withSuccess('The Data Deleted Successfully');
    }

    public function getVideos(Request $request)
    {

        $languages = Video::orderBy('id', 'desc')->get();

        $i = 1;
        $languageArray = [];
        if (!blank($languages)) {
            foreach ($languages as $language) {
                $languageArray[$i]          = $language;
                $languageArray[$i]['id']  = Str::limit($language->id, 100);
                $languageArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($languageArray)
            ->addColumn('action', function ($language) {
                $retAction = '';

                if(auth()->user()->can('videos_edit')) {
                    $retAction .= '<a href="' . route('admin.videos.edit', $language) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if(auth()->user()->can('videos_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.videos.destroy', $language) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })


            ->editColumn('department', function ($language) {
                return ($language->department->name);
            })
            ->editColumn('language', function ($language) {
                return ($language->language->name);
            })
            ->editColumn('video_url', function ($language) {
                return ($language->video_url);
            })



            ->editColumn('id', function ($language) {
                return $language->setID;
            })
            ->make(true);

    }
}
