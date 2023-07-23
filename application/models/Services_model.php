
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_model extends CI_model {
  
  public function getAllServices()
  {
    // $this->db->where('is_active', 1);
    $query = $this->db->get('services');
    return $query->result();
  }

  public function get_service($serviceId)
  {
    $this->db->where('serv_id', $serviceId);
    $query = $this->db->get('services');
    return $query->row();
  }

  public function insert_service($serviceData)
  {
    $this->db->insert('services', $serviceData);
    return $this->db->insert_id();
  }

  public function update_service($serviceId, $serviceData)
  {
    $this->db->where('serv_id', $serviceId);
    $this->db->update('services', $serviceData);
  }

  public function delete_service($serviceId)
  {
    $this->db->where('serv_id', $serviceId);
    $this->db->delete('services');
    return true;
  }
}
?>