<?php
	include 'main.php';

	class Teacher extends Main{

		protected $table= "teachers";

		private $name;
		private $dept;
		private $age;

		public function setName($n){

			$this->name= $n;
		}
		public function setDept($d){

			$this->dept= $d;
		}
		public function setAge($a){

			$this->age= $a;
		}

		public function insertInfo(){

			$insert= "insert into $this->table(name, dept, age) values(:name, :dept, :age)";
			$result= databaseClass::ourPrepareMethod($insert);
			$result->bindParam(':name', $this->name);
			$result->bindParam(':dept', $this->dept);
			$result->bindParam(':age', $this->age);

			return $result->execute();
		}	

		//for updating
		public function updateInfo($id){

			$update= "update $this->table set name=:name, dept=:dept, age=:age where id=:id";
			$result= databaseClass::ourPrepareMethod($update);

			$result->bindParam(':name',$this->name);
			$result->bindParam(':dept',$this->dept);
			$result->bindParam(':age',$this->age);
			$result->bindParam(':id',$id);

			return $result->execute();
		}
	}

?>