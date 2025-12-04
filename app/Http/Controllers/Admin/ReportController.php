<?php
    
namespace App\Http\Controllers\Admin;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\User;
use App\Models\Service\Service;
use App\Models\Request\Request as ServiceRequest;
use App\Repositories\TimelineRepository;

class ReportController extends Controller
{
    protected $timelineRepository;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->middleware('permission:report', ['only' => ['index']]);
    }
    
    public function index(){
        $countCustomers = Customer::count();
        $countUsers = User::where('type', 'admin')->count();
        $countServices = Service::count();
        $countRequests = ServiceRequest::count();
        $servicesData = Service::withCount('demandes')->orderBy('demandes_count', 'desc')->get();
        $services = [];
        $nb = [];
        $services2 = [];
        $nb2 = [];
        foreach ($servicesData as $service) {
            $services[] = $service->name;
            $nb[] = $service->demandes_count;
            if (count($services) <=5) {
                $services2[] = $service->name;
                $nb2[] = $service->demandes_count;
            }
        }
        return view('admin.reports.index', compact('countCustomers', 'countUsers', 'countServices', 'countRequests', 'services', 'nb', 'services2', 'nb2'));
    }
}