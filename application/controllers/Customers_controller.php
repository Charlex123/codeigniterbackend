
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Customers_model');
    $this->load->helper('url_helper');
    $this->load->helper(array('form', 'url'));
  }
  
  public function customers()
  { 
    header("Access-Control-Allow-Origin: *");
    $customers = $this->Customers_model->getAllCustomers();
    $this->output->set_content_type('application/json')->set_output(json_encode($customers));
  
  }

  public function getCustomer($id)
  { 
    
    header('Access-Control-Allow-Origin: *');
   
    $customer = $this->Customers_model->get_customer($id);

    $serviceData = array(
      'serv_id' => $service->serv_id,
      'service' => $service->service,
      'cost' => $service->cost,
      'valid' => $service->valid
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($serviceData));
   }

   public function addService()
   { 
     header("Content-type:application/json");
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
     header("Access-Control-Allow-Headers: token, Content-Type");
 
     $requestData = json_decode(file_get_contents('php://input'), true);
 
     if(!empty($requestData)) {
 
       $service = $requestData['service'];
       $cost = $requestData['cost'];
       $valid = $requestData['valid'];
       
       $serviceData = array(
         'service' => $service,
         'cost' => $cost,
         'valid' => $valid
       );
 
       $id = $this->Customers_model->insert_customer($serviceData);
 
       $response = array(
         'status' => 'success',
         'message' => 'service successfully added.'
       );
     }
     else {
       $response = array(
         'status' => 'error'
       );
     }
 
     $this->output
       ->set_content_type('application/json')
       ->set_output(json_encode($response));
   }
 
   public function addNewService() {	
      header("Content-type:application/json");
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
      header("Access-Control-Allow-Headers: token, Content-Type");
    
    
      $service = $_POST["service"];
      $cost = $_POST["cost"];
      $valid = $_POST["valid"];

          $serviceData = array(
            "service" => $service,
            "cost" => $cost,
            "valid" => $valid
          );

          $id = $this->Customers_model->insert_customer($serviceData);
        
        if (isset($id)) {
    echo json_encode(
            array(
              "status" => 1,
              "data" => array(),
              "msg" => "service successfully added",
              "base_url" => base_url(),
              "count" => "0"
            )
          );
        }else{
    echo json_encode(
            array(
              "status" => 1,
              "data" => array(),
              "msg" => "not found",
              "base_url" => base_url(),
              "count" => "0"
            )
          );
        }
      }

  

  public function updateCustomers($id)
  { 
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    header("Access-Control-Allow-Headers: token, Content-Type");

    $requestData = json_decode(file_get_contents('php://input'), true);

    if(!empty($requestData)) {

      $Customer_name = $requestData['Customer_name'];
      $Account_type = $requestData['Account_type'];
      $Active = $requestData['Active'];
      
      $CustomerData = array(
        'Customer_name' => $Customer_name,
        'Account_type' => $Account_type,
        'Active' => $Active
      );

      $id = $this->Customers_model->update_customer($id, $CustomerData);

      $response = array(
        'status' => 'success',
        'message' => 'customer detils updated successfully.'
      );
    }
    else {
      $response = array(
        'status' => 'error'
      );
    }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }


  public function updateCustomerFormdata($id)
  { 
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    header("Access-Control-Allow-Headers: token, Content-Type");

    // $requestData = json_decode(file_get_contents('php://input'), true);

    $Customer_name = $_POST['Customer_name'];
    $Account_type = $_POST['Account_type'];
    $Active = $_POST['Active'];
    
    $CustomerData = array(
      'Customer_name' => $Customer_name,
      'Account_type' => $Account_type,
      'Active' => $Active
    );

      $id = $this->Customers_model->update_customer($id, $CustomerData);

    // if(isset($id)) {
      $response = array(
        'status' => 'success',
        'message' => 'customer details updated successfully.'
      );
    // }
    // else {
    //   $response = array(
    //     'status' => 'error'
    //   );
    // }

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }

  public function deleteCustomer($id)
  {
    header("Content-type:application/json");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    
    $customer = $this->Customers_model->delete_customer($id);
    $response = array(
      'message' => 'customer deleted successfully.'
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }
}
?>