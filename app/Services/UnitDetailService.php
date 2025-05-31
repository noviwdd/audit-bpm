<?php
namespace App\Services;

use App\Models\UnitDetail;
use Diatria\LaravelInstant\Traits\InstantServiceTrait;

class UnitDetailService {
    use InstantServiceTrait;

    /**
     * Class model yang digunakan
     * 
     * @var App\Models\UnitDetail
     */
    protected $model;

    /**
     * Path pagination
     * 
     * @var string
     */
    protected $paginationPath = '/unitdetail/table';

    /**
     * List kolom yang akan ditampilkan
     * 
     * @var array
     */
    protected $columns = [];

    /**
     * List kolom yang required ketika akan menyimpan data
     * 
     * @var array
     */
    protected $columnsRequired = [];
    
    /**
     * @param App\Models\UnitDetail $model class
     */
    public function initModel()
    {
        $this->model = (new UnitDetail());
        return $this;
    }
}