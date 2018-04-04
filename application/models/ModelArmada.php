<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelArmada extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function showVehicleType ()
  {
    $query = $this->db->get('vehicletype');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showCargoCategory ()
  {
    $query = $this->db->get('cargocategory');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showBranchPoint ()
  {
    $this->db->where(array('branchstatus <>' => '5'));
    $query = $this->db->get('branch');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showAllArmada ()
  {
    $this->db->where(array('armadastatus <>' => '5'));
    $query = $this->db->get('armada');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showArmadaDetail ($idarmada)
  {
    $this->db->join('courier', 'courier.idcourier = armada.idcourier');
    $this->db->join('vehicletype', 'vehicletype.idvehicletype = armada.idvehicletype');
    $this->db->where('armada.idarmada', $idarmada);
    $query = $this->db->get('armada');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showArmadaRoute ($idarmada)
  {
    $this->db->select('departureidbranch, 
      a.branchname as meetingpoint, 
      a.branchaddress as mpaddress, 
      departureday, departuretime,
      arrivalidbranch, 
      b.branchname as droppoint, 
      b.branchaddress as dpaddress, 
      arrivalday, 
      arrivaltime');
    $this->db->join('branch a', 'a.idbranch = route.departureidbranch');
    $this->db->join('branch b', 'b.idbranch = route.arrivalidbranch');
    $this->db->where('route.idarmada', $idarmada);
    $query = $this->db->get('route');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    } 
  }

  public function showArmadaCargoCategory ($idarmada)
  {
    $this->db->join('armada', 'armada.idarmada = cargocategoryofarmada.idarmada');
    $this->db->join('cargocategory', 'cargocategory.idcargocategory = cargocategoryofarmada.idcargocategory');
    $this->db->where('armada.idarmada', $idarmada);
    $query = $this->db->get('cargocategoryofarmada');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    } 
  }

  public function deleteArmada ($idarmada)
  {
    $this->db->set('armadastatus', '5');
    $this->db->where(array('idarmada' => $idarmada));
    $this->db->update('armada');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function insertArmada ($idarmada,
    $vehiclenumber,
    $drivername,
    $armadaphone,
    $idvehicletype,
    $maxweight,
    $maxlength,
    $maxwidth,
    $maxheight)
  {
    $prepare = array('idarmada' => $idarmada,
      'idcourier' => 'COU002',
      'vehiclenumber' => $vehiclenumber,
      'drivername' => $drivername,
      'armadaphone' => $armadaphone,
      'idvehicletype' => $idvehicletype,
      'maxweight' => $maxweight,
      'maxlengthdimension' => $maxlength,
      'maxwidthdimension' =>  $maxwidth,
      'maxheightdimension' => $maxheight,
      'armadastatus' => '1');

    $this->db->insert('armada', $prepare);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function undoInsertArmada ($idarmada)
  {
    $this->db->delete('armada', array('idarmada' => $idarmada));
  }

  public function insertRoute ($idarmada,
    $departureidbranch,
    $arrivalidbranch,
    $departureday,
    $departuretime,
    $arrivalday,
    $arrivaltime,
    $fareperkilos,
    $fareperdimension)
  {
    $prepare = array('idarmada' => $idarmada,
      'departureidbranch' => $departureidbranch,
      'arrivalidbranch' => $arrivalidbranch,
      'departureday' => $departureday,
      'departuretime' => $departuretime,
      'arrivalday' => $arrivalday,
      'arrivaltime' => $arrivaltime,
      'fareperkilos' => $fareperkilos,
      'fareperdimension' => $fareperdimension);

    $this->db->insert('route', $prepare);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function undoInsertRoute ($idarmada)
  {
    $this->db->delete('route', array('idarmada' => $idarmada));
  }

  public function insertCargoCategoryOfArmada ($idarmada,
    $idcargocategory)
  {
    $prepare = array ('idarmada' => $idarmada,
      'idcargocategory' => $idcargocategory);

    $this->db->insert('cargocategoryofarmada', $prepare);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }
}
