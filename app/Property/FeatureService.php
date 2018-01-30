<?php
/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 1/16/18
 * Time: 22:54
 */
namespace App\Property;


class FeatureService
{
    private $featureRepository;

    public function __construct(
        FeatureRepository $featureRepository
    ) {
        $this->featureRepository = $featureRepository;
    }
    public function create($fields){
        $this->featureRepository->create($fields, $fields['property_id']);
        return ['msg' => 'success'];
    }
    public function delete($id){
        $this->featureRepository->delete($id);
        return ['msg' => 'success'];
    }
}