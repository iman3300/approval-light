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
/**
 * Localized data
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */
Dict::Add('FR FR', 'French', 'Français', array(
	// Dictionary entries go here
	'Menu:Ongoing approval' => 'Requêtes en attente d\'approbation',
	'Menu:Ongoing approval+' => 'Requêtes en attente d\'approbation',
	'Approbation:PublicObjectDetails' => '<p>Cher $approver->html(friendlyname)$, merci de prendre le temps d\'approuver le ticket $object->html(ref)$</p>
				      <b>Demandeur</b>&nbsp;: $object->html(caller_id_friendlyname)$<br>
				      <b>Titre</b>&nbsp;: $object->html(title)$<br>
				      <b>Service</b>&nbsp;: $object->html(service_name)$<br>
				      <b>Sous catégorie de service</b>&nbsp;: $object->html(servicesubcategory_name)$<br>
				      <b>Description</b>&nbsp;:<br>
				      $object->html(description)$',
	'Approbation:FormBody' => '<p>Cher $approver->html(friendlyname)$, merci de prendre le temps d\'approuver le ticket</p>',
	'Approbation:ApprovalRequested' => 'Votre approbation est attendue',
	'Approbation:Introduction' => '<p>Cher $approver->html(friendlyname)$, merci de prendre le temps d\'approuver le ticket $object->html(friendlyname)$</p>',
));
//
// Class: UserRequestApprovalScheme
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:UserRequestApprovalScheme' => 'Schéma d\'approbation pour demande utilisateur',
	'Class:UserRequestApprovalScheme+' => '',
));

//
// Class: UserRequest
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:UserRequest/Stimulus:ev_approve' => 'Approuver',
	'Class:UserRequest/Stimulus:ev_approve+' => '',
	'Class:UserRequest/Stimulus:ev_reject' => 'Rejeter',
	'Class:UserRequest/Stimulus:ev_reject+' => '',
));
