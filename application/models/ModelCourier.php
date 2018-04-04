<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelCourier extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function showAllCourier()
  {
    $this->db->where(array('courierstatus <>' => '5'));
    $query = $this->db->get('courier');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showCourierDetail ($idcourier)
  {
    $this->db->join('owner', 'courier.idowner = owner.idowner');
    $this->db->where('courier.idcourier', $idcourier);
    $query = $this->db->get('courier');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function editCourier ($idcourier,
    $couriername,
    $courieraddress,
    $courierphone,
    $courieremail,
    $courierstatus)
  {
    $prepare = array('couriername' => $couriername,
    'courieraddress' => $courieraddress,
    'courierphone' => $courierphone,
    'courieremail' => $courieremail,
    'courierstatus' => $courierstatus);

    $this->db->where('idcourier', $idcourier);
    $this->db->update('courier', $prepare);

    if ($this->db->affected_rows() < 0) {
      return false;
    } else {
      return true;
    }
  }

  public function editOwner ($idowner,
    $ownername,
    $owneraddress,
    $ownerphone,
    $owneremail)
  {
    $prepare = array('ownername' => $ownername,
    'owneraddress' => $owneraddress,
    'ownerphone' => $ownerphone,
    'owneremail' => $owneremail);

    $this->db->where('idowner', $idowner);
    $this->db->update('owner', $prepare);

    if ($this->db->affected_rows() < 0) {
      return false;
    } else {
      return true;
    }
  }

  public function deleteCourier ($idcourier) 
  {
    $this->db->set('courierstatus', '5');
    $this->db->where(array('idcourier' => $idcourier));
    $this->db->update('courier');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function undoDeleteCourier ($idcourier)
  {
    $this->db->set('courierstatus', '0');
    $this->db->where(array('idcourier' => $idcourier));
    $this->db->update('courier');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function showRemainingCourierOfOwner ($idowner)
  {
    $this->db->select('idcourier, courierstatus');
    $this->db->where(array('idowner' => $idowner,
      'courierstatus <>' => '5'));
    $query = $this->db->get('courier');

    if ($query->num_rows() < 1) {
      return 0;
    } else {
      return $query->num_rows();
    } 
  }

  public function deleteOwnerByOwnerId ($idowner)
  {
    $this->db->delete('owner', array('idowner' => $idowner));

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

}
