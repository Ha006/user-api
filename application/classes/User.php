<?php
class User extends Model_Database {
	public static function get($id = null)
	{
		if (empty($id)) {
			$users = DB::select()->from('user')->execute()->as_array();
		} else {
			$users = DB::select()->from('user')->where('user.id', '=', $id)->execute()->as_array();
		}
		if (empty($users)) {
			$users = 'Ingen användere, fel';
		}
		return $users;
	}
	
	public static function set($new)
	{
		$table = 'user';
		$columns = DB::query(Database::SELECT, 'SHOW FULL COLUMNS FROM ' . $table)->execute()->as_array();
		unset($columns[0]);
		foreach($columns as $column) {
			$column = $column['Field'];
			if ($column == 'password') $new[$column] = hash('sha512', $new[$column]);
			if (!empty($new[$column])) $data[$column] = $new[$column];
			else return false;
		}
		
		return DB::insert($table, array_keys($data))->values($data)->execute();
	}
}
?>
