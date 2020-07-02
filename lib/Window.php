<?php
class Window {
	private $amount;
	public function __construct($data){
		$this->amount = trim($data['amount']);
	}
	public function getValidation(){
		if(!preg_match('/^[0-9]{1,100}$/iu', $this->amount)) return 'Должно состоять из чисел не больше 100';
		return false;
	}
	public function addWindows($db){
		$this->amount = (int)$this->amount;
		$check = $db->query('SELECT * FROM windows');
		if($check){
			$windows = $check->num_rows;
			$rows = $windows>0;
			if($rows){
				if($this->amount===0 || $windows===$this->amount){
					return 0;
				}elseif($windows>$this->amount){

					for($i = $windows; $i>$this->amount; $i--){
						$res = $db->query("DELETE FROM windows WHERE name='Окно $i'");
						if(!$res){
							return $db->error;
							break;
						}
					}
					$incr = $this->amount++;
					$db->query("ALTER TABLE windows auto_increment = $incr");
					return 1;
				}else{
					for($i=$windows+1;$i<=$this->amount;$i++){
					$res = $db->query("INSERT INTO windows (id, name, employee) VALUES (NULL, 'Окно $i', NULL)");
					if(!$res){
						return $db->error;
						break;
					}	
				}
			return 1;
			}

		}else{
			if(!$this->amount){
				return -1;
			}else{
				for($i=1;$i<=$this->amount;$i++){
					$res = $db->query("INSERT INTO windows (id, name, employee) VALUES (NULL, 'Окно $i', NULL)");
					if(!$res){
						return $db->error;
						break;
					}	
				}
				return 1;
			}
		}
	}else{
		return $db->error;
	}
}
}