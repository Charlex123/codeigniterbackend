
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_model {
  
  public function getAllContacts()
  {
    // $this->db->where('is_active', 1);
    $query = $this->db->get('contact');
    return $query->result();
  }

  public function get_contact($contactId)
  {
    $this->db->where('id', $contactId);
    $query = $this->db->get('contact');
    return $query->row();
  }

  public function insert_contact($contactData)
  {
    $this->db->insert('contact', $contactData);
    return $this->db->insert_id();
  }

  public function update_contact($contactId, $contactData)
  {
    $this->db->where('id', $contactId);
    $this->db->update('contact', $contactData);
  }

  public function delete_contact($contactId)
  {
    $this->db->where('id', $contactId);
    $this->db->delete('contact');
    return true;
  }
}
?>