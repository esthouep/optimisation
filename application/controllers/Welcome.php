<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		//$this->load->model('Optimisation_model');
		$this->load->view('header');
		$this->load->view('welcome');
		$this->load->view('footer');
		// open the file "demosaved.csv" for writing
		//$file = fopen('stats.csv', 'w');
		// save the column headers
		//fputcsv($file, array('q1', 'p1', 'q2', 'p2', 'q3', 'p3', 'q4', 'p4', 'q5', 'p5', 'qTotal'));

		//Getting data from our database
		/*for($i=1; $i<=200; $i++){
			echo('RESOLUTION DU PROBLEME D\'OPTIMISATION DE LA LIGNE '.$i.'<br>');
			$dataGeneral = $this->Optimisation_model->getQTotalAndNiveauAmont($i);
			$qTotal = $dataGeneral['qTotal'];
			$elevAmont = $dataGeneral['niveauAmont'];
			echo('Débit à répartir : '.$qTotal.' m3/s<br><br>');
			echo('Elevaltion Amont : '.$elevAmont.'m');
			$coeffAval = $this->Optimisation_model->getCoeffElevationAval();
			//Calculation of the elevAval using our approximation function
			$elevAval = $coeffAval['p1']*pow($qTotal,2) + $coeffAval['p2']*$qTotal + $coeffAval['p3'];

			//Construction turbine 1 :
			//The value true represents availability and can be modified

			$dataTurbine = $this->Optimisation_model->getDataTurbine($i,1);
			$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(1);
			$turbine1 = new Turbine(1, 160, true, $coeffTurbine, $elevAmont, $elevAval);
			echo('Pour la turbine 1, débit réellement utilisé : '.$dataTurbine['q1'].' m3/s'.'<br>');

			//Construction turbine 2 :
			$dataTurbine = $this->Optimisation_model->getDataTurbine($i,2);
			$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(2);
			$turbine2 = new Turbine(2, 160, true, $coeffTurbine, $elevAmont, $elevAval);
			echo('Pour la turbine 2, débit réellement utilisé : '.$dataTurbine['q2'].' m3/s'.'<br>');

			//Construction turbine 3 :
			$dataTurbine = $this->Optimisation_model->getDataTurbine($i,3);
			$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(3);
			$turbine3 = new Turbine(3, 160, true, $coeffTurbine, $elevAmont, $elevAval);
			echo('Pour la turbine 3, débit réellement utilisé : '.$dataTurbine['q3'].' m3/s'.'<br>');

			//Construction turbine 4 :
			$dataTurbine = $this->Optimisation_model->getDataTurbine($i,4);
			$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(4);
			$turbine4 = new Turbine(4, 160, true, $coeffTurbine, $elevAmont, $elevAval);
			echo('Pour la turbine 4, débit réellement utilisé : '.$dataTurbine['q4'].' m3/s'.'<br>');

			//Construction turbine 5 :
			$dataTurbine = $this->Optimisation_model->getDataTurbine($i,5);
			$coeffTurbine = $this->Optimisation_model->getCoeffTurbine(5);
			$turbine5 = new Turbine(5, 160, true, $coeffTurbine, $elevAmont, $elevAval);
			echo('Pour la turbine 5, débit réellement utilisé : '.$dataTurbine['q5'].' m3/s'.'<br>');

			$dp = new DynamicProgram($turbine1, $turbine2, $turbine3, $turbine4, $turbine5, $qTotal);

			$dp->backward();
			$qLeft = $dp->forward();
			echo('Débit restant à turbiner : '.$qLeft.' à 5m3/s près.<br><br>');

			// Sample data. This can be fetched from mysql too
			$row = array($turbine1->getOptimalQ(), $turbine1->getOptimalProduction(),
									 $turbine2->getOptimalQ(), $turbine2->getOptimalProduction(),
									 $turbine3->getOptimalQ(), $turbine3->getOptimalProduction(),
									 $turbine4->getOptimalQ(), $turbine4->getOptimalProduction(),
									 $turbine5->getOptimalQ(), $turbine5->getOptimalProduction(),
								 	 $qTotal);
			// save each row of the data
			fputcsv($file, $row);
			}
			// Close the file
			fclose($file);*/
		}
}
