<?php
/*
 * GroupProfilesAdmin provides an interface for the creation and grouping of 
 * profiles into user defined groups 
 *
 */

class GroupProfilesAdmin extends ModelAdmin implements PermissionProvider {
	private static $managed_models = array('Profile','ProfileGroup');
	private static $url_segment = 'groupprofiles';
	private static $menu_title = 'Group Profiles';
	

	public function getEditForm($id = null, $fields = null){
		$form = parent::getEditForm($id, $fields);
		
		$gridField = $form->Fields()->fieldByName($this->sanitiseClassName($this->modelClass));
		$gridField->getConfig()->addComponents(
			new GridFieldAddExistingAutocompleter('buttons-before-left'),
			$filter = new GridFieldFilterHeader(),
			new GridFieldEditButton(),
			new GridFieldDeleteAction(true),
			new GridFieldDetailForm()
		);
		return $form;
	}

	public function providePermissions() {
		return array(
			'GROUP_PROFILES_VIEW' => array(
				'name' => 'View group profiles',
				'category' => 'Group profiles',
			),
			'GROUP_PROFILES_EDIT' => array(
				'name' => 'Edit a group profile',
				'category' => 'Group profiles',
			),
			'GROUP_PROFILES_DELETE' => array(
				'name' => 'Delete a group profile',
				'category' => 'Group profiles',
			),
			'GROUP_PROFILES_CREATE' => array(
				'name' => 'Create a group profile',
				'category' => 'Group profiles'
			)
		);
	}

}