<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\BackendController;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use App\Models\Payment;
use App\Models\PreRegister;
use App\Models\Sale;
use App\Models\VisitingDetails;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;


class DashboardController extends BackendController
{
    public function __construct()
    {
        parent::__construct();

        $this->data['sitetitle'] = 'Dashboard';

        $this->middleware(['permission:dashboard'])->only('index');
    }
    public function index()
    {

        $can_checkout = false;
        if(auth()->user()->getrole->name == 'Employee') {
            $visitors       = VisitingDetails::where(['employee_id'=>auth()->user()->employee->id])->orderBy('id', 'desc')->get();
            $preregisters    = PreRegister::where(['employee_id'=>auth()->user()->employee->id])->orderBy('id', 'desc')->get();
            $totalEmployees = 0;
        }else {

            $preregisters    = PreRegister::where('location_id',auth()->user()->location_id)->whereDate('expected_date', DB::raw('CURDATE()'))->orderBy('id', 'desc')->get();
            $visitors       = VisitingDetails::where('location_id',auth()->user()->location_id)->orderBy('id', 'desc')->get();
            $employees      = Employee::orderBy('id', 'desc')->get();
            $totalEmployees = count($employees);
            $can_checkout = true;
        }

        $totalVisitor   = count($visitors);
        $totalPrerigister = count($preregisters);


        $this->data['totalVisitor']    = $totalVisitor;
        $this->data['totalEmployees'] = $totalEmployees;
        $this->data['totalPrerigister']     = $totalPrerigister;
        $this->data['visitors']  = $visitors;
        $this->data['preregisters']  = $preregisters;
        $this->data['can_checkout']  = $can_checkout;

        return view('admin.dashboard.index', $this->data);
    }


}
