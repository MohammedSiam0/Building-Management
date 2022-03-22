<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\export;
use App\Models\Financial;
use App\Models\People;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $peopleCount = People::count();
        $employeeCount= Employee::count();
         $exportCount = export::sum('amount');
         $fCount = Financial::sum('amount_paid');

        return view('dashboard.index',[
           'peopleCount' =>$peopleCount,
           'employeeCount' =>$employeeCount,
           'exportCount' =>$exportCount,
           'fCount' =>$fCount,
       ]);
    }
}
