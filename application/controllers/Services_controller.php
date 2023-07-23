
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Services_model');
    $this->load->helper('url_helper');
    $this->load->helper(array('form', 'url'));
  }
  
  public function services()
  { 
    header("Access-Control-Allow-Origin: *");
    $services = $this->Services_model->getAllServices();
    $this->output->set_content_type('application/json')->set_output(json_encode($services));
  
  }

  public function getService($id)
  { 
    
    header('Access-Control-Allow-Origin: *');
   
    $service = $this->Services_model->get_service($id);

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
 
       $id = $this->Services_model->insert_service($serviceData);
 
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

          $id = $this->Services_model->insert_service($serviceData);
        
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

  //  public function do_upload() {	
  //   header("Content-type:application/json");
  //   header("Access-Control-Allow-Origin: *");
  //   header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");
  //   header("Access-Control-Allow-Headers: token, Content-Type");
    
    
  //   if(isset($_FILES["book"]["name"])) {
  //     $res = array();
  //     $name       = "book";
  //     $bookPath 	= "uploads/";
  //     // $temp       = explode(".",$_FILES["book"]["name"]);
  //     $filenew 	= $_FILES["book"]["name"];  		
  //     $config["file_name"]   = $filenew;
  //     $config["upload_path"] = $bookPath;
  //     $config = array(
  //       "upload_path" => $bookPath,
  //       "allowed_types" => "gif|jpg|png|jpeg|pdf",
  //       "file_name" => $filenew,
  //       "overwrite" => TRUE,
  //       "max_size" => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
  //       "max_height" => "768",
  //       "max_width" => "1024"
  //       );
  //     $this->load->library("upload",$config);
  //     $this->upload->do_upload("book");
  //     $this->upload->set_allowed_types("*");
  //     $this->upload->set_filename($config["upload_path"],$filenew);
  //     if(!$this->upload->do_upload("book")) {
  //       $data = array("msg" => $this->upload->display_errors());
  //       } else {
  //       $data = $this->upload->data();
  //       if(!empty($data["file_name"])){
  //         $res["book_url"] = "uploads/" .$data["file_name"]; 
  //         $bookName = $_POST["book_name"];
  //         $bookTitle = $_POST["book_title"];
  //         $bookPrice = $_POST["book_price"];
  //         $bookDescription = $_POST["book_description"];
  //         $book = "uploads/" .$data["file_name"];;

  //         $serviceData = array(
  //           "book_name" => $bookName,
  //           "book_title" => $bookTitle,
  //           "book_price" => $bookPrice,
  //           "book_description" => $bookDescription,
  //           "book" => $book
  //         );

  //         $id = $this->Services_model->insert_service($serviceData);
  //       }
  //       if (!empty($res) && isset($id)) {
  //   echo json_encode(
  //           array(
  //             "status" => 1,
  //             "data" => array(),
  //             "msg" => "upload successful",
  //             "base_url" => base_url(),
  //             "count" => "0"
  //           )
  //         );
  //       }else{
  //   echo json_encode(
  //           array(
  //             "status" => 1,
  //             "data" => array(),
  //             "msg" => "not found",
  //             "base_url" => base_url(),
  //             "count" => "0"
  //           )
  //         );
  //       }
  //     }
  //   }
  // }


  public function updateService($id)
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

      $id = $this->Services_model->update_service($id, $serviceData);

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

      $id = $this->Services_model->update_service($id, $serviceData);

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

  public function deleteService($id)
  {
    header("Content-type:application/json");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    
    $service = $this->Services_model->delete_service($id);
    $response = array(
      'message' => 'service deleted successfully.'
    );

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
  }
}
?>