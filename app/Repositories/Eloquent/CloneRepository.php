<?php namespace App\Repositories\Eloquent;

use App\Repositories\CloneRepositoryInterface;
use App\Models\Clones;
use DB;

class CloneRepository extends SingleKeyModelRepository implements CloneRepositoryInterface
{

    public function getBlankModel()
    {
        return new Clones();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
