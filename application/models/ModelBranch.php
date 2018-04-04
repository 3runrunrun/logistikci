<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelBranch extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function showAllBranch()
  {
    $this->db->where(array('branchstatus <>' => '5'));
    $query = $this->db->get('branch');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showBranchDetail ($idbranch)
  {
    $this->db->where('idbranch', $idbranch);
    $query = $this->db->get('branch');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function editBranch ($idbranch,
    $branchname,
    $branchaddress,
    $branchphone,
    $branchmanager,
    $branchstatus)
  {
    $prepare = array('branchname' => $branchname,
      'branchaddress' => $branchaddress,
      'branchphone' => $branchphone,
      'branchmanager' => $branchmanager,
      'branchstatus' => $branchstatus);

    $this->db->where('idbranch', $idbranch);
    $this->db->update('branch', $prepare);
    
    if ($this->db->affected_rows() < 0) {
      return false;
    } else {
      return true;
    }
  }

  public function generateIdBranch ($idcity)
  {
    $this->db->where(array('idcity' => $idcity));
    $query = $this->db->get('branch');
    if ($query->num_rows() < 9) {
        $number = $query->num_rows() + 1;
        echo $idcity . "00" . $number;
      } else if ($query->num_rows() >= 9 && $query->num_rows() < 99) {
        $number = $query->num_rows() + 1;
        echo $idcity . "0" . $number;
      } else {
        $number = $query->num_rows() + 1;
        echo $idcity . $number;
      }
  }

  public function insertBranch ($idbranch,
    $branchname,
    $branchaddress,
    $branchphone,
    $branchmanager,
    $bmemail,
    $idcity)
  {
    $data = array (
    'idbranch' => $idbranch,
    'branchname' => $branchname,
    'branchaddress' => $branchaddress,
    'branchphone' => $branchphone,
    'branchmanager' => $branchmanager,
    'bmemail' => $bmemail,
    'idcity' => $idcity,
    'lat' => '0',
    'lang' => '0',
    'branchstatus' => '1');

    $this->db->insert('branch', $data);

    if ($this->db->affected_rows() != 1) {
			return false;
		} else {
      return true;
    }
  }

  public function deleteBranch($idbranch)
  {
    $this->db->set('branchstatus', '5');
    $this->db->where(array('idbranch' => $idbranch));
    $this->db->update('branch');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }
}
