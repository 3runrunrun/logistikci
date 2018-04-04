<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index ()
	{
    $this->load->view('header-footer/home-header');
    $this->load->view('client/home2');
		$this->load->view('header-footer/footer');
	}

  public function NotFound ()
  {
    echo "<script>alert('Halaman tidak ditemukan. (404 Not Found)')</script>";
    echo "<script>history.back(0)</script>";
  }
  
  public function logout ()
  {
    $url = base_url();
    $this->session->sess_destroy();
    echo "<script>window.location='$url'</script>";
  }

  public function viewHalamanLogin ()
  {
    $this->load->view('header-footer/home-header');
    $this->load->view('client/login');
  }

  public function login ()
  {
    $uname = $this->input->post('email');
    $pwd = $this->input->post('pwd');
    $data['isExist'] = $this->ModelUser->isExistLogin($uname,
      $pwd);

    if ($data['isExist'] == false) {
      echo "<script>alert('Proses masuk gagal, silahkan coba lagi.')</script>";
      echo "<script>history.back(0)</script>";
    } else {
      foreach ($data['isExist'] as $exist) {
        $email = $exist['email'];
      }

      $data['isAdmin'] = $this->ModelUser->isItAdmin($email);
      $data['isManager'] = $this->ModelUser->isItBranchManager($email);
      $data['isAgent'] = $this->ModelUser->isItAgent($email);
      $data['isCourier'] = $this->ModelUser->isItCourier($email);

      if ($data['isAdmin'] == true) {
        $data['adminprofile'] = $this->ModelUser->showAdminProfile($email);
      } else if ($data['isManager'] ==  true) {
        $data['managerprofile'] = $this->ModelUser->showManagerProfile($email);
      } else if ($data['isAgent'] == true) {
        $data['agentprofile'] = $this->ModelUser->showAgentProfile($email);
      } else if ($data['isCourier'] == true) {
        $data['courierprofile'] = $this->ModelUser->showCourierProfile($email);
      }
      

    }
  }

	/**
	* Sign up
  *
	**/

	// Show Courier's Sign Up pages 
  public function viewHalamanDaftar()
	{
    $this->load->view('header-footer/home-header');
		$this->load->view('client/courierregistration');
	}

	// Courier's Sign Up process
  public function insertCourier()
	{
    $url = base_url();

		// courier variables
		$idcourier = $this->input->post('courierid');
		$couriername = $this->input->post('couriername');
		$courieraddress = $this->input->post('courieraddress');
		$courierphone = $this->input->post('courierphone');
		$couriermail = $this->input->post('couriermail');
		$courierpwdone = $this->input->post('courierpwdone');

		// ownervariables
		$idowner = $this->input->post('ownerid');
		$ownername = $this->input->post('ownername');
		$owneraddress = $this->input->post('owneraddress');
		$ownerphone = $this->input->post('ownerphone');
		$ownermail = $this->input->post('ownermail');

		$agreebtn = $this->input->post('agree');

		if (empty($agreebtn)) {
			return "error";
		} else {
      $isAnyBannedCourierOfOwner['data'] = $this->ModelUser->checkBannedCourierByOwnerId ($idowner);

      if ($isAnyBannedCourierOfOwner['data'] == false) {
        echo "<script>alert('Pendaftaran gagal, anda memiliki kurir yang masih diblokir oleh sistem.')</script>";
        echo "<script>history.back()</script>";
      } else {
        $isSuccess = $this->ModelUser->insertCourier($idcourier,
          $couriername,
          $courieraddress,
          $courierphone,
          $couriermail,
          $courierpwdone,
          $idowner,
          $ownername,
          $owneraddress,
          $ownerphone,
          $ownermail);

        if ($isSuccess == true) {
          echo "<script>alert('Pendaftaran berhasil, silahkan cek email anda untuk informasi yang lebih lengkap!')</script>";
          echo "<script>window.location='$url'</script>";
        } else {
          echo "<script>alert('Pendaftaran gagal, pastikan data yang anda masukkan benar!')</script>";
          echo "<script>history.back()</script>";
        }
      }	
		}
	}

  /**
  * Reservasi
  *
  **/

	// List all available armada by chosen option on 1st reservation form
	public function showAvailableArmada ()
	{
		setlocale(LC_TIME, 'Indonesian');
		$origincity = $this->input->post('origincity');
		$arrivalcity = $this->input->post('arrivalcity');
		$deliverydate = $this->input->post('deliverydate');
		$deliverytime = $this->input->post('deliverytime');
		$cargocategory = $this->input->post('cargocategory');
		$cargoweight = $this->input->post('cargoweight');
		$insurance = $this->input->post('insurance');
		$cargolength = $this->input->post('cargolength');
		$cargowidth = $this->input->post('cargowidth');
		$cargoheight = $this->input->post('cargoheight');

		$timestamp = strToTime($deliverydate);
		$departureday = strftime('%A', $timestamp);

    $dimension = $this->ModelUser->showDimensionCalculation($cargolength,
      $cargowidth,
      $cargoheight);

		$data['armadalist'] = $this->ModelUser->showAvailableArmada($cargoweight,
      $cargolength,
      $cargowidth,
      $cargoheight,
      $dimension,
      $origincity,
      $arrivalcity,
      $deliverytime,
      $departureday,
      $cargocategory);

		echo json_encode($data);
	}

	// Show address of each departure & arrival id branch on available armada list
  public function showReservationForm ($idarmada,
    $origincity,
    $arrivalcity,
    $deliverydate,
    $deliverytime,
    $cargocategory,
    $cargoweight,
    $insurance,
    $cargolength,
    $cargowidth,
    $cargoheight,
    $fare,
    $departuretime,
    $arrivaltime)
	{

    if ($idarmada == null 
      || $origincity == null 
      || $arrivalcity == null 
      || $deliverydate == null 
      || $deliverytime == null 
      || $cargocategory == null 
      || $cargoweight == null 
      || $insurance == null 
      || $cargolength == null 
      || $cargowidth == null 
      || $cargoheight == null 
      || $fare == null 
      || $departuretime == null 
      || $arrivaltime == null ) {
      echo "<script>alert('Access Forbidden');</script>";
      echo "<script>history.back(0)</script>";
    } else {
      $data['infokeberangkatan'] = $this->ModelUser->showDepartureInfo($origincity,
        $arrivalcity,
        $deliverydate,
        $deliverytime,
        $departuretime,
        $arrivaltime);

      $data['infobiaya'] = $this->ModelUser->showFareInfo($fare);

      $data['infomuatan'] = $this->ModelUser->showCargoInfo($cargocategory,
        $cargoweight,
        $insurance,
        $cargolength,
        $cargowidth,
        $cargoheight);

      $data['infoarmada'] = $this->ModelUser->showArmadaInfo($idarmada);
      $data['alamatasal'] = $this->ModelUser->showAddress($origincity);
      $data['alamattujuan'] = $this->ModelUser->showAddress($arrivalcity);
  	
      $this->load->view('header-footer/home-header');
      $this->load->view('client/shipmentreservation', $data);
      $this->load->view('header-footer/footer');
    }
	}

  // Show reserved cargo quota for calculatin available cargo 
  public function showReservedCargoQuota ($idarmada,
    $departureidbranch,
    $arrivalidbranch,
    $deliverydate,
    $deliverytime)
  {
    $concatdeliverytime = $deliverydate." ".$deliverytime;
    $data['reservedcargo'] = $this->ModelUser->showReservedCargoQuota($idarmada,
      $departureidbranch,
      $arrivalidbranch,
      $concatdeliverytime);

    if ($data['reservedcargo'] == false) {
      return false;
    } else {
      echo json_encode($data);
    }
  }

  // Insert Reservation
  public function insertReservation ()
  {
    $reservationcode = $this->input->post('reservationcode');
    $idarmada = $this->input->post('idarmada');
    $departureidbranch = $this->input->post('departureidbranch');
    $arrivalidbranch = $this->input->post('arrivalidbranch');
    // reservationdate
    $deliverydate = $this->input->post('deliverydate');
    $cargoweight = $this->input->post('cargoweight');
    $cargolength = $this->input->post('cargolength');
    $cargowidth = $this->input->post('cargowidth');
    $cargoheight = $this->input->post('cargoheight');
    $idcargocategory = $this->input->post('idcargocategory');
    $insurance = $this->input->post('insurance');
    $sendername = $this->input->post('sendername');
    $senderaddress = $this->input->post('senderaddress');
    $senderemail = $this->input->post('senderemail');
    $senderphone = $this->input->post('senderphone');
    $recipientname = $this->input->post('recipientname');
    $recipientaddress = $this->input->post('recipientaddress');
    $recipientphone = $this->input->post('recipientphone');
    $fare = $this->input->post('fare');
    // lat
    // lang
    // reservationstatus

    $isSuccess['data'] = $this->ModelUser->insertReservation ($reservationcode,
    $idarmada,
    $departureidbranch,
    $arrivalidbranch,
    $deliverydate,
    $cargoweight,
    $cargolength,
    $cargowidth,
    $cargoheight,
    $idcargocategory,
    $insurance,
    $sendername,
    $senderaddress,
    $senderemail,
    $senderphone,
    $recipientname,
    $recipientaddress,
    $recipientphone,
    $fare);

    if ($isSuccess['data'] == false) {
      $url = base_url();
      echo "<script>alert('Reservasi gagal, silahkan ulangi proses reservasi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {

      foreach ($isSuccess['data'] as $v) {
        $isSuccess['infoarmada'] = $this->ModelUser->showArmadaInfo($v['idarmada']);
        $isSuccess['inforute'] = $this->ModelUser->showRoute ($v['idarmada'], $v['departureidbranch'],
        $v['arrivalidbranch']);
        $isSuccess['kotaasal'] = $this->ModelUser->showAddress($v['departureidbranch']);
        $isSuccess['kotatujuan'] = $this->ModelUser->showAddress($v['arrivalidbranch']);
      }

      $this->load->view('header-footer/home-header');
      $this->load->view('client/reservationreceipt', $isSuccess);
      $this->load->view('header-footer/footer');
    }
  }

	/**
	* Tracking
	* Dibawah ini adalah serangkaian method
	* yang digunakan oleh fungsional TRACKING (TRACKON)
	**/

	public function showTrackingResult ()
  {
    $receiptnumber = $this->input->post('receiptnumber');
    $exploded = explode(",", $receiptnumber);
    $result['trackingresult'] = array();

    for ($i=0; $i < count($exploded); $i++) { 
      $data['trackingresult'] = $this->ModelUser->showTrackingResult ($exploded[$i]);

      if ($data['trackingresult'] == false) {
        $result['trackingresult'] = false;
        break;
      }
      
      array_push($result['trackingresult'], $data['trackingresult']); 
    }

    $this->load->view('header-footer/home-header');
    $this->load->view('client/trackonresult', $result);
    $this->load->view('header-footer/footer');
  }

  public function showTrackingDetail ($receiptnumber)
  {
    $data['trackingdetail'] = $this->ModelUser->showTrackingDetail($receiptnumber);
    $data['shipmenthistory'] = $this->ModelUser->showShipmentHistory($receiptnumber);

    if ($data['trackingdetail'] == false 
      || $data['shipmenthistory'] == false) {
      echo "<script>alert('Data tidak ditemukan, kembali ke halaman sebelumnya.')</script>";
      echo "<script>history.back(0)</script>";
    } else {
      $this->load->view('header-footer/home-header');
      $this->load->view('client/trackonresultdetail', $data);
      $this->load->view('header-footer/footer');
    }
  }

	/**
	* Complaint
	* Dibawah ini adalah serangkaian method
	* yang digunakan oleh fungsional Complaing (Pengaduan)
	**/

	public function viewHalamanComplaint ()
	{
    $this->load->view('header-footer/home-header');
    $this->load->view('client/addcomplaint');
		$this->load->view('header-footer/footer');
	}

  public function insertComplaint ()
  {
    $url = site_url('User/viewHalamanComplaint');
    $receiptnumber = $this->input->post('receiptnumber');
    $complaint = $this->input->post('complaint');

    $data['isexist'] = $this->ModelUser->isReceiptNumberExist ($receiptnumber);

    if ($data['isexist'] == false) {
      echo "<script>alert('Nomor Resi yang anda masukkan tidak dikenali.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      $data['insertcomplaint'] = $this->ModelUser->insertComplaint ($receiptnumber,
          $complaint);

      if ($data['insertcomplaint'] == false) {
        echo "<script>alert('Penyampaian keluhan gagal, silahkan coba lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        echo "<script>alert('Keluhan berhasil disampaikan, mohon tunggu tindak lanjut atas keluhan anda. Terima kasih.')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }
  }

  /**
  * Testimonial
  * Dibawah ini adalah serangkaian method
  * yang digunakan oleh fungsional Testimonial
  **/

  public function viewHalamanTestimonial ()
  {
    $this->load->view('header-footer/home-header');
    $this->load->view('client/addtestimonial');
    $this->load->view('header-footer/footer');
  }

  public function insertTestimonial ()
  {
    $url = site_url('User/viewHalamanTestimonial');
    $receiptnumber = $this->input->post('receiptnumber');
    $testimonial = $this->input->post('testimonial');

    $data['isexist'] = $this->ModelUser->isReceiptNumberExist ($receiptnumber);

    if ($data['isexist'] == false) {
      echo "<script>alert('Nomor Resi yang anda masukkan tidak dikenali.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      $data['inserttestimonial'] = $this->ModelUser->insertTestimonial ($receiptnumber,
          $testimonial);

      if ($data['inserttestimonial'] == false) {
        echo "<script>alert('Penyampaian testimoni gagal, silahkan coba lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        echo "<script>alert('Testimoni berhasil disampaikan, kami sangat mengapresiasi feedback yang anda berikan. Terima kasih.')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }
  }

}
