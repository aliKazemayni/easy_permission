<?php

namespace App\Http\Controllers;

use App\Models\Section;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

use Miladshm\ControllerHelpers\Http\Traits\HasApiDatatable;
use Miladshm\ControllerHelpers\Http\Traits\HasDestroy;
use Miladshm\ControllerHelpers\Http\Traits\HasShow;
use Miladshm\ControllerHelpers\Http\Traits\HasStore;
use Miladshm\ControllerHelpers\Http\Traits\HasUpdate;

use App\Http\Requests\Section\StoreSectionRequest;
use App\Http\Requests\Section\UpdateSectionRequest;

class SectionController extends Controller
{
    use HasApiDatatable , HasShow , HasStore , HasUpdate , HasDestroy;

    private function model(): Model
    {
        return new Section();
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
        return new StoreSectionRequest();
    }

    protected function updateRequestClass(): ?FormRequest
    {
        return new UpdateSectionRequest();
    }
}
