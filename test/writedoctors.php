<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../classes/doctor.php");
  require_once("../classes/doctorQuery.php");

  $first = array("Rahul", "Sudha", "Abbas", "John", "Sukhwinder");
  $last = array("Singh", "Siddiqui", "Abraham", "Nakula", "Srinivasan");
  $speciality = array("General Surgery","General Surgery","Orthopaedics","Obstretics & Gyneacology", "Pediatrics", "Opthalmology");
  $subspeciality = array("Cardiology","Cardiotheracic Surgery","Nephrology","Urology", "Neonatology", "Neurology", "Neurosurgery");

  #****************************************************************************
  #*  Checking for post vars.  Go back to form if none found.
  #****************************************************************************
 
  #***************************************************************************
  #*  Validate data
  #****************************************************************************
  	$doctor = new Doctor();
  	$doctor->setFirst_name($first[rand(0,sizeof($first)));
  	$doctor->setLast_name($last[rand(0,sizeof($last)));
  	$doctor->setMobile(rand(7,9).rand(0,6).rand(0,6).rand(0,6).rand(0,6).rand(0,6).rand(0,6).rand(0,6).rand(0,6));
  	$doctor->setSpeciality(rand(1,10));
  }
  
  $validData = $doctor->validateData();
  if (!$validData) {
    $pageErrors["barcodeNmbr"] = $doctor->getBarcodeNmbrError();
    $pageErrors["lastName"] = $doctor->getLastNameError();
    $pageErrors["firstName"] = $doctor->getFirstNameError();
    $_SESSION["postVars"] = $_POST;
    $_SESSION["pageErrors"] = $pageErrors;
    header("Location: ../circ/mbr_new_form.php");
    exit();
  }

  #**************************************************************************
  #*  Check for duplicate barcode number
  #**************************************************************************
  $doctorQ = new MemberQuery();
  $doctorQ->connect();
  $dupBarcode = $doctorQ->DupBarcode($doctor->getBarcodeNmbr(),$doctor->getMbrid());
  if ($dupBarcode) {
    $pageErrors["barcodeNmbr"] = $loc->getText("mbrDupBarcode",array("barcode"=>$doctor->getBarcodeNmbr()));
    $_SESSION["postVars"] = $_POST;
    $_SESSION["pageErrors"] = $pageErrors;
    header("Location: ../circ/mbr_new_form.php");
    exit();
  }

  #**************************************************************************
  #*  Insert new library member
  #**************************************************************************
  $doctorid = $doctorQ->insert($doctor);
  $doctorQ->close();

  #**************************************************************************
  #*  Destroy form values and errors
  #**************************************************************************
  unset($_SESSION["postVars"]);
  unset($_SESSION["pageErrors"]);

  $msg = $loc->getText("mbrNewSuccess");
  header("Location: ../circ/mbr_view.php?mbrid=".U($doctorid)."&reset=Y&msg=".U($msg));
  exit();
?>
