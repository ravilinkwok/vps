<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguagesRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
class LanguagesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Languages';

        $this->middleware(['permission:languages'])->only('index');
        $this->middleware(['permission:languages_create'])->only('create', 'store');
        $this->middleware(['permission:languages_edit'])->only('edit', 'update');
        $this->middleware(['permission:languages_delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('This is some useful information.');

        return view('admin.language.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.language.create', $this->data);
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
        Language::create($input);

        return redirect()->route('admin.languages.index')->with('success','Language created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['language']  = Language::findOrFail($id);

        return view('admin.language.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required|string|max:255|unique:languages,name,' . $id]);
        $input = $request->all();
        $language = Language::findOrFail($id);
        $language->update($input);

        return redirect(route('admin.languages.index'))->withSuccess('The Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Language::findOrFail($id)->delete();
        return redirect(route('admin.languages.index'))->withSuccess('The Data Deleted Successfully');
    }

    public function getLanguages(Request $request)
    {

        $languages = Language::orderBy('id', 'desc')->get();

        $i = 1;
        $languageArray = [];
        if (!blank($languages)) {
            foreach ($languages as $language) {
                $languageArray[$i]          = $language;
                $languageArray[$i]['name']  = Str::limit($language->name, 100);
                $languageArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($languageArray)
            ->addColumn('action', function ($language) {
                $retAction = '';

                if(auth()->user()->can('languages_edit')) {
                    $retAction .= '<a href="' . route('admin.languages.edit', $language) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if(auth()->user()->can('languages_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.languages.destroy', $language) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })


            ->editColumn('code', function ($language) {
                return ($language->code);
            })

            ->editColumn('id', function ($language) {
                return $language->setID;
            })
            ->make(true);

    }
}
