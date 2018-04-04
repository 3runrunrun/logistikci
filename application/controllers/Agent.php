<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

  public function index()
	{

	}

  // Agent Data Management pages
	public function showAgentDataManagement ()
	{
		$data['allagent'] = $this->ModelAgent->showAllAgent();
    if ($data['allagent']) {
      $data['allagent'] == false;
    } else {
      $data['allagent'] = $data['allagent'];
    }
    
		$this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
		$this->load->view('datamanagement/agent', $data);
    $this->load->view('header-footer/dashboard-footer');
	}

  // Show Agent Detail
  public function showAgentDetail ($idagent)
  {
    $data['agentdetail'] = $this->ModelAgent->showAgentDetail($idagent);
    echo json_encode($data); 
  }

	// Show Agent profile
  public function showProfil()
	{
		$this->load->view('profilheader');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
		$this->load->view('profil');
	}

  public function insertAgent ()
  {
    $idagent = $this->input->post('idagent');
    $agentname = $this->input->post('agentname');
    $agentemail = $this->input->post('agentemail');
    $agentidentitynumber = $this->input->post('agentidentitynumber');
    $agentphone = $this->input->post('agentphone');
    $agentaddress = $this->input->post('agentaddress');
    $agentgender = $this->input->post('agentgender');
    $agentbirthdate = $this->input->post('agentbirthdate');
    $idbranch = $this->input->post('idbranch');
    $idinsurer = $this->input->post('insurerid');
    $insurername = $this->input->post('insurername');
    $insureraddress = $this->input->post('insureraddress');
    $insurerphone = $this->input->post('insurerphone');
    $insurerstatus = $this->input->post('insurerstatus');

    $isInsertInsurerSuccess['data'] = $this->ModelAgent->insertInsurer ($idinsurer,
                                $insurername,
                                $insureraddress,
                                $insurerphone,
                                $insurerstatus);

    

    if ($isInsertInsurerSuccess['data'] == false) {
      $url = site_url('Agent/showAgentDataManagement');
      echo "<script>alert('Penambahan data agen gagal, silahkan ulangi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      $isInsertAgentSuccess['data'] = $this->ModelAgent->insertAgent ($idagent,
                                        $idinsurer,
                                        $agentname,
                                        $agentemail,
                                        $agentidentitynumber,
                                        $agentphone,
                                        $agentaddress,
                                        $agentgender,
                                        $agentbirthdate,
                                        $idbranch);

      if ($isInsertAgentSuccess['data'] == false) {
        $this->ModelAgent->undoInsertInsurer($idinsurer);
        $url = site_url('Agent/showAgentDataManagement');
        echo "<script>alert('Penambahan data agen gagal, silahkan ulangi sekali lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        $url = site_url('Agent/showAgentDataManagement');
        echo "<script>alert('Penambahan data agen berhasi.')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }
  }

  public function deleteAgent ($idagent)
  {
    $isDeleteAgentSuccess['data'] = $this->ModelAgent->deleteAgent($idagent);

    if ($isDeleteAgentSuccess['data'] == false) {
      $url = site_url('Agent/showAgentDataManagement');
      echo "<script>alert('Hapus data Agent gagal, silahkan coba lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      $url = site_url('Agent/showAgentDataManagement');
      echo "<script>alert('Hapus data Agent berhasil.')</script>";
      echo "<script>window.location='$url'</script>";
    }
  }

  public function editAgentAndInsurer ()
  {
    $url = site_url('Agent/showAgentDataManagement');

    // New data for agent
    $idagent = $this->input->post('idagent');
    $agentname = $this->input->post('agentname');
    $agentphone = $this->input->post('agentphone');
    $agentaddress = $this->input->post('agentaddress');
    $agentgender = $this->input->post('agentgender');
    $agentbirthdate = $this->input->post('agentbirthdate');
    $agentstatus = $this->input->post('agentstatus');

    // New data for Agent's Insurer
    $idinsurer = $this->input->post('idinsurer');
    $insurername = $this->input->post('insurername');
    $insureraddress = $this->input->post('insureraddress');
    $insurerphone = $this->input->post('insurerphone');
    $insurerstatusagent = $this->input->post('insurerstatusagent');

    $isEditAgentSuccess['data'] = $this->ModelAgent->editAgent($idagent,
      $agentname,
      $agentphone,
      $agentaddress,
      $agentgender,
      $agentbirthdate,
      $agentstatus);

    $isEditInsurerSuccess['data'] = $this->ModelAgent->editInsurer ($idinsurer,
      $insurername,
      $insureraddress,
      $insurerphone,
      $insurerstatusagent);

    if ($isEditAgentSuccess['data'] == false && $isEditInsurerSuccess['data'] == false) {
      echo "<script>alert('Pengubahan data agen gagal, silahkan ulangi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      echo "<script>alert('Pengubahan data insurer berhasil.')</script>";
      echo "<script>window.location='$url'</script>";
    }
  }

  
}
