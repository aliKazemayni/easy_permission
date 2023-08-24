<?php

namespace Alikazemayni\EasyPermission\Http\Controllers;

use Alikazemayni\EasyPermission\Models\Permission;
use Alikazemayni\EasyPermission\Http\Requests\Permission\StorePermissionRequest;
use Alikazemayni\EasyPermission\Http\Requests\Permission\UpdatePermissionRequest;

use App\Libraries\Facades\ResponderFacade;
use App\Models\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Miladshm\ControllerHelpers\Http\Traits\HasApiDatatable;
use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;

class PermissionController extends Controller
{
    use HasApiDatatable , HasShow , HasStore , HasUpdate , HasDestroy;

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
        return [];
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
        $permissions = User::findOrFail($request->user_id)->permissions();
        $permissions->sync($request->permissions);
        return ResponderFacade::setData($permissions->get())->respond();
    }
}
