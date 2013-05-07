<?php
/*
 * Profile stores
 */

class Profile extends DataObject{
	
	private static $db = array(
		'Name'=>'Varchar(255)',
		'Designation'=>'Varchar(255)',
		'Bio'=>'HTMLText'
	);

	private static $has_one = array(
		'Image'=>'Image',
		'Group'=>'ProfileGroup'
	);

	private static $searchable_fields = array(
		'Name',
		'Designation',
		'Bio',
		'Group.Name'
	);

	private static $summary_fields = array(
		'ProfileImageThumb' => 'Image',
		'Name' => 'Name',
		'Designation' => 'Designation',
		'ShortBio' => 'Bio',
		'Group.Name' => 'Group'
	);

	/*
	 * @return String
	 */
	public function GroupName(){
		if(isset($this->GroupID)){
			return ProfileGroup::get()->byID($this->GroupID)->Name;
		}else{
			return "No group";
		}
	}

	/*
	 * @return String
	 */
	public function ShortBio(){
		//return substr($this->Bio, 0, 500);
		return $this->obj('Bio')->Summary();
	}

	/*
	 * @return Image
	 */
	public function ProfileImageThumb(){ 
		return $this->Image()->SetWidth(100); 
	}

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