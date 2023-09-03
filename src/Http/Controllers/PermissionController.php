<?php

namespace Alikazemayni\EasyPermission\Http\Controllers;

use App\Models\User;

use Alikazemayni\EasyPermission\Models\Permission;
use Alikazemayni\EasyPermission\Http\Requests\Permission\StorePermissionRequest;
use Alikazemayni\EasyPermission\Http\Requests\Permission\UpdatePermissionRequest;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasIndex;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;
use Miladshm\ControllerHelpers\Libraries\Responder\Facades\ResponderFacade;

class PermissionController extends Controller
{
    use HasIndex , HasShow , HasStore , HasUpdate , HasDestroy;

    private function model(): Model
    {
        return new Permission();
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
        return new StorePermissionRequest();
    }

    protected function updateRequestClass(): ?FormRequest
    {
        return new UpdatePermissionRequest();
    }

    public function user(Request $request): JsonResponse{
        $permissions = User::findOrFail($request->user_id)
            ->permissions()->sync($request->permissions);
        return ResponderFacade::setData($permissions->get())->respond();
    }

    private function indexView(): View
    {
        // TODO: Implement indexView() method.
    }
}
