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
		//busca uma tarefa especifica pelo ID
	}

	public function update(array $data, int $id)
	{
		//atualiza uma tarefa no banco de dados
	}

	public function delete(int $id)
	{
		//apaga uma tarefa no banco de dados
		$columns = array_keys(self::prepareDelete($data));
		$values = array_values(self::prepareDelete($data));
	
		$query = "DELETE INTO {$this->table} (";
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

	private function prepareInsert(array $data)
	{
		array_pop($data);

		array_walk($data, function(&$value) {
			$value = $this->db->quote($value);
			
		});
		
		return $data;


	}

	private function prepareDelete(array $data)
	{
		array_splice($data);

        array_walk($data, function(&$value) {
			$value = $this->db->quote($value);
		});
		
		return $data;
	}

}