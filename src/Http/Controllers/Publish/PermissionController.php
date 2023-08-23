<?php

namespace Alikazemayni\EasyPermission\Http\Controllers\Publish;

use Alikazemayni\EasyPermission\Models\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Miladshm\ControllerHelpers\Http\Traits\HasApiDatatable;
use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;

use Alikazemayni\EasyPermission\Http\Requests\Permission\StorePermissionRequest;
use Alikazemayni\EasyPermission\Http\Requests\Permission\UpdatePermissionRequest;

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
}
