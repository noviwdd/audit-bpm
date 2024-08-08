<?php

namespace App\Http\Controllers;

use App\Utils\Permission;
use Illuminate\Http\Request;
use App\Models\ManagementUnit;
use App\Services\ManagementUnitService;
use Diatria\LaravelInstant\Traits\InstantControllerTrait;

class ManagementUnitController extends Controller
{
    use InstantControllerTrait;

    protected $service, $model;
    protected $permission = [
        "create" => "can_create_management_units",
        "view" => "can_view_management_units",
        "update" => "can_update_management_units",
        "delete" => "can_delete_management_units",
    ];

    public function __construct(ManagementUnit $model, ManagementUnitService $service)
    {
        $this->model = $model;
        $this->service = $service->initModel($model);
    }

    public function  view(Request $request, int $id = null) {
        (new Permission($this->permission ?? null))->can("view");
        
        if ($id) {
            $data = $this->model->find($id);
            return view('management-unit.index', [
                'data' => $data
            ]);
        }
        return view('management-unit.index');
    }
}
