<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\EducationDepartment;
use App\Models\Provider;
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

    public function providers($id)
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
            ->where('education_department_provider.education_department_id', $id)
            ->where('providers.status', 'accepted')
            ->get();

        return Response::api(__('message.Success'), 200, true, null, ['providers' => $providers]);
    }

    public function classRooms($id)
    {
        $class_rooms = ClassRoom::where('provider_id', $id)->get();

        return Response::api(__('message.Success'), 200, true, null, ['class_rooms' => $class_rooms]);
    }
}
