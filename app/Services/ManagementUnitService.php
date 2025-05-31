<?php

namespace App\Services;

use App\Models\ManagementUnit;
use Diatria\LaravelInstant\Traits\InstantServiceTrait;

class ManagementUnitService
{
    use InstantServiceTrait;

    /**
     * Class model yang digunakan
     * 
     * @var App\Models\ManagementUnit
     */
    protected $model;

    /**
     * Path pagination
     * 
     * @var string
     */
    protected $paginationPath = '/management-unit/table';

    /**
     * List kolom yang akan ditampilkan
     * 
     * @var array
     */
    protected $columns = [
        "target",
        "realisasi",
        "target_waktu_pelaksanaan",
        "realisasi_waktu_pelaksanaan",
        "dokumen",
        "evaluasi_tidak_terpenuhi",
        "evaluasi_terpenuhi",
        "evaluasi_terlampaui",
        "catatan"
    ];

    /**
     * List kolom yang required ketika akan menyimpan data
     * 
     * @var array
     */
    protected $columnsRequired = [
        "target",
        "realisasi",
        "target_waktu_pelaksanaan",
        "realisasi_waktu_pelaksanaan",
        "dokumen",
        "evaluasi_tidak_terpenuhi",
        "evaluasi_terpenuhi",
        "evaluasi_terlampaui",
        "catatan"
    ];

    /**
     * @param App\Models\ManagementUnit $model class
     */
    public function initModel()
    {
        $this->model = (new ManagementUnit());
        return $this;
    }
}
