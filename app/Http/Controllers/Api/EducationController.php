<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\ClassRoom;
use App\Models\EducationDepartment;
use App\Models\Lesson;
use App\Models\Provider;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EducationController extends Controller
{
    public function educationDepartment()
    {
        $educationDepartments = EducationDepartment::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name')
            ->get();

        return Response::api(__('message.Success'), 200, true, null, ['educationDepartments' => $educationDepartments]);
    }

    public function providers($educationDepartmentId)
    {
        $providers = Provider::select(
            'providers.id',
            app()->getLocale() == 'ar' ? 'providers.name_arabic as name' : 'providers.name_english as name',
            'providers.logo',
            'providers.whatsapp',
            'providers.facebook',
            'providers.instagram',
            'providers.address',
            'providers.status',
            'providers.user_id'
        )
            ->join(
                'education_department_provider',
                'providers.id',
                '=',
                'education_department_provider.provider_id'
            )
            ->where('education_department_provider.education_department_id', $educationDepartmentId)
            ->where('providers.status', 'accepted')
            ->get();

        return Response::api(__('message.Success'), 200, true, null, ['providers' => $providers]);
    }

    public function classRooms(Request $request, $providerId)
    {
        if (!$request->departmentId)
            return Response::api(__('message.Error'), 404, true, 404, __('message.Not Found'));

        $class_rooms = ClassRoom::select(
            'id',
            app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name',
            'image',
            'sort_order',
            'provider_id',
            'education_department_id'
        )
            ->where('provider_id', $providerId)
            ->where('education_department_id', $request->departmentId)
            ->orderBy('sort_order')
            ->get();

        return Response::api(__('message.Success'), 200, true, null, ['class_rooms' => $class_rooms]);
    }

    public function units($classRoomId)
    {
        $units = Unit::select(
            'id',
            app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name',
            'description',
            'image',
            'sort_order',
            'class_room_id'
        )
            ->with(['lessons' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->where('class_room_id', $classRoomId)
            ->orderBy('sort_order')
            ->get();

        return Response::api(__('message.Success'), 200, true, null, ['units' => $units]);
    }

    public function lessons($unitId)
    {
        $lessons = Lesson::where('unit_id', $unitId)
            ->orderBy('sort_order')
            ->get();

        return Response::api(__('message.Success'), 200, true, null, ['lessons' => $lessons]);
    }

    public function attachments($lessonId)
    {
        if (!auth('api')->user()->code)
            return Response::api(__('message.You Are Not subscribed'), 403, false, 403);

        $attachments = Attachment::where('lesson_id', $lessonId)
            ->orderBy('sort_order')
            ->get();

        return Response::api(__('message.Success'), 200, true, null, ['attachments' => $attachments]);
    }
}
