<?php
namespace App\Property;
use App\Services\HttpService;
/**
 * Created by PhpStorm.
 * User: juancarlosjosecamacho
 * Date: 1/16/18
 * Time: 17:05
 */
class PropertyService
{
    private $httpService;
    private $propertyRepository;

    public function __construct(
        HttpService $httpService,
        PropertyRepository $propertyRepository
    ) {
        $this->httpService = $httpService;
        $this->propertyRepository = $propertyRepository;
    }

    public function create($request){
        /*hace la consulta a forquere para obtener la 5 imagenes*/
        /*crea la propiedad*/
        $domain = env('FOURSQUARE_URL');
        $uri = "/venues/explore";
        $params = array(
            "client_id"=>env('FOURSQUARE_CLIENT_ID'),
            "client_secret"=>env('FOURSQUARE_SECRET_ID'),
            "v"=>"20170801",
            "ll"=> $request['lat'].','.$request['lng'],
            "radius"=>250,
            "limit"=>5,
            "venuePhotos"=>1
        );
        $responseForsquare = $this->httpService->get($domain, $uri, $params);
        /*Process images TODO move to a class*/
        $images = $this->processForsquareImages($responseForsquare);
        $this->propertyRepository->create($request, $images);
        return ['msg' => 'success'];
    }

    public function update($request, $id){
        $this->propertyRepository->update($request, $id);
        return ['msg' => 'success'];
    }

    public function delete($id){
        $this->propertyRepository->delete($id);
        return ['msg' => 'success'];
    }
    public function index(){
        $response = $this->propertyRepository->index();
        return [
            'rows' => $response,
            'msg' => 'success'
        ];
    }
    public function show($id){
        $response = $this->propertyRepository->show($id);
        return [
            'row' => $response,
            'msg' => 'success'
        ];
    }

    public function processForsquareImages($data){
        $images = [];
        foreach ($data->response->groups[0]->items as $item){
            array_push($images, $item->venue->photos->groups[0]->items[0]->prefix.'250x300'.$item->venue->photos->groups[0]->items[0]->suffix);
        }
        return $images;
    }
}