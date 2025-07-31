<?php
require_once 'resources/utilities.php';
echo 'this is ccc_cusid test'.$_SESSION['ccc_cusid'];
echo 'this is ccc_cusid test'.$_SESSION['ccc_cusid'];
echo  'this is ccc_cususername test'.$_SESSION['ccc_cususername'];
echo  'this is ccc_id test'.$_SESSION['ccc_id'];
echo  'this is ccc_username test'.$_SESSION['ccc_username'];
echo 'this is cookie test'.$_COOKIE['cccUserCookie'];
echo 'this is cookie test cus'.$_COOKIE['ccccusUserCookie'];
$runQuery= new QueryControllers();
$runQuery->rememberMMe(5);
?>
['surname',
'Given_Names',
'address',
'Date_Of_Birth',
'Birth_Place',
'Division',
'Region',
'Nationality',
'Gender',
'Identification_Papers',
'Identification_Number',
'Done_At',
'Done_On',
'Expiry_Date',
'mobile_phone',
'email_address'];
[
'Marital_Status',
'Marital_Type',
'Spouse_Address',
'Spouse_Town',
'Spouse_mobile_phone',
'Spouse_email_address',
'Personal_Contact_Name',
'Personal_Contact_Relationship',
'Personal_Contact_Profession',
'Personal_Contact_mobile_phone',
'Personal_Contact_email_address
'];
[
'Existing_Account',
'Existing_Account_Number',
'Other_Sources_Details',
'Children_Names',
'Account_Type',
'Branch',
'Activity_Sector',
'Share_holder',
'Profession',
'PEP',
'Source_Of_Funds',
'Other_Income_Sources',
'Average_Monthly_Income',
];
[
'Spouse_Name',
'Spouse_Date_Of_Birth',
'Spouse_Birth_Place',
'Spouse_Division',
'Spouse_Region',
'Children_Number',
'Association_Member',
'Association_Name', 
'Association_Venue',
'Association_President',
'President_Contact'];