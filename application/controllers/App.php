<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index(){
		$this->load->view('header');

		if ($this->input->post('results')) {
			if ($this->form_validation->run('results')) {
				$count_checked_turbines = 0;
				$turbine_id;
				for($i = 1 ; $i <= 5 ; $i++){
					if($this->input->post("is_turbine".$i)){
						$count_checked_turbines++;
						$turbine_id = $i;
					}
				}
				if($count_checked_turbines >= 2){
					$this->results();
				}
				// Cas particulier pour une seule turbine :
				else if($count_checked_turbines == 1) {
					$this->load->model('Optimisation_model');
					$elevAmont = $this->input->post("upper_elevation");
					$qTotal = $this->input->post("total_flow");
					$max_flow = $this->input->post("max_flow".$turbine_id);
					$coeffTurbine = $this->Optimisation_model->getCoeffTurbine($turbine_id);
					$coeffAval = $this->Optimisation_model->getCoeffElevationAval();
					$elevAval = $coeffAval['p1']*pow($qTotal,2) + $coeffAval['p2']*$qTotal + $coeffAval['p3'];

					if($max_flow > $qTotal){
						$max_flow = $qTotal;
					}
					$turbine_for_prod = new Turbine($turbine_id, $max_flow, true, $coeffTurbine, $elevAmont, $elevAval);
					$optimal_prod = $turbine_for_prod->production($max_flow);
					$turbine[$turbine_id] = array($max_flow, $optimal_prod);

					// open the file "demosaved.csv" for writing
					$file = fopen('resultats.csv', 'w');
					// save the column headers
					fputcsv($file, array('q1', 'p1', 'q2', 'p2', 'q3', 'p3', 'q4', 'p4', 'q5', 'p5', 'qTotal', 'pTotal'));
					$row = array();
					for($i=1 ; $i<=5 ; $i++){
						if($turbine_id == $i){
							array_push($row, $max_flow);
							array_push($row, $optimal_prod);
						} else {
							array_push($row, 0);
							array_push($row, 0);
						}
					}
					array_push($row, $max_flow);
					array_push($row, $optimal_prod);
					// save each row of the data
					fputcsv($file, $row);
					// Close the file
					fclose($file);
					$this->load->view('results', array("turbines" => $turbine));
				}
				//Fin du cas particulier
				else {
					$this->load->view('application');
				}
			}
				else $this->load->view('application');
			}
		else{
			$this->load->view('application');
		}

		$this->load->view('footer');
		}

		private function results(){
			// open the file "demosaved.csv" for writing
			$file = fopen('resultats.csv', 'w');
			// save the column headers
			fputcsv($file, array('q1', 'p1', 'q2', 'p2', 'q3', 'p3', 'q4', 'p4', 'q5', 'p5', 'qTotal', 'pTotal'));

			$elevAmont = $this->input->post("upper_elevation");
			$qTotal = $this->input->post("total_flow");

			$this->load->model('Optimisation_model');
			$coeffAval = $this->Optimisation_model->getCoeffElevationAval();
			//Calculation of the elevAval using our approximation function
			$elevAval = $coeffAval['p1']*pow($qTotal,2) + $coeffAval['p2']*$qTotal + $coeffAval['p3'];

			//Construction turbine 1 :
			if($this->input->post("is_turbine1")){
				if($this->input->post("max_flow1") == ""){
					$max_flow1 = $qTotal;
				} else {
					$max_flow1 = $this->input->post("max_flow1");
				}

				$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(1);
				$turbine1 = new Turbine(1, $max_flow1, true, $coeffTurbine, $elevAmont, $elevAval);
			} else {
				$turbine1 = new Turbine(1, 0, false, 0, $elevAmont, $elevAval);
			}

			//Construction turbine 2 :
			if($this->input->post("is_turbine2")){
				if($this->input->post("max_flow2") == ""){
					$max_flow2 = $qTotal;
				} else {
					$max_flow2 = $this->input->post("max_flow2");
				}
				$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(2);
				$turbine2 = new Turbine(2, $max_flow2, true, $coeffTurbine, $elevAmont, $elevAval);
			} else {
				$turbine2 = new Turbine(2, 0, false, 0, $elevAmont, $elevAval);
			}

			//Construction turbine 3 :
			if($this->input->post("is_turbine3")){
				if($this->input->post("max_flow3") == ""){
					$max_flow3 = $qTotal;
				} else {
					$max_flow3 = $this->input->post("max_flow3");
				}
				$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(3);
				$turbine3 = new Turbine(3, $max_flow3, true, $coeffTurbine, $elevAmont, $elevAval);
			} else {
				$turbine3 = new Turbine(3, 0, false, 0, $elevAmont, $elevAval);
			}

			//Construction turbine 4 :
			if($this->input->post("is_turbine4")){
				if($this->input->post("max_flow4") == ""){
					$max_flow4 = $qTotal;
				} else {
					$max_flow4 = $this->input->post("max_flow4");
				}
				$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(4);
				$turbine4 = new Turbine(4, $max_flow4, true, $coeffTurbine, $elevAmont, $elevAval);
			} else {
				$turbine4 = new Turbine(4, 0, false, 0, $elevAmont, $elevAval);
			}

			//Construction turbine 5 :
			if($this->input->post("is_turbine5")){
				if($this->input->post("max_flow5") == ""){
					$max_flow5 = $qTotal;
				} else {
					$max_flow5 = $this->input->post("max_flow5");
				}
				$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(5);
				$turbine5 = new Turbine(5, $max_flow5, true, $coeffTurbine, $elevAmont, $elevAval);
			} else {
				$turbine5 = new Turbine(5, 0, false, 0, $elevAmont, $elevAval);
			}

			$dp = new DynamicProgram($turbine1, $turbine2, $turbine3, $turbine4, $turbine5, $qTotal);

			$dp->backward();
			$qLeft = $dp->forward();
			//echo('Débit restant à turbiner : '.$qLeft.' à 5m3/s près.<br><br>');

			$pTotal = $turbine1->getOptimalProduction()+$turbine2->getOptimalProduction()+$turbine3->getOptimalProduction()
			+$turbine4->getOptimalProduction()+$turbine5->getOptimalProduction();

			// Sample data. This can be fetched from mysql too
			$row = array($turbine1->getOptimalQ(), $turbine1->getOptimalProduction(),
									 $turbine2->getOptimalQ(), $turbine2->getOptimalProduction(),
									 $turbine3->getOptimalQ(), $turbine3->getOptimalProduction(),
									 $turbine4->getOptimalQ(), $turbine4->getOptimalProduction(),
									 $turbine5->getOptimalQ(), $turbine5->getOptimalProduction(),
								 	 $qTotal, $pTotal);
			// save each row of the data
			fputcsv($file, $row);
			// Close the file
			fclose($file);

			$turbines = array();
			foreach ($dp->getTurbineArray() as $num_turbine => $turbine) {
				$turbines[$turbine->getId()] = array($turbine->getOptimalQ(), $turbine->getOptimalProduction());
			}
			$this->load->view('results', array("turbines" => $turbines));
		}
}
