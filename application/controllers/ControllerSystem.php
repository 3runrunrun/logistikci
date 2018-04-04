<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerSystem extends CI_Controller {

	public function index()
	{
		$this->load->view('client/home');
	}

	/**
	* Admin Page function
	*
	*/

	// Province dropdown
	public function showAllProvince ()
	{
		$data['province'] = $this->ModelSystem->showAllProvince();
		echo json_encode($data);
	}

	// City dropdown
	public function showCityByProvince ()
	{
		$idprovince = $this->input->post('idprovince');
		$data['city'] = $this->ModelSystem->showCityByProvince($idprovince);
		echo json_encode($data);
	}

	// Branch panel admin
	public function showBranchTotalByCity ()
	{
		$idcity = $this->input->post('idcity');
		$data['total'] = $this->ModelSystem->showBranchTotalByCity($idcity);
		$data['active'] = $this->ModelSystem->showBranchActiveByCity($idcity);
		$data['onvacation'] = $this->ModelSystem->showBranchOnVacationByCity($idcity);
		$data['inactive'] = $this->ModelSystem->showBranchInactiveByCity($idcity);
		echo json_encode($data);
	}

	// Agent panel admin
	public function showAgentTotalByCity ()
	{
		$idcity = $this->input->post('idcity');
		$data['total'] = $this->ModelSystem->showAgentTotalByCity($idcity);
		$data['active'] = $this->ModelSystem->showAgentActiveByCity($idcity);
		$data['onvacation'] = $this->ModelSystem->showAgentOnVacationByCity($idcity);
		$data['inactive'] = $this->ModelSystem->showAgentInactiveByCity($idcity);
		echo json_encode($data);
	}

  // Reservation panel admin
  public function showReservationTotalByCity () 
  {
    $idcity = $this->input->post('idcity');
    $data['total'] = $this->ModelSystem->showReservationTotalByCity ($idcity);
    $data['reserved'] = $this->ModelSystem->showReservationReservedByCity ($idcity);
    $data['validated'] = $this->ModelSystem->showReservationValidatedByCity ($idcity);
    $data['rejected'] = $this->ModelSystem->showReservationRejectedByCity($idcity);
    echo json_encode($data);
  }

  // Show all branch for dropdown item on "Add Agent" page
  public function showAllBranch ()
  {
    $data['branch'] = $this->ModelSystem->showAllBranch();
    echo json_encode($data);
  }


	/**
	* Client Page function
	*
	*/

  // Generating column ID
	public function idGenerator ($tableName) 
	{
		$this->ModelSystem->idGenerator($tableName);
	}

	// Check availability of a new email courier 
  public function emailAvailibility ()
	{
		$email = $this->input->post('nilai');
		$this->ModelSystem->emailAvailibility($email);
	}

	// Show departure point on 1st reservation form
  public function showDeparturePoint ()
	{
		$data['results'] = $this->ModelSystem->showDeparturePoint();
		echo json_encode($data);
	}

  // Show arrival point on 1st reservation form
	public function showArrivalPoint ()
	{
		$departurepoint = $this->input->post('berangkat');
		$data['results'] = $this->ModelSystem->showArrivalPoint($departurepoint);
		echo json_encode($data);
	}

	// Show departure time by chosen departure id branch and arrival id branch
	public function showDepartureTime ($departureidbranch, $arrivalidbranch)
	{
		$data['departuretime'] = $this->ModelSystem->showDepartureTime($departureidbranch,$arrivalidbranch);
		echo json_encode($data);
	}

	/**
  * Show available cargo category by chosen departure id branch, arrival id branch and 
  * departure time
  *
  **/
  public function showAvailableCargoCategory ()
	{
		$departureidbranch = $this->input->post('keberangkatan');
	  $arrivalidbranch = $this->input->post('kedatangan');
	  $departuretime = $this->input->post('deliverytime');

		$data['cargocategory'] = $this->ModelSystem->showAvailableCargoCategory ($departureidbranch,
			$arrivalidbranch,
			$departuretime);
		echo json_encode($data);
	}

  /**
  * Login
  *
  */
  

}
