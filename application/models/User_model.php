<?php 
use GuzzleHttp\Client;

class User_model extends CI_model {

    private $_client;
    
    public function __construct()
    {
        parent::__construct();
        global $SConfig;
        $this->_client = new Client([
            'base_uri'  => $SConfig->_api_url,
        ]);
    }

    public function cek_login($data){
        try {
            $response = $this->_client->request('POST','users/login',[
                'form_params'   => $data
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            // return array('status' => $result['status'],'uid' => $result['uid'], 'token' => $result['token']);
            return $result;
        } catch (GuzzleHttp\Exception\ClientException $th) {
            $response = $th->getResponse();
            $jsonBody = $response->getBody();
            $res = json_decode($jsonBody);
            if(!empty($res)){
                return array('status' => $res->status,'message' => $res->message);
            }else{
                return $res;
            }
        }
    }

    public function register($data){
        try {
            $response = $this->_client->request('POST','users/register',[
                'form_params'   => $data
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            return array('status' => $result['status'], 'message' => $result['message']);
        } catch (GuzzleHttp\Exception\ClientException $th) {
            $response = $th->getResponse();
            $jsonBody = $response->getBody();
            $res = json_decode($jsonBody);
            return $res;
            // return array('status' => $res->status,'message' => $res->message,'error_data' => $res->error_data);
        }
    }
    public function checkuser($token){
        try {
            $response = $this->_client->request('POST','users/validatetoken',[
                    'headers' => [
                    'Accept'     => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => $token
                ],
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (GuzzleHttp\Exception\ClientException $th) {
            $response = $th->getResponse();
            $jsonBody = $response->getBody();
            $res = json_decode($jsonBody);
            return array('status' => $res->status,'message' => $res->message);
        }
    }
}