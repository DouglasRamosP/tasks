<?php

namespace App\Models;

use UNIS\Db\Table;

class Task extends Table
{
	protected $table = "tasks";

	public function fetchAll($notFinished = false)
	{
		//busca todas as tarefas do banco
		$query = "SELECT * FROM {$this->table}";

		if ($notFinished === true) {
			$query .= " WHERE finished <> 1";
		}

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function changeFinish($id)
	{	
		$task = parent::find($id);
		$task['finished'] = $this->isFinished($task['finished']) ? 0 : 1;
		array_push($task, 'statusChanged');

		parent::update($task, $id);
	}

	private function isFinished($taskStatus)
	{
		if ($taskStatus == 1) {
			return true;
		}

		return false;
	}

}