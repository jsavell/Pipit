<?php
namespace Core\Interfaces;
/** 
*	An interface defining a Site
*	Sites provide a single, unified application context throughout the execution of the application, providing state information to components, and allowing them to alter the flow of the application without
*	direct knowledge of the inner workings of the other components.
*
*	@author Jason Savell <jsavell@library.tamu.edu>
*/

interface Site {
	/**
	*	Set the ViewRenderer.
	*
	*	@param ViewRenderer $viewRenderer
	*	@return void
	*/
	public function setViewRenderer($viewRenderer);

	/**
	*	Get the ViewRenderer. Components like Controllers can access this method to configure the set ViewRenderer.
	*
	*	@return ViewRenderer The currently set ViewRenderer
	*/
	public function getViewRenderer();

	/**
	*	Get the pages defined for the Site. 
	*
	*	@return SitePage[] 
	*/
	public function getPages();

	/**
	*	Set the pages for the Site.
	*
	*	@param SitePage[] $pages An array of SitePage
	*	@return void
	*/
	public function setPages($pages);

	/**
	*	Get a representation of the application user associated with a request. 
	*
	*	@return mixed 
	*/
	public function getGlobalUser();

	/**
	*	Get the Controller class associated with the given name
	*	
	*	@param string $controllerName
	*	@return string $controllerClass An instantiable string representation of the Controller class name
	*/
	public function getControllerClass($controllerName);

	/**
	*	Provide a sanitized and secured version of user input data (POST,GET,COOKIE,etc) to components
	*	All components should access user input data exclusively through this method.
	*
	*	@return mixed[] 
	*/
	public function getSanitizedInputData();

	/**
	*	Push to the Site's array of SystemMessages	
	*
	*	@param SystemMessage $systemMessage
	*	@return void
	*/
	public function addSystemMessage($systemMessage);

	/**
	*	Get the Site's SystemMessages	
	*
	*	@return SystemMessage[]
	*/
	public function getSystemMessages();
}
?>