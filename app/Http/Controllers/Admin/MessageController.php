<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\TimelineRepository;

class MessageController extends Controller
{
    protected $timelineRepository;

    public function __construct(TimelineRepository $timelineRepository){
        $this->timelineRepository = $timelineRepository;
    }
    
    public function index() {
        $user = auth()->user();
        $users = User::where('id', '<>', auth()->user()->id)->where('type', 'admin')->get()->map(function ($user) {
            $user->unread_messages = Message::where('sender_id', $user->id)
                ->where('receiver_id', auth()->id())
                ->where('is_read', false)
                ->count();
            return $user;
        });
        $customers = User::where('type', 'customer')->get()->map(function ($user) {
            $user->unread_messages = Message::where('sender_id', $user->id)
                ->where('receiver_id', auth()->id())
                ->where('is_read', false)
                ->count();
            return $user;
        });
        return view('admin.messages.index', compact('users', 'customers'));
    }

    public function list($receiver_id){
        $user = Auth::user();
        $messages = Message::where(function ($query) use ($user, $receiver_id) {
            $query->where('sender_id', $user->id)->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($user, $receiver_id) {
            $query->where('sender_id', $receiver_id)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->with('sender:id,name,avatar')->get();

        return response()->json($messages);
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'receiver_id' => 'required|exists:users,id',
                'message' => 'nullable|string',
                'attachment' => 'nullable|file|max:10240',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $user = Auth::user();
            $attachmentPath = null;
            $attachmentType = null;

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $attachmentPath = $file->store('messages', 'public');
                $attachmentType = $file->getClientMimeType();
            }

            $message = Message::create([
                'sender_id' => $user->id,
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
                'attachment' => $attachmentPath,
                'attachment_type' => $attachmentType,
                'is_read' => false,
            ]);

            $msg = Message::whereId($message->id)->with('sender:id,name,avatar')->first();

            return response()->json(['message' => __('Action successfully completed.'), 'data' => $msg], 201);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'envoi du message : ' . $e->getMessage()], 500);
        }
    }

    public function markAsRead(Request $request){
        $et = Message::where('sender_id', $request->receiver_id)
        ->where('receiver_id', auth()->id())
        ->where('is_read', 0)->count();
        Message::where('sender_id', $request->receiver_id)
            ->where('receiver_id', auth()->id())
            ->where('is_read', 0)
            ->update(['is_read' => 1, 'read_at'=> now()]);
        return response()->json(['status' => 'success','et' => $et]);
    }

    public function downloadAttachment($id){
        try {
            $message = Message::findOrFail($id);

            if (!$message->attachment) {
                return response()->json(['error' => __('No attachments found')], 404);
            }

            $filePath = storage_path("app/public/" . $message->attachment);
            if (!file_exists($filePath)) {
                return response()->json(['error' => __('The file does not exist on the server')], 404);
            }

            return response()->download($filePath);
        
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors du téléchargement : ' . $e->getMessage()], 500);
        }
    }

    public function fetchLatest($receiver_id, $lastMessageId){
        $messages = Message::where('id', '>', $lastMessageId)
            ->where(function ($query) use ($receiver_id) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $receiver_id)
                    ->orWhere('sender_id', $receiver_id)
                    ->where('receiver_id', auth()->id());
            })
            ->orderBy('created_at', 'asc')->with('sender:id,name,avatar')
            ->get();

        return response()->json($messages);
    }

    public function getunreadmessages() {
        $messages = Message::where('is_read', 0)->where('receiver_id', auth()->id())->orderBy('created_at', 'desc')->with('sender:id,name,avatar')->get();
        $count = $messages->count();

        return response()->json([
            'count' => $count,
            'messages' => $messages,
        ]);
    }
}
