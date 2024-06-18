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
Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	// Dictionary entries go here
	'Menu:Ongoing approval' => 'Requerimientos esperando Aprobación',
	'Menu:Ongoing approval+' => 'Requerimientos esperando Aprobación',
	'Approbation:PublicObjectDetails' => '<p>Estimado(a) $approver->html(friendlyname)$, por favor tome un tiempo para aprobar o rechazar el ticket $object->html(ref)$</p>
				      <b>Solicitante</b>: $object->html(caller_id_friendlyname)$<br>
				      <b>Asunto</b>: $object->html(title)$<br>
				      <b>Servicio</b>: $object->html(service_name)$<br>
				      <b>Subcategoria de Servicio</b>: $object->html(servicesubcategory_name)$<br>
				      <b>Descripción</b>:<br>			     
				      $object->html(description)$<br>
				      <b>Información Adicional</b>:<br>
				      <div>$object->html(service_details)$</div>',
	'Approbation:FormBody' => '<p>Estimado(a) $approver->html(friendlyname)$, por favor tome un tiempo para aprobar o rechazar el ticket</p>',
	'Approbation:ApprovalRequested' => 'Su aprobación es requerida',
	'Approbation:Introduction' => '<p>Estimado(a) $approver->html(friendlyname)$, por favor tome un tiempo para aprobar o rechazar el ticket $object->html(friendlyname)$</p>',
));
//
// Class: UserRequestApprovalScheme
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:UserRequestApprovalScheme' => 'UserRequestApprovalScheme~~',
	'Class:UserRequestApprovalScheme+' => '~~',
));

//
// Class: UserRequest
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:UserRequest/Stimulus:ev_approve' => 'Approve~~',
	'Class:UserRequest/Stimulus:ev_approve+' => '~~',
	'Class:UserRequest/Stimulus:ev_reject' => 'Reject~~',
	'Class:UserRequest/Stimulus:ev_reject+' => '~~',
));
