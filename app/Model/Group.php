<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 */
class Group extends AppModel {
	
	public function getUsersInGroup($gid=false) {
		if ( $gid == false ) {
				return array();
		}

		return $this->query('
				SELECT
						users.username
				FROM
						groups_users
				LEFT JOIN
						groups ON (groups.id = groups_users.group_id)
				LEFT JOIN
						users ON (users.id = groups_users.user_id)
				WHERE
						groups.id = '.(int) $gid.'
		');
	}
}
