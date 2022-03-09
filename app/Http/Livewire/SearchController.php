<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchController extends Component
{
	public $search;

	public function render()
	{
		return view('livewire.search');
	}


	
	public function searchBarcode($barcode)
	{		
		
		//$this->emit('scan-code', $barcode);
		
	}
}


//9786074156713