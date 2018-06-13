<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
  protected $statusCode = 200;

  /**
   * Get the value of statusCode
   */ 
  public function getStatusCode()
  {
    return $this->statusCode;
  }

  /**
   * Set the value of statusCode
   *
   * @return  self
   */ 
  public function setStatusCode($statusCode)
  {
    $this->statusCode = $statusCode;

    return $this;
  }

  /**
   * Undocumented function
   *
   * @param [type] $data
   * @param array $headers
   * @return void
   */
  public function respond($data, $headers = ['Accept' => 'application/json']) {
    //return response($data, $this->getStatusCode())->withHeaders($headers);
    return response()->json($data, $this->getStatusCode(), $headers);
  }

  /**
   * Undocumented function
   *
   * @param [string] $message
   * @return void
   */
  public function respondWithError($message) {
    return $this->respond([
      'error' => [
        'message' => $message,
        'status_code' => $this->getStatusCode()
      ]
    ]);
  }

  /**
   * 404 error function
   *
   * @param string $message
   * @return void
   */
  public function reponseNotFound($message = 'Not Found') {
    return $this->setStatusCode(404)->respondWithError($message);
  }

  /**
   * 422 error function
   *
   * @param string $message
   * @return void
   */
  public function paramsValidationFailed($message = 'Insufficent Params') {
    return $this->setStatusCode(422)->respondWithError($message);
  }
  
  /**
   * Undocumented function
   *
   * @param string $message
   * @return void
   */
  public function respondCreated($message = 'Record Created') {
    return $this->setStatusCode(201)->respond([
      'message' => $message
    ]);
  }
 
}
