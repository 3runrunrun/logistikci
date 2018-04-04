<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Armada extends CI_Controller {

  public function index()
	{

	}

  // Show Vehicle Type on Dropdown
  public function showVehicleType ()
  {
    $data['vehicletype'] = $this->ModelArmada->showVehicleType();
    echo json_encode($data);
  }

  // Show Cargo Category on Dropdown
  public function showCargoCategory ()
  {
    $data['cargocategory'] = $this->ModelArmada->showCargoCategory();
    echo json_encode($data);
  }

  // Show Branch Point on Dropdown
  public function showBranchPoint ()
  {
    $data['branchpoint'] = $this->ModelArmada->showBranchPoint();
    echo json_encode($data);
  }

	// Show Armada's Data Management pages
  public function showArmadaDataManagement ()
	{
		$data['allarmada'] = $this->ModelArmada->showAllArmada();

    if ($data['allarmada'] == false) {
      $data['allarmada'] = false;
    } else {
      $data['allarmada'] = $data['allarmada'];
    }
    
		$this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
    $this->load->view('datamanagement/armada', $data);
		$this->load->view('header-footer/dashboard-footer');
	}

  // Show Armada detail
  public function showArmadaDetail ($idarmada)
  {
    $data['armadadetail'] = $this->ModelArmada->showArmadaDetail($idarmada);
    $data['armadacargo'] = $this->ModelArmada->showArmadaCargoCategory($idarmada);
    $data['armadaroute'] = $this->ModelArmada->showArmadaRoute($idarmada);
    echo json_encode($data);
  }

  // Delete Armada Process
  public function deleteArmada ($idarmada)
  {
    $url = site_url('Armada/showArmadaDataManagement');
    
    $isDeleteArmadaSuccess['data'] = $this->ModelArmada->deleteArmada($idarmada);

    if ($isDeleteArmadaSuccess['data'] == false) {
      echo "<script>alert('Hapus data Armada gagal, silahkan coba lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      echo "<script>alert('Hapus data Armada berhasil.')</script>";
      echo "<script>window.location='$url'</script>";
    }
  }

  // Insert Armada Process
  public function insertArmada ()
  {
    $url = site_url('Armada/showArmadaDataManagement');

    // Posted value for Armada's table
    $idarmada = $this->input->post('idarmada');
    // idcourier from session
    $vehiclenumber = $this->input->post('vehiclenumber');
    $drivername = $this->input->post('drivername');
    $armadaphone = $this->input->post('armadaphone');
    $idvehicletype = $this->input->post('idvehicletype');
    $maxweight = $this->input->post('maxweight');
    $maxlength = $this->input->post('maxlength');
    $maxwidth = $this->input->post('maxwidth');
    $maxheight = $this->input->post('maxheight');
    // armadastatus

    // Posted value for Route's table
    $departureidbranch = $this->input->post('departureidbranch');
    $arrivalidbranch = $this->input->post('arrivalidbranch');
    $departureday = $this->input->post('departureday');
    $departuretime = $this->input->post('departuretime');
    $arrivalday = $this->input->post('arrivalday');
    $arrivaltime = $this->input->post('arrivaltime');
    $fareperkilos = $this->input->post('fareperkilos');
    $fareperdimension = $this->input->post('fareperdimension');

    // Posted value for CargoCategoryofArmada's Table
    $idarmada = $this->input->post('idarmada');
    $idcargocategory = $this->input->post('idcargocategory'); 

    $isInsertArmadaSuccess['data'] = $this->ModelArmada->insertArmada ($idarmada,
      $vehiclenumber,
      $drivername,
      $armadaphone,
      $idvehicletype,
      $maxweight,
      $maxlength,
      $maxwidth,
      $maxheight);

    if ($isInsertArmadaSuccess['data'] == false) {
      echo "<script>alert('Penambahan data armada gagal, silahkan ulangi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      $isInsertRouteSuccess['data'] = $this->ModelArmada->insertRoute ($idarmada,
        $departureidbranch,
        $arrivalidbranch,
        $departureday,
        $departuretime,
        $arrivalday,
        $arrivaltime,
        $fareperkilos,
        $fareperdimension);

      if ($isInsertRouteSuccess['data'] == false) {
        $this->ModelArmada->undoInsertArmada($idarmada);
        echo "<script>alert('Penambahan data armada gagal, silahkan ulangi sekali lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        $isInsertCargoCategorySuccess['data'] = $this->ModelArmada->insertCargoCategoryOfArmada ($idarmada,
            $idcargocategory);

        if ($isInsertCargoCategorySuccess['data'] == false) {
          $this->ModelArmada->undoInsertRoute ($idarmada);
          $this->ModelArmada->undoInsertArmada($idarmada);
          echo "<script>alert('Penambahan data armada gagal, silahkan ulangi sekali lagi.')</script>";
          echo "<script>window.location='$url'</script>";
        } else {
          echo "<script>alert('Penambahan data armada berhasil.')</script>";
          echo "<script>window.location='$url'</script>";
        } 
      } 
    }
  }

  // Insert Route of New Armada
  public function insertRoute ()
  {
    $idarmada = $this->input->post('idarmada');
    $departureidbranch = $this->input->post('departureidbranch');
    $arrivalidbranch = $this->input->post('arrivalidbranch');
    $departureday = $this->input->post('departureday');
    $departuretime = $this->input->post('departuretime');
    $arrivalday = $this->input->post('arrivalday');
    $arrivaltime = $this->input->post('arrivaltime');
    $fareperkilos = $this->input->post('fareperkilos');
    $fareperdimension = $this->input->post('fareperdimension');
  }


  public function insertCargoCategoryOfArmada ()
  {
    $idarmada = $this->input->post('idarmada');
    $idcargocategory = $this->input->post('idcargocategory');   
  }

}
