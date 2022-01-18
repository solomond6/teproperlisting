<?php
include 'database.php';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://trial.craig.mtcserver15.com/api/properties',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HTTPHEADER => array(
    'api_key: 2S7rhsaq9X1cnfkMCPHX64YsWYyfe1he'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$json_response = json_decode($response);

//get the total number of pages
$startIndex = $json_response->from;
$endIndex = $json_response->last_page;

$a = new database();

for ($i=$startIndex; $i <= $endIndex; $i++) { 
  
  $resp = fetchProperties($i);

  if(!empty($resp)){

    //loop 
    foreach ($resp->data as $key => $value) {

      //insert the record into the db
      $insert = $a->insert('sample_properties',
                  [
                  'uuid'=>$value->uuid,
                  'county'=>$value->county,
                  'country'=>$value->country,
                  'town'=>$value->town,
                  'description'=>$value->description,
                  'address'=>$value->address,
                  'image_full'=>$value->image_full,
                  'image_thumbnail'=>$value->image_thumbnail,
                  'latitude'=>$value->latitude,
                  'longitude'=>$value->longitude,
                  'num_bedrooms'=>$value->num_bedrooms,
                  'num_bathrooms'=>$value->num_bathrooms,
                  'price'=>$value->price,
                  'type'=>$value->type,
                  'property_type_title'=>$value->property_type->title,
                  'property_type_description'=>$value->property_type->description,
                  'created_at'=>$value->created_at,
                  'updated_at'=>$value->updated_at,
                ]);

      if ($insert == true) {
        printf('Page %s Record: %s Inserted'.PHP_EOL, $i, $key);
      }else{
        printf('Page %s Record: %s Error occured '.PHP_EOL, $i, $key, );
      }

    }
  }
}


//method to get the content of each page
function fetchProperties($pageNumber= null){

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://trial.craig.mtcserver15.com/api/properties?page[number]='.$pageNumber,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => array(
      'api_key: 2S7rhsaq9X1cnfkMCPHX64YsWYyfe1he'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  $json_response = json_decode($response);

  return $json_response;
}