<?php

namespace App\Http\Controllers;

use App\Utils\Permission;
use App\Models\UnitDetail;
use Illuminate\Http\Request;
use App\Services\UnitDetailService;
use Diatria\LaravelInstant\Traits\InstantControllerTrait;

class UnitDetailController extends Controller
{
    use InstantControllerTrait;
    
    protected $service, $model;
    protected $permission = [
        "create" => "can_create_unit_details",
        "view" => "can_view_unit_details",
        "update" => "can_update_unit_details",
        "delete" => "can_delete_unit_details",
    ];

    public function __construct(UnitDetail $model, UnitDetailService $service)
    {
        $this->model = $model;
        $this->service = $service->initModel($model);
    }

    public function  view(Request $request, int $unitID, int $id = null) {
        (new Permission($this->permission ?? null))->can("view");
        
        if ($id) {
            $data = $this->model->find($id);
            return view('unit-detail.index', [
                'unitID' => $unitID,
                'data' => $data,
            ]);
        }
        return view('unit-detail.index', [
            'unitID' => $unitID,
            'tables' => $this->model->all()
        ]);
    }
}
