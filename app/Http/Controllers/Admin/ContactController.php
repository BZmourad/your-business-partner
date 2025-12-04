<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Repositories\TimelineRepository;
use App\Models\User;

class ContactController extends Controller
{
    protected $timelineRepository;
    protected $users;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
        $this->users = User::permission('contacts')->get();
        $this->middleware('permission:contacts', ['only' => ['index','destroy']]);
    }
    
    public function index(Request $request) {
        if(request()->ajax()) {
            $query = Contact::query();
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            $columns = [
                'reference',
                'name',
                'contact',
                'service',
                'message',
                'created_at'
            ];
            if ($orderColumn !== null && isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('id', 'desc');
            }
            return DataTables::of($query)
                ->addColumn('msg', function ($data) {
                    return view('admin.contacts.partials.msg', [ 'data' => $data ]);
                })->addColumn('contact', function ($data) {
                    return view('admin.contacts.partials.contact', [ 'data' => $data ]);
                })->addColumn('action', function ($data) {
                    return view('admin.contacts.partials.action', [ 'data' => $data ]);
                })->filter(function ($query) use ($request) {
                    if ($request->has('search') && !empty($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                            ->orWhere('service', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%")
                            ->orWhere('address', 'like', "%{$search}%")
                            ->orWhere('subject', 'like', "%{$search}%")
                            ->orWhere('message', 'like', "%{$search}%");
                        });
                    }
                })->make(true);
        }
        return view('admin.contacts.index');
    }

    public function destroy(Contact $contact){
        try {
            DB::beginTransaction();
            $r = $contact->reference;
            $contact->delete();
            $this->timelineRepository->newTimeline('delete', 'contact', null, $r, $this->users);
            DB::commit();
            return response()->json(['success' => __('Action successfully completed.')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => __('Une erreur est survenue lors de la suppression définitive.')]);
        }
    }
}