<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAgent extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function showAllAgent()
  {
    $this->db->where(array('agentstatus <>' => '5'));
    $query = $this->db->get('agent');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showAgentDetail ($idagent)
  {
    $this->db->join('insurer', 'agent.idinsurer = insurer.idinsurer');
    $this->db->where('agent.idagent', $idagent);
    $query = $this->db->get('agent');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function insertInsurer ($insurerid,
    $insurername,
    $insureraddress,
    $insurerphone,
    $insurerstatus) 
  {
    $prepare = array ('idinsurer' => $insurerid,
    'insurername' => $insurername,
    'insureraddress' => $insureraddress,
    'insurerphone' => $insurerphone,
    'insurerstatusagent' => $insurerstatus);

    $this->db->insert('insurer', $prepare);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    } 
  }

  public function undoInsertInsurer ($idinsurer)
  {
    $this->db->delete('insurer', array('idinsurer' => $idinsurer));
  }

  public function insertAgent ($idagent,
    $idinsurer,
    $agentname,
    $agentemail,
    $agentidentitynumber,
    $agentphone,
    $agentaddress,
    $agentgender,
    $agentbirthdate,
    $idbranch)
  {
    $prepare = array ('idagent' => $idagent,
    'idinsurer' => $idinsurer,
    'agentname' => $agentname,
    'agentemail' => $agentemail,
    'agentidentitynumber' => $agentidentitynumber,
    'agentphone' => $agentphone,
    'agentaddress' => $agentaddress,
    'agentgender' => $agentgender,
    'agentbirthdate' => $agentbirthdate,
    'idbranch' => $idbranch,
    'lat' => '0',
    'lang' => '0',
    'agentstatus' => '0');

    $this->db->insert('agent', $prepare);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }  
  }

  public function deleteAgent ($idagent)
  {
    $this->db->set('agentstatus', '5');
    $this->db->where(array('idagent' => $idagent));
    $this->db->update('agent');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function editInsurer ($idinsurer,
    $insurername,
    $insureraddress,
    $insurerphone,
    $insurerstatusagent)
  {
    $prepare = array('insurername' => $insurername,
      'insureraddress' => $insureraddress,
      'insurerphone' => $insurerphone,
      'insurerstatusagent' => $insurerstatusagent);

    $this->db->where('idinsurer', $idinsurer);
    $this->db->update('insurer', $prepare);

    if ($this->db->affected_rows() < 0) {
      return false;
    } else {
      return true;
    }
  }

  public function editAgent ($idagent,
    $agentname,
    $agentphone,
    $agentaddress,
    $agentgender,
    $agentbirthdate,
    $agentstatus)
  {
    $prepare = array('agentname' => $agentname,
      'agentphone' => $agentphone,
      'agentaddress' => $agentaddress,
      'agentgender' => $agentgender,
      'agentbirthdate' => $agentbirthdate,
      'agentstatus' => $agentstatus);

    $this->db->where('idagent', $idagent);
    $this->db->update('agent', $prepare);

    if ($this->db->affected_rows() < 0) {
      return false;
    } else {
      return true;
    }
  }

}
