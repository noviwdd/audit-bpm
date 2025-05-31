<?php
namespace App\Services;

use App\Models\Unit;
use Diatria\LaravelInstant\Traits\InstantServiceTrait;

class UnitService {
    use InstantServiceTrait;

    /**
     * Class model yang digunakan
     * 
     * @var App\Models\Unit
     */
    protected $model;

    /**
     * Path pagination
     * 
     * @var string
     */
    protected $paginationPath = '/unit/table';

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
     * @param App\Models\Unit $model class
     */
    public function initModel()
    {
        $this->model = (new Unit());
        return $this;
    }
}