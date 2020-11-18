<?php

namespace App\Models;

class TaskFormat
{
    public static function taskListFormat(array &$tasklist)
    {
        foreach($tasklist as &$task) {
            //altero cada uma das colunas
            self::dateFormat($task['due']);
            self::finishedFormat($task['finished']);
        }
    }

    public static function dateFormat(&$date)
    {
        //$tempDate = $date;
        //$arrayDate = explode("-", $tempDate);
        //$date = $arrayDate[2] . '/' . $arrayDate[1] . '/' . $arrayDate[0];
        //opção 1

        $dateTime = new \DateTime($date);

        self::dateEmpty($date);
        
        if (!empty($date)){
            $date = $dateTime->format('d/m/Y');
        }
         //opção 2
    }

    public static function priorityFormat(&$priority)
	{
		switch ($priority) {
			case 'low':
				$priority = '1';
				break;
			case 'medium':
				$priority = '2';
				break;
			case 'high':
				$priority = '3';
				break;
		}
	}

	public static function finishedFormat(&$finished)
	{
		if($finished == 1) {
			$finished = 'Sim';
		} else {
			$finished = 'Não';
		}
	}

    private static function dateEmpty(&$date)
    {
        if ($date == '0000-00-00') {
            $date = '';
        }
    }


}