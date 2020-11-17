<?php

namespace UNIS\Db;

abstract class Table
{
	protected $table;
	protected $db;

	public function __construct(\Pdo $db)
	{
		$this->db = $db;
	}	

	public function add(array $data)
	{
		$columns = array_keys(self::prepareInsert($data));
        $values = array_values(self::prepareInsert($data));
	
		$query = "INSERT INTO {$this->table} (";
		$query .= implode(', ', $columns);
		$query .= ') VALUES (';
		$query .= implode(', ', $values) . ')';
		
		$stmt = $this->db->prepare($query);

		try {
			return $stmt->execute();
		} catch (\PDOException $e) {
			return $e->getMessage();
		}
	}

	public function fetchAll()
	{
		//busca todas as tarefas do banco
		$query = "SELECT * FROM {$this->table}";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function find(int $id)
	{
		$query = "SELECT * FROM {$this->table} WHERE ID=:id";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function update(array $data, int $id)
	{
		//atualiza uma tarefa no banco de dados
		$set = self::prepareUpdate($data);
		$query = "UPDATE {$this->table} SET ";
		$query .= implode(", ", $set);
		$query .= " WHERE id=:id";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(":id", $id);

		try {
			$stmt->execute();
			return $stmt->rowCount();
		} catch (\PDOException $e) {
			return $e->getMessage();
		}
	}

	public function delete(int $id)
    {
		//apaga uma tarefa no banco
		$query = "DELETE FROM {$this->table} WHERE id=:id";

		$stmt = $this->db->prepare($query);
		$stmt->bindParam(":id", $id);
		
		try{
			$stmt->execute();
			return $stmt->rowCount();
		 } catch (\PDOException $e) {
			 echo $e->getMessage();
		 }
		
	}

	
	private function prepareInsert(array $data)
    {
        array_pop($data);

        array_walk($data, function(&$value) 
        {
            $value = $this->db->quote($value);
        });

        return $data;
    }

	private function prepareUpdate(array $data)
	{
		$updateSet = [];
		array_shift($data);
		array_pop($data);

		foreach($data as $key => $value) {
			array_push($updateSet, "{$key}=" . $this->db->quote($value));
		}

		return $updateSet;
	}

}