<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;

use App\Libraries\Facades\ResponderFacade;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Miladshm\ControllerHelpers\Http\Traits\HasApiDatatable;
use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasIndex;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;

class PermissionController extends Controller
{
    use HasIndex , HasShow , HasStore , HasUpdate , HasDestroy;

    private function model(): Model
    {
        return new \Alikazemayni\EasyPermission\Models\Permission();
    }

    private function extraData(Model $item = null): ?array
    {
        return [];
    }

    private function relations(): array
    {
        return  [
            'users' => fn($q) => $q->where('user_id' , request()->user_id),
            'role' => fn($q) => $q->where('roles.id' , request()->role_id),
            'section'
        ];
    }

    private function requestClass(): FormRequest
    {
        return new \Alikazemayni\EasyPermission\Http\Requests\Permission\StorePermissionRequest();
    }

    protected function updateRequestClass(): ?FormRequest
    {
        return new \Alikazemayni\EasyPermission\Http\Requests\Permission\UpdatePermissionRequest();
    }

    public function user(Request $request): JsonResponse{
        $permissions = User::findOrFail($request->user_id)
            ->permissions()->sync($request->permissions);
        return \Miladshm\ControllerHelpers\Libraries\Responder\Facades\ResponderFacade::setData($permissions->get())->respond();
    }

    private function indexView(): View
    {
        // TODO: Implement indexView() method.
    }
}
