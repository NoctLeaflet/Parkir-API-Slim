<?php

use Slim\App;

return function (App $app) {
    $app->add(function ($request, $response, $next) {
        // $key = $request->getQueryParam("key");
        // if(!isset($key))
        // { 
        //     $req = json_encode($request);
        //     $wow = "bisa";
        //     return $response->withJson(["status" => "bang kok gak {$wow} {$req}"], 401); 
        // }
        // if($key == 123)
        // {
             return $response = $next($request, $response);
        // }


        // $sql = "SELECT * FROM api_users WHERE api_key=:api_key";
        // $stmt = $this->db->prepare($sql);
        // $stmt->execute([":api_key" => $key]);
        // if($stmt->rowCount() > 0){
        // $result = $stmt->fetch();
        //     if($key == $result["api_key"]){
        //         // update hit
        //         $sql = "UPDATE api_users SET hit=hit+1 WHERE api_key=:api_key";
        //         $stmt = $this->db->prepare($sql);
        //         $stmt->execute([":api_key" => $key]);
                
        //     }
        // }
    // return $response->withJson(["status" => "Unauthorized"], 401);
    });
};