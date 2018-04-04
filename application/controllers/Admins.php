<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function index()
	{
    $this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
    $this->load->view('dashboard/admin');
		$this->load->view('header-footer/dashboard-footer');
	}

  /**
   * Monitoring Pages Function
   * 
   */

  
	public function showMonitoring()
	{
		$this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
    $this->load->view('monitoring/monitoring');
		$this->load->view('header-footer/dashboard-footer');
	}

  // !-- Validation table
  public function showNewCourier ()
  {
    $data['newcourier'] = $this->ModelSystem->showNewCourier();
    echo json_encode($data);
  }

  public function showDetailNewCourier ($idcourier)
  {
    $data['courierdetail'] = $this->ModelSystem->showDetailNewCourier($idcourier);
    echo json_encode($data);
  }

  public function validateNewCourier ()
  {
    $url = site_url('Admins/showMonitoring');

    $idowner = $this->input->post('idowner');
    $ownername = $this->input->post('ownername');
    $owneraddress = $this->input->post('owneraddress');
    $ownerphone = $this->input->post('ownerphone');
    $owneremail= $this->input->post('owneremail');
    $idcourier = $this->input->post('idcourier');
    $couriername = $this->input->post('couriername');
    $courieraddress = $this->input->post('courieraddress');
    $courierphone = $this->input->post('courierphone');
    $courieremail = $this->input->post('courieremail');

    /*if (empty($this->input->post('validate'))) {
      $courierstatus = '4';
    } else if (empty($this->input->post('reject'))) {
      $courierstatus = '1';
    }*/

    if ($this->input->post('validate') == null) {
      $courierstatus = '4';
    } else if ($this->input->post('reject') == null) {
      $courierstatus = '1';
    }

    $isValidateNewCourier['data'] = $this->ModelSystem->validateCourier($idcourier,
      $couriername,
      $courieraddress,
      $courierphone,
      $courieremail,
      $courierstatus);

    if ($isValidateNewCourier['data'] == false) {
      echo "<script>alert('Validasi kurir gagal, silahkan ulangi sekali lagi.')</script>";
      echo "<script>window.location='$url'</script>";
    } else {
      if ($courierstatus == '4') {
        echo "<script>alert('Validasi kurir berhasil. Kurir ditolak.')</script>";
        echo "<script>window.location='$url'</script>";
      } else if ($courierstatus == '1') {
        echo "<script>alert('Validasi kurir berhasil. Kurir diterima.')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }
  }
  // Validation table --!

  // !-- Reservation table
  public function showReservation ()
  {
    $reservationstatus = $this->input->post('reservationstatus');
    $data['reservationlist'] = $this->ModelSystem->showReservation($reservationstatus);
    echo json_encode($data);
  }

  public function showReservationDetail ()
  {
    $reservationcode = $this->input->post('reservationcode');
    $data['reservationdetail'] = $this->ModelSystem->showReservationDetail($reservationcode);
    echo json_encode($data);
  }

  public function validateOrRejectReservation ()
  {
    $url = site_url('Admins/showMonitoring');

    $reservationcode = $this->input->post('reservationcode');
    $departureidbranch = $this->input->post('departureidbranch');
    $arrivalidbranch = $this->input->post('arrivalidbranch');
    $cargoweight = $this->input->post('cargoweight');
    $cargolength = $this->input->post('cargolength');
    $cargowidth = $this->input->post('cargowidth');
    $cargoheight = $this->input->post('cargoheight');
    $insurance = $this->input->post('insurance');
    $goodsvalue = $this->input->post('goodsvalue');
    $sendername = $this->input->post('sendername');
    $senderaddress = $this->input->post('senderaddress');
    $senderemail = $this->input->post('senderemail');
    $senderphone = $this->input->post('senderphone');
    $recipientname = $this->input->post('recipientname');
    $recipientaddress = $this->input->post('recipientaddress');
    $recipientphone = $this->input->post('recipientphone');
    $idarmada = $this->input->post('idarmada');
    $fare = (float)$this->input->post('fare');

    $str = $reservationcode.$departureidbranch.$arrivalidbranch;
    $trimmedstr = substr(md5($str), 0,20);
    date_default_timezone_set("Asia/Jakarta");

    /**
    * fixed booking data
    *
    */
    $receiptnumber = strtoupper($trimmedstr);
    $idagent = 'AGN001'; // change to session soon
    // reservationcode
    $bookingdate = date("Y-m-d h:i:s");
    $shipmentstatus = '1';

    // Check insurance status, set goodsvalue and insurancevalue
    $goodsvalue = 0; // default value
    $insurancevalue = 0; // default value
    if ($insurance == '0') {
      $goodsvalue = $goodsvalue;
      $insurancevalue = $insurancevalue;
    } else {
      $goodsvalue = (float)$this->input->post('goodsvalue');
      $insurancevalue = $goodsvalue * 0.1;
      $fare = $fare + $insurancevalue;
    }

    /**
     * Log Booking data
     * 
     */

    // $timeevent = date("Y-m-d h:i:s");
    $lat = '2'; // change to agent's lat soon
    $lang = '2'; // change to agent's lang soon
    // $shipmentstatus = the same as fixedbooking shipment status

    /**
     * Validation & Rejection Process
     *
     */
    // if (empty($this->input->post('validate'))) {
    if ($this->input->post('validate') == null) {
      $data['reject'] = $this->ModelSystem->rejectReservation ($reservationcode);

      if ($data['reject'] == false) {
        echo "<script>alert('Penolakan reservasi gagal, silahkan coba lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        echo "<script>alert('Penolakan reservasi berhasil.')</script>";
        echo "<script>window.location='$url'</script>";
      }    
    // } else if (empty($this->input->post('reject'))) {
    } else if ($this->input->post('reject') == null) {
      // update udpate reservation
      $data['updateReservation'] = $this->ModelSystem->updateReservation($reservationcode,
        $departureidbranch,
        $arrivalidbranch,
        $cargoweight,
        $cargolength,
        $cargowidth,
        $cargoheight,
        $insurance,
        $sendername,
        $senderaddress,
        $senderemail,
        $senderphone,
        $recipientname,
        $recipientaddress,
        $recipientphone,
        $idarmada,
        $fare);

      // Change reservation status to "validate"
      $data['validateReservation'] = $this->ModelSystem->validateReservation ($reservationcode);

      // insert fixed booking
      $data['insertFixedBooking'] = $this->ModelSystem->insertFixedBooking ($receiptnumber,
        $idagent,
        $reservationcode,
        $bookingdate,
        $shipmentstatus,
        $goodsvalue,
        $insurancevalue);

      // insert log booking
      $data['insertLogBooking'] = $this->ModelSystem->insertLogBooking ($receiptnumber,
        $lat,
        $lang,
        $shipmentstatus);

      if ($data['updateReservation'] == false 
        && $data['validateReservation'] == false 
        && $data['insertFixedBooking'] == false
        && $data['insertLogBooking'] == false) {
        echo "<script>alert('Validasi reservasi gagal, silahkan coba lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        echo "<script>alert('Validasi reservasi berhasil, Tarif yang dikenakan pada customer adalah Rp " . $fare . ".')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }
  }
  // Reservation table --!

  // !-- Expedition table
  public function showExpedition ()
  {
    $expeditionstatus = $this->input->post('expeditionstatus');
    $data['expeditionlist'] = $this->ModelSystem->showExpedition($expeditionstatus);
    
    echo json_encode($data);
  }

  public function showManifestedPackage ()
  {
    $expcode = $this->input->post('expcode');

    $exploded = explode("-", $expcode);

    $idarmada = $exploded[0];
    $departureidbranch = $exploded[1];
    $arrivalidbranch = $exploded[2];
    $deliverydate = $exploded[3] . "-" . $exploded[4] . "-" . $exploded[5];

    $data['manifestedpackage'] = $this->ModelSystem->showManifestedPackage ($idarmada,
      $departureidbranch,
      $arrivalidbranch,
      $deliverydate);

    echo json_encode($data);
  }

  public function getLoadedDetail ()
  {
    $reservationcode = $this->input->post('reservationcode');
    $data['loadeddetail'] = $this->ModelSystem->getLoadedDetail ($reservationcode);
    echo json_encode($data);
  }

  public function showOnJourneyPackage ()
  {
    $expcode = $this->input->post('expcode');

    $exploded = explode("-", $expcode);

    $idarmada = $exploded[0];
    $departureidbranch = $exploded[1];
    $arrivalidbranch = $exploded[2];
    $deliverydate = $exploded[3] . "-" . $exploded[4] . "-" . $exploded[5];

    $data['onjourneypackage'] = $this->ModelSystem->showOnJourneyPackage ($idarmada,
      $departureidbranch,
      $arrivalidbranch,
      $deliverydate);

    echo json_encode($data);
  }

  public function setExpeditionStatus ()
  {
    $url = site_url('Admins/showMonitoring');
    $receiptnumber = $this->input->post('receiptnumber');
    $exploded = explode(",", $receiptnumber);
    $shipmentstatus = '1';
    $flag = true;

    // if (empty($this->input->post('set'))) {
    if ($this->input->post('set') == null) {
      $shipmentstatus = $shipmentstatus;
    // } else if (empty($this->input->post('cancel'))) {
    } else if ($this->input->post('cancel') == null) {
      $lat = '4';
      $lang = '4';
      $shipmentstatus = '2';

      for ($i=0; $i < count($exploded) ; $i++) {

        if ($flag == true) {
          $receiptnumber = $exploded[$i];

          $data['expstatus'] = $this->ModelSystem->setExpeditionStatus ($receiptnumber,
            $shipmentstatus);

          $data['insertLogBooking'] = $this->ModelSystem->insertLogBooking ($receiptnumber,
            $lat,
            $lang,
            $shipmentstatus);
         } 
          
        if ($data['expstatus'] == false 
          || $data['insertLogBooking'] == false) {
          $flag = false;
          break;
        } else {
          $flag = true;
        }
      }

      if ($flag == false) {
        echo "<script>alert('Pengubahan status ekspedisi gagal, silahkan coba lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        echo "<script>alert('Status ekspedisi berhasil diuabah menjadi On-Journey, seluruh status muatan didalam armada berhasil diubah menjadi On-Process.')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }  
  }

  public function setArrived ()
  {
    $url = site_url('Admins/showMonitoring');
    $receiptnumber = $this->input->post('receiptnumber');
    $exploded = explode(",", $receiptnumber);
    $shipmentstatus = '2';
    $flag = true;

    // if (empty($this->input->post('set'))) {
    if ($this->input->post('set') == null) {
      $shipmentstatus = $shipmentstatus;
    // } else if (empty($this->input->post('cancel'))) {
    } else if ($this->input->post('cancel') == null) {
      $lat = '3';
      $lang = '3';
      $shipmentstatus = '4';

      for ($i=0; $i < count($exploded) ; $i++) {

        if ($flag == true) {
          $receiptnumber = $exploded[$i];

          $data['arrstatus'] = $this->ModelSystem->setExpeditionStatus ($receiptnumber,
            $shipmentstatus);

          $data['insertLogBooking'] = $this->ModelSystem->insertLogBooking ($receiptnumber,
            $lat,
            $lang,
            $shipmentstatus);
         } 
          
        if ($data['arrstatus'] == false 
          || $data['insertLogBooking'] == false) {
          $flag = false;
          break;
        } else {
          $flag = true;
        }
      }

      if ($flag == false) {
        echo "<script>alert('Pengubahan status ekspedisi gagal, silahkan coba lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        echo "<script>alert('Status ekspedisi dan muatan berhasil diubah menjadi Arrived.')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }  
  }
  // Expedition table --!

  // !-- Fixed Booking table
  public function showFixedBooking () 
  {
    $shipmentstatus = $this->input->post('shipmentstatus');
    $data['fixedbookinglist'] = $this->ModelSystem->showFixedBooking ($shipmentstatus);
    echo json_encode($data);
  }

  public function showFixedBookingDetail ()
  {
    $receiptnumber = $this->input->post('receiptnumber');
    $data['fixedbookingdetail'] = $this->ModelSystem->showFixedBookingDetail ($receiptnumber);
    echo json_encode($data);
  }

  public function setDelivered ()
  {
    $url = site_url('Admins/showMonitoring');
    $receiptnumber = $this->input->post('receiptnumber');
    $shipmentstatus = $this->input->post('shipmentstatus');

    // if (empty($this->input->post('deliver'))) {
    if ($this->input->post('deliver') == null) {
      $shipmentstatus = $shipmentstatus;
    } else {
      $lat = '0';
      $lang = '0';
      $shipmentstatus = '5';

      $data['deliverstatus'] = $this->ModelSystem->setExpeditionStatus ($receiptnumber,
        $shipmentstatus);

      $data['insertLogBooking'] = $this->ModelSystem->insertLogBooking ($receiptnumber,
        $lat,
        $lang,
        $shipmentstatus);

      if ($data['deliverstatus'] == false 
        || $data['insertLogBooking'] == false) {
        echo "<script>alert('Pengubahan status pengiriman gagal, silahkan coba lagi.')</script>";
        echo "<script>window.location='$url'</script>";
      } else {
        echo "<script>alert('Barang telah diterima oleh penerima, status pengiriman berhasil diubah menjadi Delivered.')</script>";
        echo "<script>window.location='$url'</script>";
      }
    }  
  }
  // Fixed Booking table --!

  // !-- Complaint table
  public function showComplaint ()
  {
    $complaintstatus = $this->input->post('complaintstatus');
    $data['complaintlist'] = $this->ModelSystem->showComplaint ($complaintstatus);
    echo json_encode($data);
  }

  public function showComplaintDetail ()
  {
    $receiptnumber = $this->input->post('receiptnumber');
    $data['complaintdetail'] = $this->ModelSystem->showComplaintDetail ($receiptnumber);
    echo json_encode($data);
  }
  // Complaint table --!

  
  /**
   * History Pages Function
   * 
   */

	public function showHistory()
	{
		$this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
		$this->load->view('history/history');
	}

  // Show report pages
	public function showReport()
	{
		$this->load->view('dashboard/header');
		$this->load->view('topnavigation-xs');
		$this->load->view('navbar');
		$this->load->view('sidebarmenu');
		$this->load->view('report/report');
	}
  
}
