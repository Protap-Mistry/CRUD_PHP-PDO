<?php
	include 'db.php';

	abstract class Main{

		protected $table;

		abstract public function insertInfo();
		abstract public function updateInfo($id);

		public function getInfo(){

			$query= "select * from $this->table";
			$result= databaseClass::ourPrepareMethod($query);
			$result->execute();

			return $result->fetchAll();
		}

		//for updating
		public function helpToUpdate($id){

			$query= "select * from $this->table where id=:id";
			$result= databaseClass::ourPrepareMethod($query);
			$result->bindParam(':id', $id);
			$result->execute();
			return $result->fetch();
		}

		//delete portion
		public function deleteInfo($id){

			$delete= "delete from $this->table where id=:id";
			$result= databaseClass::ourPrepareMethod($delete);

			$result->bindParam(':id', $id);
			return $result->execute();
		}
	}

?>