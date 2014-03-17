<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller {

	public function action_index()
	{
		$view = View::factory('index');
		$this->response->body($view);
		//$this->response->body('<h1>User api</h1><a href="persons">List all users</a><br><a href="add">Add user</a>');
	}
	public function action_persons() {
		$user = User::get($this->request->param('id'));
		$view = View::factory('json')->set('data', $user);
		if (!is_array($user)) {
			header("HTTP/1.0 404 Not Found");
		}
		$this->response->body($view);
	}
	public function action_add() {
		if(empty($_POST)) {
			$view = View::factory('add');
			$this->response->body($view);
		} else {
			$result = User::set($_POST);
			if ($result) {
				echo 'A new user was created successfully';
			} else {
				header('HTTP/1.1 400 BAD REQUEST');
				echo 'No new user was created';				
			}
		}
	}

} // End Welcome