<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Timeline;
use App\Repositories\NotificationRepository;

class TimelineRepository
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository){
        $this->notificationRepository = $notificationRepository;
    }

    public function newTimeline($action, $module, $data_id, $r = null, $users = null){
        Timeline::create([
            'action' => $action,
            'created_by' => auth()->id()??null,
            'module' => $module,
            'data_id' => $data_id,
            'reference' => $r
        ]);
        $this->notificationRepository->notify($action, $module, $data_id, $r, $users);
    }

}