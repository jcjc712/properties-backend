<?php
namespace App\Property;
use App\Property\Models\Image;
use App\Property\Models\Property;

/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 1/16/18
 * Time: 17:06
 */
class PropertyRepository
{
    private $property;
    private $image;
    private $featureRepository;
    public function __construct(Property $property, Image $image, FeatureRepository $featureRepository)
    {
        $this->property = $property;
        $this->image = $image;
        $this->featureRepository = $featureRepository;
    }

    public function create($fields, $images){
        /*Create properties*/
        /*TODO add to created_by and updated_by the loggin id user*/
        $property = $this->property->create($fields);
        /*Create features*/
        $this->featureRepository->create($fields, $property->id);
        /*Create images*/
        foreach ($images as $image){
            $this->image->create(['property_id'=> $property->id,'name'=>$image]);
        }
    }

    public function update($request, $id){
        $this->property->find($id)->update($request);
    }
    public function delete($id){
        foreach ($this->property->find($id)->images as $image){
            $image->delete();
        }
        /*Delete features*/
        $this->featureRepository->deleteProperty($id);
        $this->property->find($id)->delete();
    }
    public function index(){
        return $this->property->with(['images','features'])->get()->toArray();
    }
    public function show($id){
        return $this->property->with(['images','features'])->find($id)->toArray();
    }
}