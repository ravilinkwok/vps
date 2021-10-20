<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\VisitorRequest;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Visitor;
use App\Models\VisitingDetails;
use App\Http\Services\Visitor\VisitorService;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


class VisitorController extends Controller
{
    protected $visitorService;

    public function __construct(VisitorService $visitorService)
    {
        $this->visitorService = $visitorService;

        $this->middleware('auth');
        $this->data['sitetitle'] = 'Visitors';

        $this->middleware(['permission:visitors'])->only('index');
        $this->middleware(['permission:visitors_create'])->only('create', 'store');
        $this->middleware(['permission:visitors_edit'])->only('edit', 'update');
        $this->middleware(['permission:visitors_delete'])->only('destroy');
        $this->middleware(['permission:visitors_show'])->only('show');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.visitor.index');
    }


    public function create(Request $request)
    {

        $this->data['employees'] = Employee::where('status', Status::ACTIVE)->get();
        $this->data['locations'] = Location::get();

        return view('admin.visitor.create', $this->data);
    }

    public function store(VisitorRequest $request)
    {
        $this->visitorService->make($request);
        return redirect()->route('admin.visitors.index')->withSuccess('The data inserted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        //S3 connection
        $s3 = S3Client::factory(
            array(
                'credentials' => array(
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),

                ),
                'version' => 'latest',
                'region'  => env('AWS_DEFAULT_REGION')
            )
        );



        $fileName = $this->visitorService->find($id)->getFirstMediaUrl('visitor');
        $command = $s3->getCommand('GetObject', array(
            'Bucket'      => env('AWS_BUCKET'),
            'Key'         => substr(explode("https://dgvps.s3.amazonaws.com",$fileName)[1], 1),
//            'Key'         => '4/HTbdiSFGbm.png',
            'ContentType' => 'image/png',
            'ResponseContentDisposition' => 'attachment; filename="'.$fileName.'"'
        ));
        $signedUrl = $s3->createPresignedRequest($command, "+6 days");
        // Create a signed URL from the command object that will last for
        // 6 days from the current time
        $presignedUrl = (string)$signedUrl->getUri();
        $this->data['visitingDetails'] = $this->visitorService->find($id);
        $this->data['signed_url'] = $presignedUrl;
        $this->data['file_name'] = $fileName;

        if ($this->data['visitingDetails']) {
            return view('admin.visitor.show', $this->data);
        }else{
            return redirect()->route('admin.visitors.index');
        }
    }

    public function edit($id)
    {
        $this->data['employees'] = Employee::where('status', Status::ACTIVE)->get();
        $this->data['visitingDetails'] = $this->visitorService->find($id);
        if ($this->data['visitingDetails']){
            return view('admin.visitor.edit', $this->data);
        }else {
            return redirect()->route('admin.visitors.index');
        }
    }

    public function update(VisitorRequest $request,VisitingDetails $visitor)
    {
        $this->visitorService->update($request,$visitor->id);
        return redirect()->route('admin.visitors.index')->withSuccess('The data updated successfully!');
    }

    public function destroy($id)
    {
        $this->visitorService->delete($id);
        return route('admin.visitors.index')->withSuccess('The data delete successfully!');
    }

    public function checkOut($id){
        $visitingDetails = VisitingDetails::findOrFail($id);
//        $visitor = DB::table('visiting_details')->where('id',$id)->first();
//        $visitor = Visitor::find($id);
        $visitingDetails['checkout_at'] = date('y-m-d H:i');
        $visitingDetails->save();
        return redirect()->route('/')->withSuccess('Checkout Successful!');
    }

    public function getVisitor(Request $request)
    {
        $visitingDetails = $this->visitorService->all();

        $i            = 1;
        $visitingDetailArray = [];
        if (!blank($visitingDetails)) {
            foreach ($visitingDetails as $visitingDetail) {
                $visitingDetailArray[$i]          = $visitingDetail;
                $visitingDetailArray[$i]['setID'] = $i;
                $i++;
            }
        }
        return Datatables::of($visitingDetailArray)
            ->addColumn('action', function ($visitingDetail) {
                $retAction ='';

                if(auth()->user()->can('visitors_show')) {
                    $retAction .= '<a href="' . route('admin.visitors.show', $visitingDetail) . '" class="btn btn-sm btn-icon mr-2  float-left btn-info" data-toggle="tooltip" data-placement="top" title="View"><i class="far fa-eye"></i></a>';
                }

                if(auth()->user()->can('visitors_edit')) {
                    $retAction .= '<a href="' . route('admin.visitors.edit', $visitingDetail) . '" class="btn btn-sm btn-icon float-left btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"> <i class="far fa-edit"></i></a>';
                }



                return $retAction;
            })

            ->editColumn('name', function ($visitingDetail) {
                return Str::limit($visitingDetail->visitor->name, 50);
            })
            ->addColumn('image', function ($visitingDetail) {
                return '<figure class="avatar mr-2"><img src="' . $visitingDetail->images . '" alt=""></figure>';
            })
            ->editColumn('visitor_id', function ($visitingDetail) {
                return $visitingDetail->reg_no;
            })
            ->editColumn('email', function ($visitingDetail) {
                return Str::limit($visitingDetail->visitor->email, 50);
            })
            ->editColumn('phone', function ($visitingDetail) {
                return Str::limit($visitingDetail->visitor->phone, 50);
            })
            ->editColumn('employee_id', function ($visitingDetail) {
                return $visitingDetail->employee->user->name;
            })
            ->editColumn('date', function ($visitingDetail) {
                return date('d-m-Y h:i A', strtotime($visitingDetail->checkin_at));
            })

            ->editColumn('id', function ($visitingDetail) {
                return $visitingDetail->setID;
            })
            ->rawColumns(['name', 'action'])
            ->escapeColumns([])
            ->make(true);

    }
}
