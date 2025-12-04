<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class NotificationRepository
{
    public function getNotificationMessage($module, $action, $value){
        switch ($module) {
    
            case 'configuration':
                return match ($action) {
                    'company' => __("Company settings have been updated."),
                    'documents' => __("Document settings have been updated."),
                    'logo' => __("The company logo has been updated."),
                    default => null,
                };
    
            case 'contact':
                return match ($action) {
                    'delete' => __("Contact :reference has been deleted.", ['reference' => $value]),
                    default => null,
                };
    
            case 'customer':
                return match ($action) {
                    'active' => __("Customer :reference has been activated.", ['reference' => $value]),
                    'create' => __("Customer :reference has been created.", ['reference' => $value]),
                    'create_account' => __("An account has been created for customer :reference.", ['reference' => $value]),
                    'delete' => __("Customer :reference has been deleted.", ['reference' => $value]),
                    'delete_account' => __("The account of customer :reference has been deleted.", ['reference' => $value]),
                    'edit' => __("Customer :reference has been updated.", ['reference' => $value]),
                    'email' => __("An email has been sent to customer :reference.", ['reference' => $value]),
                    'inactive' => __("Customer :reference has been deactivated.", ['reference' => $value]),
                    default => null,
                };
    
            case 'document':
                return match ($action) {
                    'attach_month' => __("Document :reference has been attached to the selected month.", ['reference' => $value]),
                    'create' => __("Document :reference has been created.", ['reference' => $value]),
                    'dettach_month' => __("Document :reference has been detached from the selected month.", ['reference' => $value]),
                    'download' => __("Document :reference has been downloaded.", ['reference' => $value]),
                    'edit' => __("Document :reference has been updated.", ['reference' => $value]),
                    'email' => __("Document :reference has been sent by email.", ['reference' => $value]),
                    'permission' => __("Permissions for document :reference have been updated.", ['reference' => $value]),
                    'upload_media' => __("Media has been uploaded to document :reference.", ['reference' => $value]),
                    'delete_media' => __("Media has been deleted for document :reference.", ['reference' => $value]),
                    default => null,
                };
    
            case 'partner':
                return match ($action) {
                    'create' => __("Partner :reference has been created.", ['reference' => $value]),
                    'delete' => __("Partner :reference has been deleted.", ['reference' => $value]),
                    'edit' => __("Partner :reference has been updated.", ['reference' => $value]),
                    default => null,
                };
    
            case 'request':
                return match ($action) {
                    'comment' => __("A new comment has been added to request :reference.", ['reference' => $value]),
                    'completed' => __("Request :reference has been marked as completed.", ['reference' => $value]),
                    'create' => __("Request :reference has been created.", ['reference' => $value]),
                    'delete' => __("Request :reference has been deleted.", ['reference' => $value]),
                    'delete_comment' => __("A comment has been deleted from request :reference.", ['reference' => $value]),
                    'in_progress' => __("Request :reference is now in progress.", ['reference' => $value]),
                    'invisible_comment' => __("A comment on request :reference has been marked as invisible.", ['reference' => $value]),
                    'paid' => __("Request :reference has been marked as paid.", ['reference' => $value]),
                    'pending' => __("Request :reference is now pending.", ['reference' => $value]),
                    'refused' => __("Request :reference has been refused.", ['reference' => $value]),
                    'unpaid' => __("Request :reference has been marked as unpaid.", ['reference' => $value]),
                    'update_form' => __("The form of request :reference has been updated.", ['reference' => $value]),
                    'visible_comment' => __("A comment on request :reference has been marked as visible.", ['reference' => $value]),
                    default => null,
                };
    
            case 'role':
                return match ($action) {
                    'create' => __("Role :name has been created.", ['name' => $value]),
                    'delete' => __("Role :name has been deleted.", ['name' => $value]),
                    'edit' => __("Role :name has been updated.", ['name' => $value]),
                    default => null,
                };
    
            case 'service':
                return match ($action) {
                    'active' => __("Service :reference has been activated.", ['reference' => $value]),
                    'create' => __("Service :reference has been created.", ['reference' => $value]),
                    'delete' => __("Service :reference has been deleted.", ['reference' => $value]),
                    'edit' => __("Service :reference has been updated.", ['reference' => $value]),
                    'inactive' => __("Service :reference has been deactivated.", ['reference' => $value]),
                    default => null,
                };
    
            case 'user':
                return match ($action) {
                    'active' => __("User :name has been activated.", ['name' => $value]),
                    'create' => __("User :name has been created.", ['name' => $value]),
                    'delete' => __("User :name has been deleted.", ['name' => $value]),
                    'edit' => __("User :name has been updated.", ['name' => $value]),
                    'inactive' => __("User :name has been deactivated.", ['name' => $value]),
                    default => null,
                };
    
            default:
                return null;
        }
    }

    public function getNotificationUrl($module, $action, $reference, $data_id, $type = "admin"){
        $c = null;
        $r = null;
        switch ($module) {
            case 'customer': $c = \App\Models\Customer\Customer::find($data_id); $r = route($type.'.customers.show', $data_id); break;
            case 'partner': $c = \App\Models\Partner\Partner::find($data_id); $r = route($type.'.partners.show', $data_id); break;
            case 'service': $c = \App\Models\Service\Service::find($data_id); $r = route($type.'.services.show', $data_id); break;
            case 'request': $c = \App\Models\Request\Request::find($data_id); $r = route($type.'.requests.show', $data_id); break;
            case 'document': $c = \App\Models\Document\Document::find($data_id); $r = route($type.'.documents.show', $data_id); break;
            case 'role': $c = \App\Models\Permission\Role::find($data_id); $r = route($type.'.roles.index'); break;
            case 'user': $c = \App\Models\User::find($data_id); $r = route($type.'.users.show', $data_id); break;
        }
        if ($data_id){
            if ($c){
                return $r;
            }else{
                return null;
            }
        }elseif ($reference){
            return null;
        }
    }

    public function getNotificationUsers($module, $slug = ""){
        switch ($module) {
            case 'configuration':
                return User::permission('configuration')->get();
            case 'contact':
                return User::permission('contacts')->get();
            case 'customer':
                return User::permission('customers')->get();
            case 'document':
                return User::permission($slug)->get();
            case 'partner':
                return User::permission('partners')->get();
            case 'request':
                return User::permission($slug)->get();
            case 'role':
                return User::permission('users')->get();
            case 'service':
                return User::permission('services')->get();
            case 'user':
                return User::permission('users')->get();
            default:
                return null;
        }
    }

    public function getNotificationColor($action){
        switch($action){
            case 'create': return "success";
            case 'edit': return "info";
            case 'email': return "secondary";
            case 'create_account': return "success";
            case 'inactive': return "warning";
            case 'active': return "success";
            case 'delete': return "danger";
            case 'delete_account': return "danger";
            case 'update_form': return "info";
            case 'unpaid': return "warning";
            case 'paid': return "success";
            case 'in_progress': return "info";
            case 'completed': return "success";
            case 'refused': return "danger";
            case 'pending': return "primary";
            case 'comment': return "success";
            case 'delete_comment': return "danger";
            case 'visible_comment': return "primary";
            case 'invisible_comment': return "warning";
            case 'attach_month': return "success";
            case 'dettach_month': return "danger";
            case 'upload_media': return "primary";
            case 'delete_media': return "danger";
            case 'permission': return "primary";
            case 'download': return "primary";
            case 'documents': return "info";
            case 'logo': return "info";
            case 'company': return "info";
            default: return "";
        }
    }

    public function getNotificationIcon($action){
        switch($action){
            case 'create': return "la la-plus";
            case 'edit': return "la la-edit";
            case 'email': return "la la-envelope";
            case 'create_account': return "la la-user-plus";
            case 'inactive': return "la la-times-circle";
            case 'active': return "la la-check";
            case 'delete': return "la la-trash";
            case 'delete_account': return "la la-user-times";
            case 'update_form': return "la la-pencil-square";
            case 'unpaid': return "la la-times-circle";
            case 'paid': return "la la-check";
            case 'in_progress': return "la la-play";
            case 'completed': return "la la-check-circle";
            case 'refused': return "la la-times";
            case 'pending': return "la la-pause";
            case 'comment': return "la la-comments";
            case 'delete_comment': return "la la-trash";
            case 'visible_comment': return "la la-eye";
            case 'invisible_comment': return "la la-eye-slash";
            case 'attach_month': return "la la-calendar";
            case 'dettach_month': return "la la-calendar";
            case 'upload_media': return "la la-upload";
            case 'delete_media': return "la la-times";
            case 'permission': return "la la-key";
            case 'download': return "la la-download";
            case 'documents': return "la la-folder-open";
            case 'logo': return "la la-image";
            case 'company': return "la la-building";
            default: return "";
        }
    }

    public function notify($action, $module, $data_id, $r = null, $users){
        if ($users) {
            $message = $this->getNotificationMessage($module, $action, $r);
            $url = $this->getNotificationUrl($module, $action, $r, $data_id);
            $color = $this->getNotificationColor($action);
            $icon = $this->getNotificationIcon($action);
            foreach ($users as $user) {
                Notification::create([
                    'title' => $message,
                    'url' => $url,
                    'icon' => $icon,
                    'color' => $color,
                    'user_id' => $user->id,
                    'by_user_id' =>auth()->id()??null
                ]);
            }
        }
    }
}
