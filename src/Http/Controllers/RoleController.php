<?php

namespace Alikazemayni\EasyPermission\Http\Controllers;

use Alikazemayni\EasyPermission\Http\Requests\Role\StoreRoleRequest;
use Alikazemayni\EasyPermission\Http\Requests\Role\UpdateRoleRequest;
use Alikazemayni\EasyPermission\Models\Role;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasIndex;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;
use Miladshm\ControllerHelpers\Libraries\Responder\Facades\ResponderFacade;

class RoleController extends Controller
{
    use HasIndex , HasShow , HasStore , HasUpdate , HasDestroy;

    private function model(): Model
    {
        return new Role();
    }

    private function extraData(Model $item = null): ?array
    {
        return [];
    }

    private function relations(): array
    {
        return ['permissions' , 'users'];
    }

    private function requestClass(): FormRequest
    {
        return new StoreRoleRequest();
    }

    protected function updateRequestClass(): ?FormRequest
    {
        return new UpdateRoleRequest();
    }

    private function indexView(): View
    {
        // TODO: Implement indexView() method.
    }

    protected function storeCallback(Request $request, Model $item): void
    {
        $request->permissions && $item->permissions()->sync($request->permissions);
    }

    protected function updateCallback(Request $request, Model $item)
    {
        $request->permissions && $item->permissions()->sync($request->permissions);
    }

    public function add_user(Request $request){
        try {
            $role_permission = Role::findOrFail($request->role_id)->permissions->pluck('id');
            if ($request->force)
                User::findOrFail($request->user_id)->permissions()->wherePivot('type', 'role')->delete();
            User::findOrFail($request->user_id)->permissions()->syncWithPivotValues($role_permission, ['type' => 'role']);
            Role::findOrFail($request->role_id)->users()->attach($request->user_id);
            return ResponderFacade::setMessage("success")->respond();
        }
        catch(Exception $exception) {
            return ResponderFacade::setExceptionMessage($exception)->respondError();
        }
    }

    public function remove_user(Request $request){
        try {
            User::findOrFail($request->user_id)->permissions()->wherePivot('type', 'role')->detach();
            Role::findOrFail($request->role_id)->users()
                ->wherePivot('user_id', $request->user_id)->detach();
            return ResponderFacade::setMessage("success")->respond();
        }
        catch(Exception $exception) {
            return ResponderFacade::setExceptionMessage($exception)->respondError();
        }
    }
}
