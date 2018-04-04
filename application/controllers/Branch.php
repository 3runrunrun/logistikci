<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

  public function index()
	{

	}

	// Show Branch's Data Management pages
  public function showBranchDataManagement ()
	{
		$data['allbranch'] = $this->ModelBranch->showAllBranch();
    if ($data['allbranch'] == false) {
      $data['allbranch'] = false;
    } else {
      $data['allbranch'] = $data['allbranch'];
    }
    
		$this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
		$this->load->view('datamanagement/branch', $data);
    $this->load->view('header-footer/dashboard-footer');
	}

  // Show Branch Detail to Modal
  public function showBranchDetailToModal ($idbranch)
  {
    $data['branchdetail'] = $this->ModelBranch->showBranchDetail($idbranch);
    echo json_encode($data);
  }

  // Generate ID Branch
  public function generateIdBranch ($idcity)
  {
    $this->ModelBranch->generateIdBranch($idcity);
  }

	// Add Branch process
  public function insertBranch ()
	{
    $idbranch = $this->input->post('idbranch');
    $branchname = $this->input->post('branchname');
    $branchaddress = $this->input->post('branchaddress');
    $branchphone = $this->input->post('branchphone');
    $branchmanager = $this->input->post('bmname');
    $bmemail = $this->input->post('bmemail');
    $idcity = $this->input->post('idcity');

		$isInsertBranchSuccess['data'] = $this->ModelBranch->insertBranch ($idbranch,
                                      $branchname,
                                      $branchaddress,
                                      $branchphone,
                                      $branchmanager,
                                      $bmemail,
                                      $idcity);

    if ($isInsertBranchSuccess['data'] == false) {
      $url = site_url('Branch/showBranchDataManagement');
      echo "<script>alert('Penambahan data Branch gagal, silahkan ulangi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      $url = site_url('Branch/showBranchDataManagement');
      echo "<script>alert('Penambahan data Branch berhasi.')</script>";
      echo "<script>window.location='$url'</script>";
    }  
	}

  // Delete Branch process
  public function deleteBranch ($idbranch)
  {
    $isDeleteBranchSuccess['data'] = $this->ModelBranch->deleteBranch($idbranch);

    if ($isDeleteBranchSuccess['data'] == false) {
      $url = site_url('Branch/showBranchDataManagement');
      echo "<script>alert('Hapus data Branch gagal, silahkan coba lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      $url = site_url('Branch/showBranchDataManagement');
      echo "<script>alert('Hapus data Branch berhasil.')</script>";
      echo "<script>window.location='$url'</script>";
    }
  }

  // Edit Branch process
  public function editBranch ()
  {
    $url = site_url('Branch/showBranchDataManagement');

    $idbranch = $this->input->post('idbranch');
    $branchname = $this->input->post('branchname');
    $branchaddress = $this->input->post('branchaddress');
    $branchphone = $this->input->post('branchphone');
    $branchmanager = $this->input->post('branchmanager');
    $branchstatus = $this->input->post('branchstatus');

    $isEditBranchSuccess['data'] = $this->ModelBranch->editBranch($idbranch,
      $branchname,
      $branchaddress,
      $branchphone,
      $branchmanager,
      $branchstatus);

    if ($isEditBranchSuccess['data'] == false) {
      echo "<script>alert('Pengubahan data Kantor Cabang gagal, silahkan ulangi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      echo "<script>alert('Pengubahan data Kantor Cabang berhasil.')</script>";
      echo "<script>window.location='$url'</script>";
    }
  }

}
