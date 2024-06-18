<?php
/**
 * Localized data
 *
 * @copyright Copyright (C) 2010-2018 Combodo SARL
 * @license	http://opensource.org/licenses/AGPL-3.0
 *
 * This file is part of iTop.
 *
 * iTop is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * iTop is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with iTop. If not, see <http://www.gnu.org/licenses/>
 */
Dict::Add('NL NL', 'Dutch', 'Nederlands', array(
	// Dictionary entries go here
	'Menu:Ongoing approval' => 'Requests waiting for approval~~',
	'Menu:Ongoing approval+' => 'Requests waiting for approval~~',
	'Approbation:PublicObjectDetails' => '<p>Dear $approver->html(friendlyname)$, please take some time to approve or reject ticket $object->html(ref)$</p>
				      <b>Caller</b>: $object->html(caller_id_friendlyname)$<br>
				      <b>Title</b>: $object->html(title)$<br>
				      <b>Service</b>: $object->html(service_name)$<br>
				      <b>Service subcategory</b>: $object->html(servicesubcategory_name)$<br>
				      <b>Description</b>:<br>				     
				      $object->html(description)$~~',
	'Approbation:FormBody' => '<p>Dear $approver->html(friendlyname)$, please take some time to approve or reject the ticket</p>~~',
	'Approbation:ApprovalRequested' => 'Your approval is requested~~',
	'Approbation:Introduction' => '<p>Dear $approver->html(friendlyname)$, please take some time to approve or reject ticket $object->html(friendlyname)$</p>~~',
));
//
// Class: UserRequestApprovalScheme
//

Dict::Add('NL NL', 'Dutch', 'Nederlands', array(
	'Class:UserRequestApprovalScheme' => 'UserRequestApprovalScheme~~',
	'Class:UserRequestApprovalScheme+' => '~~',
));

//
// Class: UserRequest
//

Dict::Add('NL NL', 'Dutch', 'Nederlands', array(
	'Class:UserRequest/Stimulus:ev_approve' => 'Approve~~',
	'Class:UserRequest/Stimulus:ev_approve+' => '~~',
	'Class:UserRequest/Stimulus:ev_reject' => 'Reject~~',
	'Class:UserRequest/Stimulus:ev_reject+' => '~~',
));
