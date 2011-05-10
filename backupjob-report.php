<?php
  session_start();
  include_once( 'config.inc.php' );

  $dbSql = new Bweb();

  $backupjob_name 		= "";
  $backupjob_bytes		= 0;
  $backupjob_files		= 0;

  $days  				= array();
  $days_stored_bytes 	= array();
  $days_stored_files	= array();

  // ===============================================================
  // Get Backup Job name from GET or POST
  // ===============================================================
  if( isset( $_POST["backupjob_name"] ) )
    $backupjob_name = $_POST["backupjob_name"];
  elseif( isset( $_GET["backupjob_name"] ) )
	$backupjob_name = $_GET["backupjob_name"];
  else
	die( "Please specify a backup job name " );

  // Get the last 7 days interval (start and end)
  for( $c = 6 ; $c >= 0 ; $c-- ) {
	  $today = ( mktime() - ($c * LAST_DAY) );
	  array_push( $days, array( 'start' => date( "Y-m-d 00:00:00", $today ), 'end' => date( "Y-m-d 23:59:00", $today ) ) );
  }
  
  // Generate Backup Job report period string
  $backupjob_period = "From " . date( "Y-m-d", mktime()-LAST_WEEK ) . " to " . date( "Y-m-d", mktime() );
  
  // ===============================================================
  // Last 7 days stored Bytes graph
  // ===============================================================  
  $graph = new BGraph( "graph2.png" );

  foreach( $days as $day )
    array_push( $days_stored_bytes, $dbSql->GetStoredBytesByJob( $backupjob_name, $day['start'], $day['end'] ) );
 
  // Calculate total bytes for this period
  foreach( $days_stored_bytes as $day )
	$backupjob_bytes += $day[1];
	
  $graph->SetData( $days_stored_bytes, 'bars', 'text-data' );
  $graph->SetGraphSize( 400, 230 );

  $graph->Render();
  $dbSql->tpl->assign('graph_stored_bytes', $graph->Get_Image_file() );	
  
  // ===============================================================
  // Getting last 7 days stored files graph
  // ===============================================================
  $graph = new BGraph("graph3.png" );
  
  foreach( $days as $day )
    array_push( $days_stored_files, $dbSql->GetStoredFilesByJob( $backupjob_name, $day['start'], $day['end'] ) );

  // Calculate total files for this period	
  foreach( $days_stored_files as $day )
	$backupjob_files += $day[1];
  
  $graph->SetData( $days_stored_files, 'bars', 'text-data' );
  $graph->SetGraphSize( 400, 230 );

  $graph->Render();
  $dbSql->tpl->assign('graph_stored_files', $graph->Get_Image_file() );

  // Last 10 jobs
  $query    = "SELECT JobId, Level, JobFiles, JobBytes, JobStatus, EndTime, Name ";  
  $query   .= "FROM Job ";
  $query   .= "WHERE Name = '$backupjob_name' ";
  $query   .= "ORDER BY EndTime DESC ";
  $query   .= "LIMIT 10 ";
  
  $jobs		= array();
  $joblevel = array( 'I' => 'Incr', 'D' => 'Diff', 'F' => 'Full' );
  $result 	= $dbSql->db_link->query( $query );
  
  if( ! PEAR::isError( $result ) )
  {
	while( $job = $result->fetchRow( DB_FETCHMODE_ASSOC ) ) {
		$job['Level'] = $joblevel[ $job['Level'] ];
		array_push( $jobs, $job);
	}		
  }else
	die( "Unable to get last jobs from catalog " . $result->getMessage() );
    
  $dbSql->tpl->assign('jobs', $jobs );
  $dbSql->tpl->assign('backupjob_name', $backupjob_name );
  $dbSql->tpl->assign('backupjob_period', $backupjob_period );
  $dbSql->tpl->assign('backupjob_bytes', $backupjob_bytes );
  $dbSql->tpl->assign('backupjob_files', $backupjob_files );
  
  // Process and display the template 
  $dbSql->tpl->display('backupjob-report.tpl'); 
  
?>
