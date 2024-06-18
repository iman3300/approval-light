<?php
// Copyright (C) 2012 Combodo SARL
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU General Public License as published by
//   the Free Software Foundation; version 3 of the License.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of the GNU General Public License
//   along with this program; if not, write to the Free Software
//   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'combodo-approval-light/1.2.3',
	array(
		// Identification
		//
		'label' => 'Approval light (on user requests)',
		'category' => 'feature',

		// Setup
		//
		'dependencies' => array(
			'approval-base/2.5.0',
			'itop-request-mgmt/2.0.0||itop-request-mgmt-itil/2.0.0', // To alter the definition of UserRequest
		),
		'mandatory' => false,
		'visible' => true,
		'installer' => 'ApprovalLightInstaller',

		// Components
		//
		'datamodel' => array(
			'model.combodo-approval-light.php',
			'main.combodo-approval-light.php'
		),
		'webservice' => array(

		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),

		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
			'approval_timeout_delay' => 5,
			'approve_on_timeout' => false,
			'approver_select' => 'SELECT Person AS p  WHERE id = :this->approver_id',
			'bypass_profiles' => 'Administrator, Service Manager'
		),
	)
);

if (!class_exists('ApprovalLightInstaller'))
{
	// Module installation handler
	//
	class ApprovalLightInstaller extends ModuleInstallerAPI
	{
		public static function BeforeWritingConfig(Config $oConfiguration)
		{
			// If you want to override/force some configuration values, do it here
			return $oConfiguration;
		}

		/**
		 * Handler called before creating or upgrading the database schema
		 * @param $oConfiguration Config The new configuration of the application
		 * @param $sPreviousVersion string PRevious version number of the module (empty string in case of first install)
		 * @param $sCurrentVersion string Current version number of the module
		 */
		public static function BeforeDatabaseCreation(Config $oConfiguration, $sPreviousVersion, $sCurrentVersion)
		{
		}

		/**
		 * Handler called after the creation/update of the database schema
		 * @param $oConfiguration Config The new configuration of the application
		 * @param $sPreviousVersion string PRevious version number of the module (empty string in case of first install)
		 * @param $sCurrentVersion string Current version number of the module
		 */
		public static function AfterDatabaseCreation(Config $oConfiguration, $sPreviousVersion, $sCurrentVersion)
		{
			// Upgrading from a version older than 1.1 : create the sample data
			if (version_compare($sPreviousVersion, '1.1.0', '<'))
			{
				SetupLog::Info("Upgrading combodo-approval-light from '$sPreviousVersion' to '$sCurrentVersion'. Starting with 1.1.0, the extension requires a set of trigger/actions that will created into the DB...");

				$oTrigger = MetaModel::NewObject('TriggerOnApprovalRequest');
				$oTrigger->Set('description', 'Approval requested');
				$oTrigger->Set('target_class', 'UserRequest');
				$oTrigger->DBInsert();

				$oAction = MetaModel::NewObject('ActionEmailApprovalRequest');
				$oAction->Set('name', 'Approval request (EN)');
				$oAction->Set('description', 'Sample message, automatically created when upgrading');
				$oAction->Set('status', 'enabled');
				$oAction->Set('from', ActionEmailApprovalRequest::GetDefaultEmailSender());
				$oAction->Set('subject', 'Your approval is requested: $this->ref$');
				$oAction->Set('subject_reminder', 'Your approval is requested: $this->ref$ (reminder)');
				$oAction->Set('body', '<h3>Your approval is requested: $this->html(ref)$</h3>
					<p>Dear $approver->html(friendlyname)$, please take some time to approve or reject ticket $this->html(ref)$</p>
					<b>Caller</b>: $this->html(caller_id_friendlyname)$<br>
					<b>Title</b>: $this->html(title)$<br>
					<b>Service</b>: $this->html(service_name)$<br>
					<b>Service subcategory</b>: $this->html(servicesubcategory_name)$<br>
					<b>Description</b>:<br>
					<div>$this->html(description$)</div>
					<p>$approval_link$</p>'
				);
				$oAction->DBInsert();

				$oAction = MetaModel::NewObject('ActionEmailApprovalRequest');
				$oAction->Set('name', 'Approval request (FR)');
				$oAction->Set('description', 'Sample message, automatically created when upgrading');
				$oAction->Set('status', 'enabled');
				$oAction->Set('from', ActionEmailApprovalRequest::GetDefaultEmailSender());
				$oAction->Set('subject', 'Votre approbation est attendue : $this->ref$');
				$oAction->Set('subject_reminder', 'Votre approbation est attendue : $this->ref$ (relance)');
				$oAction->Set('body', '<h3>Votre approbation est attendue : $this->html(ref)$</h3>
					<p>Cher $approver->html(friendlyname)$, merci de prendre le temps d\'approuver le ticket $this->html(ref)$</p>
					<b>Demandeur</b>&nbsp;: $this->html(caller_id_friendlyname)$<br>
					<b>Titre</b>&nbsp;: $this->html(title)$<br>
					<b>Service</b>&nbsp;: $this->html(service_name)$<br>
					<b>Sous catégorie de service</b>&nbsp;: $this->html(servicesubcategory_name)$<br>
					<b>Description</b>&nbsp;:<br>
					<div>$this->html(description)$</div>
					<p>$approval_link$</p>
				');
				$oAction->DBInsert();

				$oAction = MetaModel::NewObject('ActionEmailApprovalRequest');
				$oAction->Set('name', 'Approval request (DE)');
				$oAction->Set('description', 'Sample message, automatically created when upgrading');
				$oAction->Set('status', 'enabled');
				$oAction->Set('from', ActionEmailApprovalRequest::GetDefaultEmailSender());
				$oAction->Set('subject', 'Ihre Freigabeanfrage wurde erstellt $this->ref$');
				$oAction->Set('subject_reminder', 'Ihre Freigabeanfrage wurde erstellt $this->ref$ (Erinnerung)');
				$oAction->Set('body', '<h3>Ihre Freigabeanfrage wurde erstellt $this->ref$</h3>
					<p>Sehr geehrte/r $approver->html(friendlyname)$, bitte nehmen sie sich etwas Zeit, um Ticket $this->html(ref)$ zu bearbeiten</p>
					<h3>Titel : $this->html(title)$</h3>
					<p>Beschreibung:</p>
					$this->html(description)$
					<p>Ersteller: $this->html(caller_id_friendlyname)$</p>
					<p>Service: $this->html(service_name)$</p>
					<p>Servicekategorie: $this->html(servicesubcategory_name)$</p>
					<p>$approval_link$</p>
				');
				$oAction->DBInsert();

				SetupLog::Info("... sample trigger/actions successfully created.");
			}
		}
	}
}
