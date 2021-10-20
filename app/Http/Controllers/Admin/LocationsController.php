<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationsRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
class LocationsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->data['sitetitle'] = 'Locations';

        $this->middleware(['permission:locations'])->only('index');
        $this->middleware(['permission:locations_create'])->only('create', 'store');
        $this->middleware(['permission:locations_edit'])->only('edit', 'update');
        $this->middleware(['permission:locations_delete'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.location.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.location.create', $this->data);
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
        Location::create($input);

        return redirect()->route('admin.locations.index')->with('success','Location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['location']  = Location::findOrFail($id);

        return view('admin.location.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $this->validate($request, ['name' => 'required|string|max:255|unique:locations,name,' . $id]);
        $input = $request->all();
        $location = Location::findOrFail($id);
        $location->update($input);

        return redirect(route('admin.locations.index'))->withSuccess('The Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::findOrFail($id)->delete();
        return redirect(route('admin.locations.index'))->withSuccess('The Data Deleted Successfully');
    }

    public function getLocations(Request $request)
    {

        $locations = Location::orderBy('id', 'desc')->get();

        $i = 1;
        $locationArray = [];
        if (!blank($locations)) {
            foreach ($locations as $location) {
                $locationArray[$i]          = $location;
                $locationArray[$i]['name']  = Str::limit($location->name, 100);
                $locationArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($locationArray)
            ->addColumn('action', function ($location) {
                $retAction = '';

                if(auth()->user()->can('locations_edit')) {
                    $retAction .= '<a href="' . route('admin.locations.edit', $location) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if(auth()->user()->can('locations_delete')) {
                    $retAction .= '<form class="float-left pl-2" action="' . route('admin.locations.destroy', $location) . '" method="POST">' . method_field('DELETE') . csrf_field() . '<button class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></form>';
                }
                return $retAction;
            })


            ->editColumn('code', function ($location) {
                return ($location->code);
            })

            ->editColumn('id', function ($location) {
                return $location->setID;
            })
            ->make(true);

    }
}
