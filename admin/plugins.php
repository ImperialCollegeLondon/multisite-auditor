<?php

	global $wpdb;

	echo '<h1>Plugins</h1> ';

	// Firstly get a blank of array of the themes
	$currentPlugins = get_plugins();

	echo '<table id="pluginsTable">';
	echo '<thead><tr><th>Plugin Name</th><th>Folder</th><th>Network Activated</th><th>Description</th><th>Number</th></thead>';

	foreach($currentPlugins as $pluginRef => $pluginObject)
	{

		$pluginIsNetworkActivated = false;
		$rowClass="";
		$tdClass = "";
		if ( is_plugin_active_for_network( $pluginRef ) ) {
			// Plugin is activated
			$pluginIsNetworkActivated = true;
			$rowClass="active";
			$tdClass = "tdActive";
		}


		$thisPluginName = $pluginObject['Name'];
		$pluginDescription = $pluginObject['Description'];
		$version = $pluginObject['Version'];

		$thisPlugin = MSA_functions::getPluginNameFromRef($pluginRef);

		// Get the number of sites using this plugin
		$blogList = MSA_functions::getBlogsUsingPlugin($thisPlugin);
		$pluginUseCount=0;
		$pluginUseCount=count($blogList);

		$pluginLink = "admin.php?page=multisite-auditor-plugin-info&pluginName=".$thisPlugin;

		echo '<tr class="'.$rowClass.'">';
		echo '<td valign="top" width="200px" class="'.$tdClass.'">';
		echo '<span style="font-size:14px"><a href="'.$pluginLink.'">'.$thisPluginName.'</a></span>';
		echo '</td><td>';

		echo $thisPlugin;
		echo '</td><td>';
		if($pluginIsNetworkActivated==true)
		{
			echo 'Yes';
		}
		else
		{
			echo 'No';
		}
		echo '</td>';


		echo '<td valign="top" style="color:#808080;">';
		echo $pluginDescription;
		if($version){echo '<br/><span style="font-size:9px">Version '.$version.'</span>';}
		echo '</td>';
		echo '<td width="100px" valign="top">';
		echo $pluginUseCount;
		echo '</td>';
		echo '</tr>';
	}

	// Add the missing blogs as well
	echo '</table>';
	?>


	<script>
    jQuery(document).ready( function () {

   	var table = jQuery('#pluginsTable').DataTable( {
   		"bAutoWidth": true,
   		"bJQueryUI": true,
   		"sPaginationType": "full_numbers",
   		"iDisplayLength": 50, // How many numbers by default per page
   		buttons: [
   		{
   			extend: 'copy',
   			text: '<span class="icon"><i class="fas fa-copy"></i></span><span>Copy to clipboard</span>',
   			className: 'button',

   		},
   		{
   			extend: 'excel',
   			text: '<span class="icon"><i class="fas fa-file-excel"></i></span><span>Download Excel</span>',
   			className: 'button',

   		},
   	]
   	} );

   	// Insert at the top left of the table
   	table.buttons().container()
   		.appendTo( jQuery('div.column.is-half', table.table().container()).eq(0) );

    } );




    </script>
