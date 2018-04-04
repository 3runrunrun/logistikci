<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelUser extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  /**
  * Check login existenced data
  *
  */

  public function isExistLogin ($uname,
    $pwd)
  {
    $wheredata = array ('email' => $uname,
      'pwd' => $pwd);
    $this->db->where($wheredata);
    $query = $this->db->get('login');
    
    if ($query->num_rows() != 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function isItAdmin ($email)
  {
    $this->db->where('adminemail', $email);
    $query = $this->db->get('admin');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return true;
    }
  }

  public function showAdminProfile ($email)
  {
    $query = $this->db->get('admin');
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function isItBranchManager ($email)
  {
    $this->db->where('bmemail', $email);
    $query = $this->db->get('branch');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return true;
    }
  }

  public function showManagerProfile ($email)
  {
    $this->db->where('bmemail', $email);
    $query = $this->db->get('branch');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function isItAgent ($email)
  {
    $this->db->where('agentemail', $email);
    $query = $this->db->get('agent');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return true;
    }
  }

  public function showAgentProfile ($email)
  {
    $this->db->join('branch', 'branch.idbranch = agent.idbranch');
    $this->db->where('agentemail', $email);
    $query = $this->db->get('agent');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function isItCourier ($email)
  {
    $this->db->where('courieremail', $email);
    $query = $this->db->get('courier');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return true;
    }
  }

  public function showCourierProfile ($email)
  {
    $this->db->where('courieremail', $email);
    $query = $this->db->get('courier');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  /**
  * /Check login existenced data
  */

  // Insert Owner of an Courier data
  public function insertOwner($ownerdata)
  {
    $this->db->insert('owner', $ownerdata);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // Insert login data (email & password) of Courier
  public function insertLogin($logindata)
  {
    $this->db->insert('login', $logindata);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function checkBannedCourierByOwnerId ($idowner)
  {
    $this->db->where(array('idowner' => $idowner,
      'courierstatus' => '3'));
    $query = $this->db->get('courier');
    if ($query->num_rows() > 0) {
      return false;
    } else {
      return true;
    }
  }

  // Insert new Courier data
  public function insertCourier($idcourier,
    $couriername,
    $courieraddress,
    $courierphone,
    $couriermail,
    $courierpwdone,
    $idowner,
    $ownername,
    $owneraddress,
    $ownerphone,
    $ownermail)
  {
    // Owner data
    $ownerdata = array(
      'idowner' => $idowner,
      'ownername' => $ownername,
      'owneraddress' => $owneraddress,
      'ownerphone' => $ownerphone,
      'owneremail' => $ownermail);

    //  Courier data
    $courierdata = array(
      'idcourier' => $idcourier,
      'idowner' => $idowner,
      'couriername' => $couriername,
      'courieraddress' => $courieraddress,
      'courierphone' => $courierphone,
      'courieremail' => $couriermail,
      'courierstatus' => '0');

    // Login data
    $logindata = array(
      'email' => $couriermail,
      'pwd' => $courierpwdone);

    // Insert data process
    $isOwnerSuccess = $this->ModelUser->insertOwner($ownerdata);
    if ($isOwnerSuccess == true) {
      $this->db->insert('courier', $courierdata);
      if ($this->db->affected_rows() > 0) {
        $isLoginSuccess = $this->ModelUser->insertLogin($logindata);
        if ($isLoginSuccess == true) {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  /**
   * Reservation Function 
   * 
   */

  public function showReservedCargoQuota ($idarmada,
    $departureidbranch,
    $arrivalidbranch,
    $deliverydate)
  {
    $this->db->select('SUM(cargoweight) as rweight,
      SUM(cargolength) as rlength,
      SUM(cargowidth) as rwidth,
      SUM(cargoheight) as rheight');
    $this->db->where(array('idarmada' => $idarmada,
      'departureidbranch' => $departureidbranch,
      'arrivalidbranch' => $arrivalidbranch,
      'deliverydate' => $deliverydate,
      'reservationstatus' => '2'));
    $query = $this->db->get('reservation');

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showDimensionCalculation ($cargolength,
    $cargowidth,
    $cargoheight)
  {
    $dimension = $cargolength * $cargowidth * $cargoheight;
    return $dimension;
  }

  public function showAvailableArmada($cargoweight,
    $cargolength,
    $cargowidth,
    $cargoheight,
    $dimension,
    $origincity,
    $arrivalcity,
    $deliverytime,
    $departureday,
    $cargocategory)
  {
    $sql = "SELECT armada.idarmada,
      route.departureidbranch,
      route.departuretime,
      route.arrivalidbranch,
      route.arrivaltime,
      armada.maxweight - ? - (armada.maxweight*0.1) AS beratsisa, 
      armada.maxlengthdimension - ? - (armada.maxlengthdimension*0.1) AS panjangsisa, 
      armada.maxwidthdimension - ? - (armada.maxwidthdimension*0.1) AS lebarsisa, 
      armada.maxheightdimension - ? - (armada.maxheightdimension*0.1) AS tinggisisa,
      (maxlengthdimension*maxwidthdimension*maxheightdimension) - ? AS dimensisisa,
      route.fareperdimension * ? AS dimensionfare,
      route.fareperkilos * ? AS weightfare
      FROM armada
      JOIN route ON armada.idarmada = route.idarmada
      JOIN cargocategoryofarmada ON cargocategoryofarmada.idarmada = armada.idarmada
      WHERE route.departureidbranch = ? AND
      route.arrivalidbranch = ? AND
      route.departuretime = ? AND
      route.departureday = ? AND
      cargocategoryofarmada.idcargocategory = ?";

    $query = $this->db->query($sql, array($cargoweight,
      $cargolength,
      $cargowidth,
      $cargoheight,
      $dimension,
      $dimension,
      $cargoweight,
      $origincity,
      $arrivalcity,
      $deliverytime,
      $departureday,
      $cargocategory));

    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showArmadaInfo ($idarmada)
  {
    $this->db->select('idarmada, vehiclenumber, drivername, armadaphone');
    $this->db->where(array('idarmada' => $idarmada));
    $query = $this->db->get('armada');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  } 

  public function showAddress ($idbranch)
  {
    $this->db->select('city.city, branchaddress');
    $this->db->join('city', 'city.idcity = branch.idcity');
    $this->db->where(array('idbranch' => $idbranch));
    $query = $this->db->get('branch');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showRoute ($idarmada,
    $departureidbranch,
    $arrivalidbranch)
  {
    $this->db->where(array('idarmada' => $idarmada,
    'departureidbranch' => $departureidbranch,
    'arrivalidbranch' => $arrivalidbranch));

    $query = $this->db->get('route');

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showDepartureInfo ($origincity,
    $arrivalcity,
    $deliverydate,
    $deliverytime,
    $departuretime,
    $arrivaltime)
  {
    $sql = "SELECT ? AS origincity,
    ? AS arrivalcity,
    ? AS deliverydate,
    ? AS deliverytime,
    ? AS departuretime,
    ? AS arrivaltime
    FROM DUAL";

    $query = $this->db->query($sql, array($origincity,
    $arrivalcity,
    $deliverydate,
    $deliverytime,
    $departuretime,
    $arrivaltime));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }
  }

  public function showFareInfo ($fare)
  {
    $sql = "SELECT ? AS fare FROM DUAL";

    $query = $this->db->query($sql, array($fare));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    } 
  }

  public function showCargoInfo ($cargocategory,
    $cargoweight,
    $insurance,
    $cargolength,
    $cargowidth,
    $cargoheight)
  {
    $sql = "SELECT ? AS cargocategory,
    ? AS cargoweight,
    ? AS insurance,
    ? AS cargolength,
    ? AS cargowidth,
    ? AS cargoheight
    FROM DUAL";

    $query = $this->db->query($sql, array($cargocategory,
    $cargoweight,
    $insurance,
    $cargolength,
    $cargowidth,
    $cargoheight));

    if ($query->num_rows() < 1) {
      echo NULL;
    } else {
      return $query->result_array();
    }  
  }

  public function insertReservation ($reservationcode,
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
    $fare)
  {
    $preparedata = array ('reservationcode' => $reservationcode,
    'idarmada' => $idarmada,
    'departureidbranch' => $departureidbranch,
    'arrivalidbranch' => $arrivalidbranch,
    'reservationdate' => date("Y-m-d H:i:s"),
    'deliverydate' => $deliverydate,
    'cargoweight' => $cargoweight,
    'cargolength' => $cargolength,
    'cargowidth' => $cargowidth,
    'cargoheight' => $cargoheight,
    'idcargocategory' => $idcargocategory,
    'insurance' => $insurance,
    'sendername' => $sendername,
    'senderaddress' => $senderaddress,
    'senderemail' => $senderemail,
    'senderphone' => $senderphone,
    'recipientname' => $recipientname,
    'recipientaddress' => $recipientaddress,
    'recipientphone' => $recipientphone,
    'fare' => $fare,
    'lat' => '1',
    'lang' => '1',
    'reservationstatus' => '1');

    $this->db->insert('reservation', $preparedata);

    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      $this->db->where(array('reservationcode' => $reservationcode));
      $query = $this->db->get('reservation');
      return $query->result_array();
    }
  }

  /**
   * Tracking Function 
   * 
   */

  public function showTrackingResult ($receiptnumber) 
  {
    $this->db->where('receiptnumber', $receiptnumber);
    $this->db->limit(1);
    $query = $this->db->get('tracking');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showTrackingDetail ($receiptnumber)
  {
    $this->db->where('receiptnumber', $receiptnumber);
    $query = $this->db->get('trackingdetail');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  public function showShipmentHistory ($receiptnumber) 
  {
    $this->db->where('receiptnumber', $receiptnumber);
    $query = $this->db->get('shipmenthistory');
    
    if ($query->num_rows() < 1) {
      return false;
    } else {
      return $query->result_array();
    }
  }

  /**
   * Complaint Function 
   * 
   */

  public function isReceiptNumberExist ($receiptnumber)
  {
    $this->db->where('receiptnumber', $receiptnumber);
    $numrows = $this->db->count_all_results('fixedbooking');
    if ($numrows < 1) {
      return false;
    } else {
      return true;
    }
  }

  public function insertComplaint ($receiptnumber,
    $complaint)
  {
    $prepare = array('receiptnumber' => $receiptnumber,
      'complaintdate' => date("Y-m-d h:i:s"),
      'complaint' => $complaint,
      'complaintstatus' => '1');
    $this->db->insert('complaint', $prepare);
    
    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

  /**
   * Testimonial Function 
   * 
   */

  public function insertTestimonial ($receiptnumber,
    $testimonial)
  {
    $prepare = array('receiptnumber' => $receiptnumber,
      'testimonialdate' => date("Y-m-d h:i:s"),
      'testimonial' => $testimonial);
    $this->db->insert('testimonial', $prepare);
    
    if ($this->db->affected_rows() != 1) {
      return false;
    } else {
      return true;
    }
  }

}
