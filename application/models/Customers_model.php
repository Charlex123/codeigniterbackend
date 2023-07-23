
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_model extends CI_model {
  
  public function getAllCustomers()
  {
    // $this->db->where('is_active', 1);
    $query = $this->db->get('customers');
    return $query->result();
  }

  public function get_customer($customerId)
  {
    $this->db->where('cust_id', $customerId);
    $query = $this->db->get('customers');
    return $query->row();
  }

  public function insert_customer($customerData)
  {
    $this->db->insert('customers', $customerData);
    return $this->db->insert_id();
  }

  public function update_customer($customerId, $customerData)
  {
    $this->db->where('cust_id', $customerId);
    $this->db->update('customers', $customerData);
  }

  public function delete_customer($customerId)
  {
    $this->db->where('cust_id', $customerId);
    $this->db->delete('customers');
    return true;
  }
}
?>