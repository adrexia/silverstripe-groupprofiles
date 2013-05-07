<?php
/*
 * ProfileGroup stores arbitrary groups for the classification of profiles
 */

class ProfileGroup extends DataObject{
	private static $db = array(
		'Name'=>'Varchar(255)'
	);

	private static $has_many = array(
		'Profiles'=>'Profile'
	);

	//Search Fields
	private static $searchable_fields = array(
		'Name'
	);

	private static $summary_fields = array(
		'Name' => 'Name'
	);

	//Permissions
	public function canView($member = null) {
		return Permission::check('GROUP_PROFILES_VIEW');
	}
	public function canEdit($member = null) {
		return Permission::check('GROUP_PROFILES_EDIT');
	}
	public function canDelete($member = null) {
		return Permission::check('GROUP_PROFILES_DELETE');
	}
	public function canCreate($member = null) {
		return Permission::check('GROUP_PROFILES_CREATE');
	}

}