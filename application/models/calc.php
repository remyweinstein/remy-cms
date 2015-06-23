<?php

class Calc {
	public $content = '';
	public $title;
	public $id;
	
	private $shirina = 0.8;
	
	private $price_ldsp_2750_1830 = 1900;
	private $price_dvpo_2745_1700 = 500;
	private $price_kromka = 11;
	private $price_petlya = 20;
	private $price_nozhka = 20;
	private $price_ruchka = 100;
	private $price_evrovint = 3;
	private $price_samorez = 20;
	private $price_raspil_dvpo = 300;
	private $price_raspil_ldsp = 700;
		
	private $use_ldsp_2750_1830 = 0.9;
	private $use_dvpo_2745_1700 = 0.8;
	
	public $niz_pod_moiku;
	public $niz_odna_polka;
	public $niz_dve_polki;
	public $verh_odna_polka;
	public $verh_dve_polki;
	
	public $total_izdeliya;
	
	
	
	
	public function __construct() {
	
		$url_page = Engine::$curUrlName;
	
		$result['template'] = Engine::$curTemplate;
		$result['title'] = 'Калькулятор';
		$result['id'] = 0;
		/*
		Raschet_Skafa(евровинт, ручки, петли, ножки, ширина, высота, глубина, полки, задник(0,1), тип фасада, низ-верх(0,1), название изделия)
		
		
		*/
		
		$material = 'uv_china_1';
		
		$this->niz_pod_moiku = $this->Raschet_Skafa(10, 2, 4, 4, 0.8, 0.72, 0.56, 0, 0, $material, 0, 'Низ под мойку');
		$this->niz_dve_polki = $this->Raschet_Skafa(18, 2, 4, 4, 0.9, 0.72, 0.56, 2, 1, $material, 0, 'Низ две полки');
		$this->niz_dve_polki2 = $this->Raschet_Skafa(18, 2, 4, 4, 0.6, 1, 0.35, 2, 1, $material, 0, 'Пенал');
		$this->niz_dve_polki3 = $this->Raschet_Skafa(18, 2, 4, 4, 0.35, 0.72, 0.35, 2, 1, $material, 0, 'Низ две полки');
		$this->verh_odna_polka = $this->Raschet_Skafa(14, 2, 4, 4, 1.5, 0.36, 0.3, 1, 1, $material, 1, 'Верх одна полка');
		$this->verh_odna_polka2 = $this->Raschet_Skafa(14, 2, 4, 4, 0.6, 0.5, 0.3, 1, 1, $material, 1, 'Верх одна полка');
		
		$this->total_izdeliya[] = $this->niz_pod_moiku; 
		$this->total_izdeliya[] = $this->niz_dve_polki;
		$this->total_izdeliya[] = $this->niz_dve_polki2;
		$this->total_izdeliya[] = $this->niz_dve_polki3;
		$this->total_izdeliya[] = $this->verh_odna_polka;
		$this->total_izdeliya[] = $this->verh_odna_polka2;
				
		$result['content'] = $this->niz_odna_polka;
		
		
		
		if(!$result) {
			$result['template'] = 'none';
			$result['content'] = file_get_contents(PAGE_DIR.Engine::$settings['error_page'].'.php');
		}
	
		$this->content = $result['content'];
		$this->title = $result['title'];
		Engine::$curIdPage = $result['id'];
		Engine::$curTemplate = $result['template']=="" ? Engine::$curTemplate : $result['template'];
	
	}
	
	private function Raschet_Skafa($kolvo_vint, $kolvo_ruchki, $kolvo_petli, $kolvo_nozhka, $shirina, $visota, $glubina, $polki, $zadnik, $fasad, $verh, $name) {
		
		$resultat['name'] = $name;
		$resultat['volume_dsp'] = (1 + $verh + $polki)*$shirina*$glubina + 2*$glubina*$visota + (1-$verh)*2*0.06*$shirina;
		$resultat['dlina_kromki'] = 1.05*(2*(2*$glubina + 2*$visota + $shirina*(3 - 2*$verh + $polki)));		
		$resultat['volume_dvpo'] = $visota*$shirina*$zadnik;
		$resultat['fasad'] = $fasad;
		$resultat['volume_fasad'] = $shirina*$visota;
		$resultat['price_fasad'] = $this->RachetFasada($fasad, $resultat['volume_fasad']);
		if($verh == 0) $resultat['dlina'] = $shirina;
			else $resultat['dlina'] = 0;
		
		
		$resultat['total_price'] = round($kolvo_vint*$this->price_evrovint + 
				$kolvo_ruchki*$this->price_ruchka + 
				$kolvo_petli*$this->price_petlya + 
				$kolvo_nozhka*$this->price_nozhka + 
				$this->price_samorez + 
				$resultat['volume_dsp']*$this->Metr_material('ldsp_2750_1830') + 
				$resultat['volume_dvpo']*$this->Metr_material('dvpo_2745_1700') + 
				$this->price_kromka*$resultat['dlina_kromki'] + 
				$resultat['price_fasad'] + 
				0.5);
		
		return $resultat;
	}
	
	private function RachetFasada($fasad=0, $square=0) {
		switch($fasad) {
			case 'pvc_1':
				$result = round($square*2900 + 0.5);
			break;
			case 'ldsp_1':
				$result = round($square*1200 + 0.5);
			break;
			case 'uv_china_1':
				$result = round($square*1860 + 0.5);
			break;
			default:
				$result = 0;
			break;
		}
		
		return $result;
	}
	
	private function Metr_material($material) {
		switch ($material) {
			case 'ldsp_2750_1830':
				$dlina = 2.75;
				$shirina = 1.83;
				$use_procent = $this->use_ldsp_2750_1830;
				$raspil = $this->price_raspil_ldsp;
				$price = $this->price_ldsp_2750_1830;
			break;
			case 'dvpo_2745_1700':
				$dlina = 2.745;
				$shirina = 1.7;
				$use_procent = $this->use_dvpo_2745_1700;
				$raspil = $this->price_raspil_dvpo;
				$price = $this->price_dvpo_2745_1700;
			break;
			default:
				$dlina = 2.75;
				$shirina = 1.83;
				$use_procent = $this->use_ldsp_2750_1830;
				$raspil = $this->price_raspil_ldsp;
				$price = $this->price_ldsp_2750_1830;
			break;
		}
		
		
		return ($price + $raspil)/($dlina*$shirina*$use_procent);
	}
	
	
	
	
	
	
}

?>