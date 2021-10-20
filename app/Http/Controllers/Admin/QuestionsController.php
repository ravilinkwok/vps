<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
//use App\Http\Requests\QuestionsRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
class QuestionsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Questions';

        $this->middleware(['permission:questions'])->only('index');
        $this->middleware(['permission:questions_create'])->only('create', 'store');
        $this->middleware(['permission:questions_edit'])->only('edit', 'update');
        $this->middleware(['permission:questions_delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('admin.question.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.question.create', $this->data);
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
        Question::create($input);

        return redirect()->route('admin.questions.index')->with('success','Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['question']  = Question::findOrFail($id);

        return view('admin.question.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['statement' => 'required|string|max:255|unique:questions,statement,' . $id]);
        $input = $request->all();
        $question = Question::findOrFail($id);
        $question->update($input);

        return redirect(route('admin.questions.index'))->withSuccess('The Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return redirect(route('admin.questions.index'))->withSuccess('The Data Deleted Successfully');
    }

    public function getQuestions(Request $request)
    {

        $questions = Question::orderBy('id', 'desc')->get();

        $i = 1;
        $questionArray = [];
        if (!blank($questions)) {
            foreach ($questions as $question) {
                $questionArray[$i]          = $question;
                $questionArray[$i]['name']  = Str::limit($question->statement, 100);
                $questionArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($questionArray)
            ->addColumn('action', function ($question) {
                $retAction = '';

                if(auth()->user()->can('questions_edit')) {
                    $retAction .= '<a href="' . route('admin.questions.edit', $question) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if(auth()->user()->can('questions_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.questions.destroy', $question) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })


            ->editColumn('uid', function ($question) {
                return ($question->uid);
            })
            ->editColumn('options', function ($question) {
                return ($question->options);
            })
            ->editColumn('correct_option', function ($question) {
                return ($question->correct_option);
            })

            ->editColumn('id', function ($question) {
                return $question->setID;
            })
            ->make(true);

    }
}
