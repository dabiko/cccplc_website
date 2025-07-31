<?php
require_once('utilities.php');

$errorMSG;
$namer;   
$newfilename;

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

if (empty($_POST["name"])) {
    $errorMSG = "name is required";
} else {
    
    $values[] = $_POST['name'];
    $namer=$_POST['name'];
   
}

if (empty($_POST["email"])) {
    $errorMSG = "email is required";
} else {
    $values[] = $_POST['email'];
  
}

if (empty($_POST["country"])) {
    $errorMSG = "country is required";
} else {
    $values[] = $_POST['country'];
     
  
}

if (empty($_POST["telephone"])) {
    $errorMSG = "please your telephone is required";
} else {
    $values[] = $_POST['telephone'];
     
  
}




if (empty($_POST["job_specification"])) {
    $errorMSG = "job_specification is required";
} else {
    $values[] =$_POST['job_specification'];
  
}

if (empty($_POST["salary"])) {
    $errorMSG = "Salary is required";
} else {
    $values[] = $_POST['salary'];
  
}

if (empty($_FILES['cv']['name'])) {
     $errorMSG = "please choose file is required";
} else {
    if ($_FILES["cv"]["error"] > 0) {
       $errorMSG ="CV UPLOAD ERROR Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
    else {
    $img = $_FILES['cv']['name'];
    $ext = explode(".", $_FILES["cv"]["name"]);
    $ext =end($ext);
    $ext = strtolower($ext);
    $newfilename=clean($namer);
    $newfilename .= round(microtime(true)) . '.' . $ext;
    $values[] = strtolower($newfilename);
}
  
}


if (empty($_POST["cover_letter"])) {
    $errorMSG = "cover_letter is required";
} else {
     $values[] = $_POST['cover_letter'];
 
}

   
    $fields[] = "name";
    $fields[] = "email";
    $fields[] = "country";
    $fields[] = "tel";
    $fields[] = "job";
    $fields[] = "salary";
    $fields[] = "cv";
    $fields[] = "cover_letter";
    $fields[] = "date_created";
    $fields[] = "date_updated";
     
  
    $values[] = date('Y-m-d H:i:s');
    $values[] = date('Y-m-d H:i:s'); 

// echo '<pre>'; print_r($values); echo '</pre>';




 
if(empty($errorMSG)){
try{

    //fill the require fields
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx'); // valid extensions
$path = 'uploads/'; // upload directory
$img = $_FILES['cv']['name'];
$tmp = $_FILES['cv']['tmp_name'];
  $ext = explode(".", $_FILES["cv"]["name"]);
  $ext =end($ext);
  $ext = strtolower($ext);
  $newfilename=clean($namer);
// get uploaded file's extension
//$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
//$final_image = rand(1000,1000000).$img;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 

//$temp = explode(".", $_FILES["file"]["name"]);
//$newfilename = round(microtime(true)) . '.' . end($temp);

  
    $newfilename .= round(microtime(true)) . '.' . $ext;

//move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);
$path = $path.strtolower($newfilename); 

if(move_uploaded_file($tmp,$path)) 
{

//include database configuration file

    //using our query controller class to dynamically insert data into our database
   $runQ = new QueryControllers();
    $output;
    $output=$runQ->InsertData('hr', $fields, $values);
  if($output===true){
     $errorMSG= "APPLICATION RECEIVED SUCCESSFULLY";
     echo 1;
     
     
  }else{
//       throw new Exception($output);
    
        $errorMSG=  "APPLICATION SUBMISSION Error: ".$output;
    echo $errorMSG;
  }



} 
else 
{
echo 'FAILED TO UPLOAD CV: invalid file path';
}
    
}
else{
echo 'UNSUPPORTED FILE EXTENSION : FILE FORMAT ACCEPTED (jpeg,jpg,png,gif,bmp,pdf,doc,ppt,docx)';       
    }
        

   
}
 catch (Throwable $e) {
      $saved_error =  'CCC PLC DEBUGER ERROR on line '.$e->getLine().' FILE CONTAINING ERROR '.$e->getFile()
    .': ERROR INFO : '.$e->getMessage().' CONTACT WEBMASTER';
     echo $errorMSG;        
        
}
}
else{
    $id_card=$errorMSG;
    $errorMSG.=" is required ";
    echo $errorMSG;
   
}






?>