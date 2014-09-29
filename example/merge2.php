<?php
set_time_limit( 10 );

require_once "../class/Workbook.php";
require_once "../class/Worksheet.php";

$fname = tempnam( "/tmp", "merge2.xls" );
$workbook = &new Workbook( $fname );
$worksheet = &$workbook->addWorksheet();

# Set the column width for columns 2 and 3
$worksheet->set_column( 1, 2, 20 );

# Set the row height for row 2
$worksheet->set_row( 2, 30 );

# Create a border format
$border1 = & $workbook->addformat();
$border1->setColor( 'white' );
$border1->setBold();
$border1->setSize( 15 );
$border1->setPattern( 0x1 );
$border1->setFgColor( 'green' );
$border1->setBorderColor( 'yellow' );
$border1->setTop( 6 );
$border1->setBottom( 6 );
$border1->setLeft( 6 );
$border1->setAlign( 'center' );
$border1->setAlign( 'vcenter' );
$border1->setMerge(); # This is the key feature
# Create another border format. Note you could use copy() here.
$border2 = & $workbook->addformat();
$border2->setColor( 'white' );
$border2->setBold();
$border2->setSize( 15 );
$border2->setPattern( 0x1 );
$border2->setFgColor( 'green' );
$border2->setBorderColor( 'yellow' );
$border2->setTop( 6 );
$border2->setBottom( 6 );
$border2->setRight( 6 );
$border2->setAlign( 'center' );
$border2->setAlign( 'vcenter' );
$border2->setMerge(); # This is the key feature
# Only one cell should contain text, the others should be blank.
$worksheet->write( 2, 1, "Merged Cells", $border1 );
$worksheet->write_blank( 2, 2, $border2 );

$workbook->close();

header( "Content-Type: application/x-msexcel; name=\"example-merge2.xls\"" );
header( "Content-Disposition: inline; filename=\"example-merge2.xls\"" );
$fh = fopen( $fname, "rb" );
fpassthru( $fh );
unlink( $fname );

?>
