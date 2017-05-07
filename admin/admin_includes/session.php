<?php 
	class Session{
		private $signed_in=false;
		public $user_id;
		public $count;

		#FIRST LOVE~~~~~~~~~
		function __construct(){
			session_start();
			$this->check_the_login();
			$this->visitor_count();
		}

		#SHIT TO COUNT FUCKING VISITORS
		public function visitor_count(){
			if (isset($_SESSION['count'])) {
				return $this->count = $_SESSION['count']++;
			}else {
				return $_SESSION['count']=1;
			}
		}

		#GETTER FOR CHECHING OF SIGNED IN
		public function is_signed_in(){
			return $this->signed_in;
		}

		#WHAT IF I TOLD YOU THIS METHOD IS FOR MAKING COFFEE...
		public function login($user){
			if ($user) {
				$this->user_id=$_SESSION['user_id']=$user->id;
				$this->signed_in=true;		
			}	
		}

		#AND THIS ONE, YOU KNOW, BRINGS HOT HORNEY CHICKS TO MY ROOM, AND THEY SAY,
		#OOOOOH MHEEEER YOU NOW PHP OOOOOH COME AND TAKE ME
		#END OF FUNNY COMMENTS :D 
		public function logout(){
			unset($_SESSION['user_id']);
			unset($this->user_id);
			$this->signed_in = false;
		}

		#CHECK IF USER LOGGED IN, IF true, ASSIGN THE SESSION, else
		#unset IT AND MAKE SINGED IN FALSE
		private function check_the_login(){
			if (isset($_SESSION['user_id'])) {
				$this->user_id = $_SESSION['user_id'];
				$this->signed_in = true;
			}else {
				unset($this->user_id);
				$this->signed_in = false;
			}
		}

	} #CLASS SESSION ENDED.

	$session = new Session();
?>