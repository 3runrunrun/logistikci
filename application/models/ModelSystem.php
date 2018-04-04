<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelSystem extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Admin Page function
   *
   */

	public function showAllProvince ()
	{
		$query = $this->db->get('province');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
	}

  public function showCityByProvince ($idprovince)
  {
    $this->db->where(array('idprovince' => $idprovince));
    $query = $this->db->get('city');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function branchTotal ($idcity)
  {
    $sql = "SELECT COUNT(idbranch) as active
            FROM branch
            WHERE idcity = ?";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  /**
   * Branch panel - admin
   * 
   */

  public function showBranchTotalByCity ($idcity)
  {
    $sql = "SELECT COUNT(idbranch) as total
            FROM branch
            WHERE idcity = ?";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showBranchActiveByCity ($idcity)
  {
    $sql = "SELECT COUNT(idbranch) as active
            FROM branch
            WHERE idcity = ? AND branchstatus = '1'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showBranchInactiveByCity ($idcity)
  {
    $sql = "SELECT COUNT(idbranch) as inactive
            FROM branch
            WHERE idcity = ? AND branchstatus = '0'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showBranchOnVacationByCity ($idcity)
  {
    $sql = "SELECT COUNT(idbranch) as onvacation
            FROM branch
            WHERE idcity = ? AND branchstatus = '2'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Agent panel - admin
  public function showAgentTotalByCity ($idcity)
  {
    $sql = "SELECT COUNT(agent.idagent) as total
            FROM agent
            JOIN branch ON agent.idbranch = branch.idbranch
            WHERE branch.idcity = ?";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showAgentInactiveByCity ($idcity)
  {
    $sql = "SELECT COUNT(agent.idagent) as inactive
            FROM agent
            JOIN branch ON agent.idbranch = branch.idbranch
            WHERE branch.idcity = ? and agent.agentstatus = '0'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showAgentOnVacationByCity ($idcity)
  {
    $sql = "SELECT COUNT(agent.idagent) as onvacation
            FROM agent
            JOIN branch ON agent.idbranch = branch.idbranch
            WHERE branch.idcity = ? and agent.agentstatus = '2'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showAgentActiveByCity ($idcity)
  {
    $sql = "SELECT COUNT(agent.idagent) as active
            FROM agent
            JOIN branch ON agent.idbranch = branch.idbranch
            WHERE branch.idcity = ? and agent.agentstatus = '1'";

    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function emailAvailibility ($email)
  {
    // $availability = false;
    $this->db->select('email');
    $this->db->where('email', $email);
    $query = $this->db->get('login');
    // echo $query;
    // echo $query->num_rows();
    if($query->num_rows() == 0){
      echo "true";
    } else {
      echo "false";
    }
  }

  public function showAllBranch ()
  {
    $query = $this->db->get('branch');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Reservation panel - admin
  public function showReservationTotalByCity ($idcity)
  {
    $sql = "SELECT COUNT(reservation.reservationcode) as total
            FROM reservation
            JOIN branch ON reservation.departureidbranch = branch.idbranch
            WHERE branch.idcity = ?";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showReservationReservedByCity ($idcity)
  {
    $sql = "SELECT COUNT(reservation.reservationcode) as reserved
            FROM reservation
            JOIN branch ON reservation.departureidbranch = branch.idbranch
            WHERE branch.idcity = ? AND reservation.reservationstatus = '1'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showReservationValidatedByCity ($idcity)
  {
    $sql = "SELECT COUNT(reservation.reservationcode) as validated
            FROM reservation
            JOIN branch ON reservation.departureidbranch = branch.idbranch
            WHERE branch.idcity = ? AND reservation.reservationstatus = '2'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showReservationRejectedByCity ($idcity)
  {
    $sql = "SELECT COUNT(reservation.reservationcode) as rejected
            FROM reservation
            JOIN branch ON reservation.departureidbranch = branch.idbranch
            WHERE branch.idcity = ? AND reservation.reservationstatus = '3'";
    $query = $this->db->query($sql, array($idcity));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Complain panel - admin

  /**
   * Monitoring Page Function
   * 
   */


  // !-- Validation table
  public function showNewCourier()
  {
    $this->db->where(array('courierstatus' => '0'));
    $query = $this->db->get('courier');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showDetailNewCourier ($idcourier)
  {  
    $this->db->join('owner', 'owner.idowner = courier.idowner');
    $this->db->where(array('idcourier' => $idcourier));
    $query = $this->db->get('courier');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function editOwnerData ($idowner,
    $ownername,
    $owneraddress,
    $ownerphone,
    $owneremail)
  {
    $data = array('ownername' => $ownername, 
      'owneraddress' => $owneraddress, 
      'ownerphone' => $ownerphone, 
      'owneremail' => $owneremail);

    $this->db->where('idowner', $idowner);
    $this->db->update('owner', $data);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }
  
  public function validateCourier ($idcourier,
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

    $this->db->set($prepare);
    $this->db->where(array('idcourier' => $idcourier));
    $this->db->update('courier');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }
  // Validation table --!

  // !-- Reservation table
  public function showReservation ($reservationstatus)
  {
    if ($reservationstatus != '0') {
      $this->db->where('reservationstatus', $reservationstatus);
    }

    $query = $this->db->get('reservationmonitor');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showReservationDetail ($reservationcode)
  {
    $this->db->where('reservationcode', $reservationcode);
    $query = $this->db->get('reservation');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

    // Validate Reservation

  public function updateReservation ($reservationcode,
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
    $fare) 
  {
    $prepare = array('cargoweight' => $cargoweight,
      'cargolength' => $cargolength,
      'cargowidth' => $cargowidth,
      'cargoheight' => $cargoheight,
      'insurance' => $insurance,
      'sendername' => $sendername,
      'senderaddress' => $senderaddress,
      'senderemail' => $senderemail,
      'senderphone' => $senderphone,
      'recipientname' => $recipientname,
      'recipientaddress' => $recipientaddress,
      'recipientphone' => $recipientphone,
      'idarmada' => $idarmada,
      'fare' => $fare);
    return $prepare;
      
    // $wheredata = array('reservationcode' => $reservationcode,
    //   'departureidbranch' => $departureidbranch,
    //   'arrivalidbranch' => $arrivalidbranch);

    // $this->db->where($wheredata);
    // $this->db->update('reservation', $prepare);
    
    // if ($this->db->affected_rows() < 0) {
    //   return false;
    // } else {
    //   return true;
    // }
  }

  public function validateReservation ($reservationcode)
  {
    $this->db->set(array('reservationstatus' => '2'));
    $this->db->where('reservationcode', $reservationcode);
    $this->db->update('reservation');
    
    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function insertFixedBooking ($receiptnumber,
    $idagent,
    $reservationcode,
    $bookingdate,
    $shipmentstatus,
    $goodsvalue,
    $insurancevalue)
  {
    $prepare = array('receiptnumber' => $receiptnumber,
      'idagent' => $idagent,
      'reservationcode' => $reservationcode,
      'bookingdate' => $bookingdate,
      'shipmentstatus' => $shipmentstatus,
      'goodsvalue' => $goodsvalue,
      'insurancevalue' => $insurancevalue);

    $this->db->insert('fixedbooking', $prepare);
    
    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

    // Validate Reservation

    // Reject Reservation
  public function rejectReservation ($reservationcode)
  {
    $this->db->set(array('reservationstatus' => '3'));
    $this->db->where('reservationcode', $reservationcode);
    $this->db->update('reservation');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }
    // Reject Reservation
  // Reservation table --!

  // !-- Expedition table
  public function showExpedition ($expeditionstatus)
  {
    if ($expeditionstatus != '0') {
      $this->db->where('shipmentstatus', $expeditionstatus);
    }

    $query = $this->db->get('expedition');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showManifestedPackage ($idarmada,
    $departureidbranch,
    $arrivalidbranch,
    $deliverydate)
  {
    $wheredate = array('idarmada' => $idarmada,
      'departureidbranch' => $departureidbranch,
      'arrivalidbranch' => $arrivalidbranch,
      'deliverydate' => $deliverydate,
      'reservationstatus' => '2');

    $this->db->select('reservationcode');
    $this->db->where($wheredate);
    $query = $this->db->get('reservation');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function getLoadedDetail ($reservationcode)
  {
    $this->db->select('receiptnumber,
      cargoweight');
    $this->db->join('reservation', 
      'reservation.reservationcode = fixedbooking.reservationcode');
    $this->db->where('fixedbooking.reservationcode', $reservationcode);
    $query = $this->db->get('fixedbooking');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showOnJourneyPackage ($idarmada,
    $departureidbranch,
    $arrivalidbranch,
    $deliverydate)
  {
    $wheredata = array('reservation.idarmada' => $idarmada,
      'reservation.departureidbranch' => $departureidbranch,
      'reservation.arrivalidbranch' => $arrivalidbranch,
      'reservation.deliverydate' => $deliverydate,
      'fixedbooking.shipmentstatus' => '2');

    $this->db->select('fixedbooking.receiptnumber, 
      reservation.cargoweight');
    $this->db->join('reservation', 
      'fixedbooking.reservationcode = reservation.reservationcode');
    $this->db->where($wheredata);
    $query = $this->db->get('fixedbooking');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function setExpeditionStatus ($receiptnumber,
    $shipmentstatus)
  {
    $this->db->set('shipmentstatus', $shipmentstatus);
    $this->db->where('receiptnumber', $receiptnumber);
    $this->db->update('fixedbooking');

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }
  // Expedition table --!

  // !-- Fixed Boooking table
  public function showFixedBooking ($shipmentstatus)
  {
    if ($shipmentstatus != '0') {
      $this->db->where('fixedbooking.shipmentstatus', $shipmentstatus);
    }
    
    $this->db->select('fixedbooking.receiptnumber,
      reservation.sendername,
      reservation.recipientname,
      reservation.cargoweight,
      fixedbooking.shipmentstatus');
    $this->db->join('reservation', 
      'fixedbooking.reservationcode = reservation.reservationcode');
    $query = $this->db->get('fixedbooking');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  } 

  public function showFixedBookingDetail ($receiptnumber)
  {
    $this->db->join('reservation', 
      'fixedbooking.reservationcode = reservation.reservationcode');
    $this->db->join('cargocategory',
      'reservation.idcargocategory = cargocategory.idcargocategory');
    $this->db->where('fixedbooking.receiptnumber', $receiptnumber);
    $query = $this->db->get('fixedbooking');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }
  // Fixed Boooking table --!

  // !-- Complaint table
  public function showComplaint ($complaintstatus)
  {
    if ($complaintstatus != '0') {
      $this->db->where('complaintstatus', $complaintstatus);
    } 
    
    $query = $this->db->get('complaint');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showComplaintDetail ($receiptnumber)
  {
    $this->db->where('receiptnumber', $receiptnumber);
    $query = $this->db->get('complaint');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }
  // Complaint table --!


  /**
  * Mandatory function for almost each form
  *
  */

  // Generating row ID
  public function idGenerator ($tableName)
  {
    if ($tableName == 'courier') {
      $query = $this->db->get('courier');
      if ($query->num_rows() < 9) {
        $number = $query->num_rows() + 1;
        echo "COU00".$number;
      } else if ($query->num_rows() >= 9 && $query->num_rows() < 99) {
        $number = $query->num_rows() + 1;
        echo "COU0".$number;
      } else {
        $number = $query->num_rows() + 1;
        echo "COU".$number;
      }
    } elseif ($tableName == 'reservation') {
      $query = $this->db->get('reservation');
      if ($query->num_rows() < 9) {
        $number = $query->num_rows() + 1;
        echo "RSV00".$number;
      } else if ($query->num_rows() >= 9 && $query->num_rows() < 99) {
        $number = $query->num_rows() + 1;
        echo "RSV0".$number;
      } else {
        $number = $query->num_rows() + 1;
        echo "RSV".$number;
      }
    } elseif ($tableName == 'agent') {
      $query = $this->db->get('agent');
      if ($query->num_rows() < 9) {
        $number = $query->num_rows() + 1;
        echo "AGN00".$number;
      } else if ($query->num_rows() >= 9 && $query->num_rows() < 99) {
        $number = $query->num_rows() + 1;
        echo "AGN0".$number;
      } else {
        $number = $query->num_rows() + 1;
        echo "AGN".$number;
      }
    } elseif ($tableName == 'insurer') {
      $query = $this->db->get('insurer');
      if ($query->num_rows() < 9) {
        $number = $query->num_rows() + 1;
        echo "INS00".$number;
      } else if ($query->num_rows() >= 9 && $query->num_rows() < 99) {
        $number = $query->num_rows() + 1;
        echo "INS0".$number;
      } else {
        $number = $query->num_rows() + 1;
        echo "INS".$number;
      }
    } elseif ($tableName == 'armada') {
      $query = $this->db->get('armada');
      if ($query->num_rows() < 9) {
        $number = $query->num_rows() + 1;
        echo "ARM00".$number;
      } else if ($query->num_rows() >= 9 && $query->num_rows() < 99) {
        $number = $query->num_rows() + 1;
        echo "ARM0".$number;
      } else {
        $number = $query->num_rows() + 1;
        echo "ARM".$number;
      }
    } 
  }

  // Show departure city, branch (and branch address)
  public function showDeparturePoint ()
  {
    $join = "SELECT city.city,
            branch.idbranch,
            branch.branchaddress
            FROM city, branch
            WHERE branch.idcity = city.idcity";

    $sql = "SELECT custom.city,
          route.departureidbranch,
          custom.branchaddress
          FROM route
          JOIN ($join) custom ON custom.idbranch = route.departureidbranch
          GROUP BY route.departureidbranch";

    $query = $this->db->query($sql);

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Show arrival city, branch (and branch address)
  public function showArrivalPoint ($departurepoint)
  {
    $join = "SELECT
            city.city,
            branch.idbranch,
            branch.branchaddress
            FROM city, branch
            WHERE branch.idcity = city.idcity";

    $sql = "SELECT custom.city,
          route.idarmada,
          route.departureidbranch,
          route.arrivalidbranch,
          custom.branchaddress
          FROM route
          JOIN ($join) custom ON custom.idbranch = route.arrivalidbranch
          WHERE route.departureidbranch = ?
          GROUP BY route.arrivalidbranch";

    $query = $this->db->query($sql, array($departurepoint));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Show available departure time by branch to branch
  public function showDepartureTime ($departureidbranch,
  $arrivalidbranch)
  {
    $this->db->select('DISTINCT(departuretime) as departuretime');
    $this->db->where(array(
      'departureidbranch' => $departureidbranch,
      'arrivalidbranch' => $arrivalidbranch));
    $query = $this->db->get('route');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Show available cargo category by branch to branch, departure time
  public function showAvailableCargoCategory ($departureidbranch,
  $arrivalidbranch,
  $departuretime)
  {
    $sql = "SELECT DISTINCT(cargocategory.idcargocategory), cargocategory.category
            FROM cargocategory
            JOIN cargocategoryofarmada
            ON cargocategoryofarmada.idcargocategory = cargocategory.idcargocategory
            WHERE cargocategoryofarmada.idarmada IN (SELECT idarmada
            FROM route
            WHERE route.departureidbranch = ? AND
            route.arrivalidbranch = ? AND
            route.departuretime = ?)";

    $query = $this->db->query($sql, array($departureidbranch,
              $arrivalidbranch,
              $departuretime));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Show available cargo category for selected route
  public function showCargoCategory()
  {
    $query = $this->db->get('cargocategory');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Show fare estimation
  public function showFareEstimation ($idarmada,
    $departureidbranch,
    $arrivalidbranch,
    $cargoweight,
    $cargolength,
    $cargowidth,
    $cargoheight)
  {
    $dimension = $cargolength * $cargowidth * $cargoheight;
    $sql = "SELECT
            (? * fareperkilos) as weightfare,
            (? * fareperdimension) as dimensionfare
            FROM route
            WHERE idarmada = ? AND
            departureidbranch = ? AND
            arrivalidbranch = ?";
    $query = $this->db->query($sql, array($cargoweight, $dimension, $idarmada, $departureidbranch, $arrivalidbranch));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  // Booking table Logging

  public function insertLogBooking ($receiptnumber,
    $lat,
    $lang,
    $shipmentstatus)
  {
    date_default_timezone_set("Asia/Jakarta");
    $timeevent = date("Y-m-d h:i:s");

    $prepare = array('receiptnumber' => $receiptnumber,
    'timeevent' => $timeevent,
    'lat' => $lat,
    'lang' => $lang,
    'shipmentstatus' => $shipmentstatus);
    $this->db->insert('logbooking', $prepare);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

}
