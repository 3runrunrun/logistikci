<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courier extends CI_Controller {

  public function index()
	{

	}

	// Show Courier's Data Management pages
  public function showCourierDataManagement ()
	{
		$data['allcourier'] = $this->ModelCourier->showAllCourier();

    if ($data['allcourier'] ==  false) {
      $data['allcourier'] == false;
    } else {
      $data['allcourier'] = $data['allcourier'];
    }
    
		$this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
		$this->load->view('datamanagement/courier', $data);
    $this->load->view('header-footer/dashboard-footer');
	}

  // Show Courier Detail into Modal
  public function showCourierDetail ($idcourier)
  {
    $data['courierdetail'] = $this->ModelCourier->showCourierDetail($idcourier);
    echo json_encode($data);
  }

  // Edit Courier process
  public function editCourierAndOwner ()
  {
    $url = site_url('Courier/showCourierDataManagement');

    // Courier data
    $idcourier = $this->input->post('idcourier');
    $couriername = $this->input->post('couriername');
    $courieraddress = $this->input->post('courieraddress');
    $courierphone = $this->input->post('courierphone');
    $courieremail = $this->input->post('courieremail');
    $courierstatus = $this->input->post('courierstatus');

    // Owner data
    $idowner = $this->input->post('idowner');
    $ownername = $this->input->post('ownername');
    $owneraddress = $this->input->post('owneraddress');
    $ownerphone = $this->input->post('ownerphone');
    $owneremail = $this->input->post('owneremail');

    $isEditCourierSuccess['data'] = $this->ModelCourier->editCourier($idcourier,
      $couriername,
      $courieraddress,
      $courierphone,
      $courieremail,
      $courierstatus);

    $isEditOwnerSuccess['data'] = $this->ModelCourier->editOwner($idowner,
      $ownername,
      $owneraddress,
      $ownerphone,
      $owneremail);

    if ($isEditCourierSuccess['data'] == false && $isEditOwnerSuccess['data'] == false) {
      echo "<script>alert('Pengubahan data kurir gagal, silahkan ulangi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      echo "<script>alert('Pengubahan data kurir berhasil.')</script>";
      echo "<script>window.location='$url'</script>";
    }
  }

	// Delete Courier process
  public function deleteCourier ($idcourier)
	{
    $url = site_url('Courier/showCourierDataManagement');

		$isSuccessDeleteCourier['data'] = $this->ModelCourier->deleteCourier($idcourier);

    if ($isSuccessDeleteCourier['data'] == false) {
      echo "<script>alert('Hapus data Courier gagal, silahkan coba lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      echo "<script>alert('Hapus data Courier berhasil.')</script>";
      echo "<script>window.location='$url'</script>";
    }    
  }

}
