<?php
/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 1/16/18
 * Time: 22:55
 */

namespace App\Property;


use App\Property\Models\Feature;
use App\Property\Models\Property;

class FeatureRepository
{
    private $property;
    private $feature;
    public function __construct(Property $property, Feature $feature)
    {
        $this->property = $property;
        $this->feature = $feature;
    }
    public function create($fields, $id){
        /*Create features*/
        if(isset($fields['features'])){
            foreach ($fields['features'] as $feature){
                $this->feature->create(['property_id'=> $id, 'name'=>$feature['name'], 'description'=>$feature['description']]);
            }
        }
    }
    public function delete($id){
        /*Delete feature*/
        $this->feature->find($id)->delete();
    }
    public function deleteProperty($id){
        foreach ($this->property->find($id)->features as $feature){
            $feature->delete();
        }
    }
}