<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		$array['data'] = [];
		return view('welcome_internship',$array);
	}

	public function simulasi()
	{
		$bulan = $this->request->getPost('bulan');
		$deposit_awal = $this->request->getPost('deposit_awal');
		$simulasi_profit = $this->request->getPost('simulasi_profit');
		$simulasi_sharing_profit = $this->request->getPost('simulasi_sharing_profit');
		$adding_saldo = $this->request->getPost('adding_saldo') ?? 0;
		$kurs_dollar = $this->request->getPost('kurs_dollar');

		$profit['simulasi_profit'] = $simulasi_profit;
		$profit['simulasi_sharing_profit'] = $simulasi_sharing_profit;

		$depo = 0;
		
		for ($i=0; $i < $bulan; $i++) { 

			if ($depo == 0) {
				$depo = $deposit_awal;	
			}

			$simulasi[$i]['deposit_awal'] = $this->limit_decimal($depo);
			$simulasi[$i]['simulasi_profit'] = $this->limit_decimal($depo * $simulasi_profit/100);
			$simulasi[$i]['simulasi_sharing_profit'] = $this->limit_decimal(($depo * $simulasi_profit/100) - (($depo * $simulasi_profit/100)*$simulasi_sharing_profit/100));
			$simulasi[$i]['adding_saldo'] = $this->limit_decimal($adding_saldo);
			$simulasi[$i]['kurs_dollar'] = $this->limit_decimal($kurs_dollar);
			$simulasi[$i]['saldo'] = $this->limit_decimal($depo + $simulasi[$i]['simulasi_sharing_profit']);
			$simulasi[$i]['saldo_in_rupiah'] = $simulasi[$i]['saldo'] * $kurs_dollar;

			$depo = $simulasi[$i]['saldo'] + $adding_saldo;
		}

		$array['data'] = $simulasi;
		$array['input'] = $profit;

		return view('welcome_internship', $array);
	}

	public function limit_decimal($number)
	{
		return number_format((float)$number, 2,'.','');
	}

	public function addProduct()
	{
		return view('welcome_message');
	}
}
