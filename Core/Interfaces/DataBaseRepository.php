<?php
namespace Core\Interfaces;
/** 
*	An interface defining a DatabaseRepository
*	DatabaseRepositories are utilized to perform CRUD actions on Databases
*
*	@author Jason Savell <jsavell@library.tamu.edu>
*/

interface DatabaseRepository {
	/**
	*	Get all records from a table
	*
	*	@return mixed[] The found records
	*/
	public function get();

	/**
	* 	Get a single record by its unique ID from a table
	*	@param mixed $id The unique ID
	*	@return mixed The record matching the ID
	*/
	public function getById($id);

	/**
	* 	Remove a single record by its unique ID from a table
	*	@param mixed $id The unique ID
	*	@return boolean The success or failure of the update operation
	*/
	public function removeById($id);

	/**
	* 	Get a single record by its unique ID from a table
	*
	*	@param mixed $data The search criteria
	*	@return mixed[] The search results
	*	
	*/
	public function search($data);

	/**
	* 	Add a single record to a table
	*	@param mixed $data A representation of the record to be added
	*	@return mixed|false The unique ID of the record on success, false on failure
	*/
	public function add($data);

	/**
	* 	Update a single record in a table by its unique ID
	*	@param mixed $id The unique ID
	*	@param mixed $data The search criteria
	*	@return boolean Success or failure
	*/
	public function update($id,$data);
}
?>