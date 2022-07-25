<?php

use GuzzleHttp\Client;
use Illuminate\Database\Capsule\Manager as Capsule;

class PropertyService {

    private $api_page_url;
    private $api_properties;

    public function getAPIProperties () {
        
        $this->api_page_url = $_ENV['API_URL'] .
                                '?api_key=' . $_ENV['API_KEY'] . 
                                '&page[number]=1&page[size]=30';
        
        $this->sendAPIRequest();

    }

    private function sendAPIRequest() {
        $client = new Client();

        $response = $client->request('GET', $this->api_page_url);

        $body = json_decode($response->getBody());

        $this->api_properties = $body->data;

        $this->saveProperties();

        $this->api_page_url = $body->next_page_url;

        if ($this->api_page_url) {
            $this->sendAPIRequest();
        }

    }

    private function saveProperties() {
        foreach ($this->api_properties as $api_property) {
            Capsule::table('property_types')->insertOrIgnore([
                [
                    "id" => $api_property->property_type->id,
                    "title" => $api_property->property_type->title,
                    "description" => $api_property->property_type->description,
                    "created_at" => $api_property->property_type->created_at,
                    "updated_at" => $api_property->property_type->updated_at,
                ],
            ]);

            Capsule::table('properties')->insertOrIgnore([
                [
                    "uuid" => $api_property->uuid,
                    "property_type_id" => $api_property->property_type_id,
                    "county" => $api_property->county,
                    "country" => $api_property->country,
                    "town" => $api_property->town,
                    "description" => $api_property->description,
                    "address" => $api_property->address,
                    "image_full" => $api_property->image_full,
                    "image_thumbnail" => $api_property->image_thumbnail,
                    "latitude" => $api_property->latitude,
                    "longitude" => $api_property->longitude,
                    "num_bedrooms" => $api_property->num_bedrooms,
                    "num_bathrooms" => $api_property->num_bathrooms,
                    "price" => $api_property->price,
                    "type" => $api_property->type,
                    "created_at" => $api_property->created_at,
                    "updated_at" => $api_property->updated_at,
                ],
            ]);
        }
    }

    public function getDBProperties() {
        if (isset($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
        } else {
            $page = "1";
        }

        $perpage = "5";

        $offset = ($page - 1) * $perpage;

        if (isset($_REQUEST['sort_by'])) {
            $sort_by = $_REQUEST['sort_by'];
        } else {
            $sort_by = "uuid";
        }

        $properties = Capsule::table('properties')
            ->orderBy($sort_by)
            ->skip($offset)
            ->take($perpage)
            ->get();

        $params = [
            'next_page' => $page + 1,
            'prev_page' => ($page <= 1) ? '1' : $page - 1,
        ];

        return compact('properties', 'params');
    }

}
