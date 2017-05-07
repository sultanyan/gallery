<?php 
	class Paginate{
		public $current_page,
			   $items_per_page,
			   $items_total_count;

		#SHITS DO NOT WORK WITHOUT THIS CRAP
		public function __construct($page=1, $items_per_page=5, $items_total_count=0){
			$this->current_page = (int)$page;
			$this->items_per_page = (int)$items_per_page;
			$this->items_total_count = (int)$items_total_count;
		}

		#NEXT PAGE
		public function next(){
			return $this->current_page+1;
		}

		#PERV PAGE
		public function previous(){
			return $this->current_page-1;
		}

		#TOTAL ON ONE
		public function page_total(){
			return ceil($this->items_total_count/$this->items_per_page);
		}

		#IF ONE SHITTY PAGE HAS A FUCKING WAY TO GO BACK
		public function has_previous(){
			return $this->previous()>=1 ? true : false ;
		}

		#IF ONE SHITTY PAGE HAS A FUCKING WAY TO GO UPWARDS
		public function has_next(){
			return $this->next()<=$this->page_total() ? true : false ;
		}

		#SHITTY FUNCTION FOR SHITHOLING
		public function offset(){
			return ($this->current_page-1)*$this->items_per_page;
		}

	}
?>