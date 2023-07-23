
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Contact_model');
    $this->load->helper('url_helper');
    $this->load->helper(array('form', 'url'));
  }
  
  public function viewContacts()
  { 
    header("Access-Control-Allow-Origin: *");
    $contacts = $this->Contact_model->getAllContacts();
    $this->output->set_content_type('application/json')->set_output(json_encode($contacts));
  
  }

  public function getContact($id)
  { 
    
    header('Access-Control-Allow-Origin: *');
   
    $contact = $this->Contact_model->get_contact($id);

    $contactData = array(
      'id' => $contact->id,
      'first_name' => $contact->first_name,
      'last_name' => $contact->last_name,
      'email' => $contact->email,
      'phone_number' => $contact->phone_number,
      'message' => $contact->message
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($contactData));
   }

   public function addContact()
   { 
     header("Content-type:application/json");
     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
     header("Access-Control-Allow-Headers: token, Content-Type");
 
     $requestData = json_decode(file_get_contents('php://input'), true);
 
     if(!empty($requestData)) {
 
       $first_name = $requestData['first_name'];
       $last_name = $requestData['last_name'];
       $email = $requestData['email'];
       $phone_number = $requestData['phone_number'];
       $message = $requestData['message'];
       
       $contactData = array(
         'first_name' => $first_name,
         'last_name' => $last_name,
         'email' => $email,
         'phone_number' => $phone_number,
         'message' => $message
       );
 
       $id = $this->Contact_model->insert_contact($contactData);
 
       $response = array(
         'status' => 'success',
         'message' => 'contact successfully added.'
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
 
   public function addNewContact() {	
      header("Content-type:application/json");
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
      header("Access-Control-Allow-Headers: token, Content-Type");
    
    
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $phone_number = $_POST['phone_number'];
      $message = $_POST['message'];

      $contactData = array(
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone_number' => $phone_number,
        'message' => $message
      );

      $id = $this->Contact_model->insert_contact($contactData);
        
        if (isset($id)) {
    echo json_encode(
            array(
              "status" => 1,
              "data" => array(),
              "msg" => "contact successfully added",
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

  
  public function updateContact($id)
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

      $id = $this->Contact_model->update_contact($id, $serviceData);

      $response = array(
        'status' => 'success',
        'message' => 'service updated successfully.'
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


  public function updateServiceFormdata($id)
  { 
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
    header("Access-Control-Allow-Headers: token, Content-Type");

    // $requestData = json_decode(file_get_contents('php://input'), true);

      $service = $_POST['service'];
      $cost = $_POST['cost'];
      $valid = $_POST['valid'];
      
      $serviceData = array(
        'service' => $service,
        'cost' => $cost,
        'valid' => $valid
      );

      $id = $this->Contact_model->update_contact($id, $serviceData);

    // if(isset($id)) {
      $response = array(
        'status' => 'success',
        'message' => 'service updated successfully.'
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

  public function deleteContact($id)
  {
    header("Content-type:application/json");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    
    $contact = $this->Contact_model->delete_contact($id);
    $response = array(
      'message' => 'contact deleted successfully.'
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }
}
?>