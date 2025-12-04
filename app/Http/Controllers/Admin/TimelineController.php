<?php
    
namespace App\Http\Controllers\Admin;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Yajra\DataTables\DataTables;
use App\Repositories\TimelineRepository;
use App\Repositories\NotificationRepository;

class TimelineController extends Controller
{
    protected $timelineRepository;

    protected $notificationRepository;

    public function __construct(TimelineRepository $timelineRepository, NotificationRepository $notificationRepository){
        $this->timelineRepository = $timelineRepository;
        $this->notificationRepository = $notificationRepository;
        $this->middleware('permission:timelines', ['only' => ['index']]);
    }
    
    public function index(Request $request){
        if(request()->ajax()) {
            return DataTables::of(Timeline::query()->with('createdBy')->orderBy('id', 'desc'))
                ->addColumn('timeline', function ($data) {
                    return view('admin.timelines.partials.timeline', [ 'data' => $data ]);
                })->addColumn('data_id', function ($data) {
                    return view('admin.timelines.partials.data_id', [ 'data' => $data ]);
                })->addColumn('module', function ($data) {
                    return view('admin.timelines.partials.module', [ 'data' => $data ]);
                })->addColumn('created_by', function ($data) {
                    return view('admin.timelines.partials.created_by', [ 'data' => $data ]);
                })->addColumn('actions', function ($data) {
                    return view('admin.timelines.partials.action', [ 'data' => $data ]);
                })->addColumn('message', function ($data) {
                    return $this->notificationRepository->getNotificationMessage($data->module, $data->action, $data->reference)??'';
                })->make(true);
        }
        return view('admin.timelines.index');
    }
}