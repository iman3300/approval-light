<?php
/**
 * Copyright (C) 2013-2020 Combodo SARL
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
 */

/**
 * Class ApprovalWebPage
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */
if (version_compare(ITOP_DESIGN_LATEST_VERSION , '3.0') < 0) {
	require_once(APPROOT."/application/nicewebpage.class.inc.php");
}
require_once(APPROOT."/application/applicationcontext.class.inc.php");
require_once(APPROOT."/application/user.preferences.class.inc.php");
/**
 * Web page with some associated CSS and scripts (jquery) for a fancier display
 * of the Portal web page
 */
class ApprovalWebPage extends NiceWebPage
{
	/**
	 * Portal menu
	 */
	protected $m_aMenuButtons;

	/**
	 * @inheritDoc
	 * @throws \Exception
	 */
	public function __construct($sTitle, $sAlternateStyleSheet = '')
	{
		$this->m_aMenuButtons = array();
		parent::__construct($sTitle);
		$this->add_header("Content-type: text/html; charset=utf-8");
		$this->add_header("Cache-control: no-cache");
		$this->add_linked_stylesheet("../css/jquery.treeview.css");
		$this->add_linked_stylesheet("../css/jquery.autocomplete.css");
		if ($sAlternateStyleSheet != '')
		{
			$this->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot()."approval-base/$sAlternateStyleSheet/approve.css");
		}
		else
		{
			$this->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot()."approval-base/asset/css/approve.css");
		}
		$this->add_linked_script('../js/jquery.layout.min.js');
		$this->add_linked_script('../js/jquery.ba-bbq.min.js');
		$this->add_linked_script("../js/jquery.tablehover.js");
		$this->add_linked_script("../js/jquery.treeview.js");
		$this->add_linked_script("../js/jquery.autocomplete.js");
		$this->add_linked_script("../js/jquery.positionBy.js");
		$this->add_linked_script("../js/jquery.popupmenu.js");
		$this->add_linked_script("../js/date.js");
		$this->add_linked_script("../js/jquery.tablesorter.min.js");
		$this->add_linked_script("../js/jquery.blockUI.js");
		$this->add_linked_script("../js/utils.js");
		$this->add_linked_script("../js/forms-json-utils.js");
		if (version_compare(ITOP_DESIGN_LATEST_VERSION , '3.0') < 0) {
			if (file_exists(APPROOT."/js/swfobject.js")) {
				$this->add_linked_script("../js/swfobject.js");
			}
		}
		$this->add_ready_script(
<<<EOF
try
{
	//add new widget called TruncatedList to properly display truncated lists when they are sorted
	$.tablesorter.addWidget({ 
	    // give the widget a id 
	    id: "truncatedList", 
	    // format is called when the on init and when a sorting has finished 
	    format: function(table)
	    { 
			// Check if there is a "truncated" line
			this.truncatedList = false;  
			if ($("tr td.truncated",table).length > 0)
			{
				this.truncatedList = true;
			}
			if (this.truncatedList)
			{
				$("tr td",table).removeClass('truncated');
				$("tr:last td",table).addClass('truncated');
			}
	    } 
	});
		
	
	$.tablesorter.addWidget({ 
	    // give the widget a id 
	    id: "myZebra", 
	    // format is called when the on init and when a sorting has finished 
	    format: function(table)
	    {
	    	// Replace the 'red even' lines by 'red_even' since most browser do not support 2 classes selector in CSS, etc..
			$("tbody tr:even",table).addClass('even');
			$("tbody tr.red:even",table).removeClass('red').removeClass('even').addClass('red_even');
			$("tbody tr.orange:even",table).removeClass('orange').removeClass('even').addClass('orange_even');
			$("tbody tr.green:even",table).removeClass('green').removeClass('even').addClass('green_even');
	    } 
	});
		
	$("table.listResults").tableHover(); // hover tables
	$(".listResults").tablesorter( { widgets: ['myZebra', 'truncatedList']} ); // sortable and zebra tables
	$(".date-pick").datepicker({
			showOn: 'button',
			buttonImage: '../images/calendar.png',
			buttonImageOnly: true,
			dateFormat: 'yy-mm-dd',
			constrainInput: false,
			changeMonth: true,
			changeYear: true
		});
	$('.resizable').resizable(); // Make resizable everything that claims to be resizable !
	$('.caselog_header').click( function () { $(this).toggleClass('open').next('.caselog_entry').toggle(); });
}
catch(err)
{
	// Do something with the error !
	alert(err);
}
EOF
);

	$this->add_script(
<<<EOF
	function CheckSelection(sMessage)
	{
		var bResult = ($('input:checked').length > 0);
		if (!bResult)
		{
			alert(sMessage);
		}
		return bResult;
	}

	function GoBack()
	{
		var form = $('#request_form');
		var step = $('input[name=step]');

		form.unbind('submit'); // De-activate validation
		step.val(step.val() -2); // To go Back one step: next step is x, current step is x-1, previous step is x-2
		form.submit(); // Go
	}
EOF
);
		
	}
	
	/**
	 * Add a button to the portal's main menu
	 */
	public function AddMenuButton($sId, $sLabel, $sHyperlink)
	{
		$this->m_aMenuButtons[] = array('id' => $sId, 'label' => $sLabel, 'hyperlink' => $sHyperlink);
	}

	/**
	 * @inheritDoc
	 */
	public function output()
	{
		$sMenu = '';
		//$this->AddMenuButton('logoff', 'Portal:Disconnect', '../pages/logoff.php'); // This menu is always present and is the last one
		foreach($this->m_aMenuButtons as $aMenuItem)
		{
			$sMenu .= "<a class=\"button\" id=\"{$aMenuItem['id']}\" href=\"{$aMenuItem['hyperlink']}\"><span>".Dict::S($aMenuItem['label'])."</span></a>";
		}
		$this->s_content = '<div id="portal"><div id="banner"><div id="logo"></div><h1 style="display: inline-block; float:right; vertical-align:middle; margin-right:20px">'.$this->s_title.'</h1>'.$sMenu.'</div><div id="content">'.$this->s_content.'</div></div>';
		parent::output();
	}

	public function SetCurrentTabContainer($sTabContainer = '')
	{
		return '';
	}

	public function SetCurrentTab($sTabLabel = '')
	{
		return '';
	}
}
