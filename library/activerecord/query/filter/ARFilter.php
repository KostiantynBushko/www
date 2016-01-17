<?php

require_once("filter/Condition.php");

/**
 * Abstract ActiveRecord filter
 *
 * @package activerecord.query.filter
 * @author Integry Systems
 */
abstract class ARFilter
{
	/**
	 * WHERE condition container
	 *
	 * @var Condition
	 */
	protected $condition = null;

	/**
	 * A list of tables to JOIN
	 *
	 * @var array
	 */
	protected $joinList = array();

	public function __construct(Condition $condition = null)
	{
		if (!is_null($condition))
		{
			$this->setCondition($condition);
		}
	}

	/**
	 * Creates a textual filter representation
	 *
	 * This string might be used as a part of SQL query
	 *
	 */
	public function createString()
	{
		if ($this->condition != null)
		{
			return " WHERE " . $this->condition->createChain();
		}
		else
		{
			return "";
		}
	}

	public function createPreparedStatement()
	{
		if ($this->condition != null)
		{
			$sql = $this->condition->createPreparedChain();
			$sql['sql'] = ' WHERE ' . $sql['sql'];
			return $sql;
		}
		else
		{
			return array('sql' => '', 'values' => array());
		}
	}

	/**
	 * Adds a constraint which will be used in SQL query
	 *
	 * @param string $condition
	 */
	public function setCondition(Condition $condition = null)
	{
		if($condition)
		{
			$this->condition = $condition;
		}
	}

	/**
	 * Get filter condition
	 *
	 * @return Condition
	 */
	public function getCondition()
	{
		return $this->condition;
	}

	public function isConditionSet()
	{
		return ($this->condition instanceof Condition);
	}

	public function mergeCondition(Condition $cond)
	{
		if ($this->condition != null)
		{
			if (!($this->condition instanceof AndChainCondition))
			{
				$this->condition = new AndChainCondition(array($this->condition));
			}

			$this->condition->addAND($cond);
		}
		else
		{
			$this->condition = $cond;
		}
	}

	public function removeCondition(Condition $condition = null)
	{
		if ($condition)
		{
			if ($this->condition)
			{
				$this->condition->removeCondition($condition);
			}
		}
		else
		{
			$this->condition = null;
		}
	}

	/**
	 * Joins table by using supplied params
	 *
	 * @param string $tableName
	 * @param string $mainTableName
	 * @param string $tableJoinFieldName
	 * @param string $mainTableJoinFieldName
	 * @param string $tableAliasName	Necessary when joining the same table more than one time (LEFT JOIN tablename AS table_1)
	 */
	public function joinTable($tableName, $mainTableName, $tableJoinFieldName, $mainTableJoinFieldName, $tableAliasName = '')
	{

		$join = array("tableName" => $tableName,
					  "mainTableName" => $mainTableName,
					  "tableJoinFieldName" => $tableJoinFieldName,
					  "mainTableJoinFieldName" => $mainTableJoinFieldName,
					  "tableAliasName" => $tableAliasName
					  );

		if (!$tableAliasName)
		{
			$tableAliasName = $tableName;
		}

		$this->joinList[$tableAliasName] = $join;
	}

	public function getJoinList()
	{
	  	return $this->joinList;
	}

	public function __toString()
	{
		return $this->createString()."\n<br/>";
	}

	public function __clone()
	{
		if ($this->condition)
		{
			$this->condition = clone $this->condition;
		}
	}

	/*
	public function __destruct()
	{
		logDestruct($this);
	}
	*/
}

?>
