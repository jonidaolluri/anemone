<?php
if(isset($successMessage)){

    foreach($successMessage as $success){
        echo '<script>swal("' .$success. '", "", "success");</script>';
    }
}
if(isset($warningMessage)){
    echo "<script>console.log('hi');for(let i=0;i<2;i++){console.log(".$warningMessage."[i]);}</script>";
    
    foreach($warningMessage as $warning){
        echo "<script>console.log('hiiii');</script>";

        echo "<script>console.log(".$warning."aa);</script>";
        echo '<script>swal("' .$warning. '", "", "warning");</script>';
    }
}
if(isset($infoMessage)){
    foreach($infoMessage as $info){
        echo '<script>swal("' .$info. '", "", "info");</script>';
    }
}
if(isset($errorMessage)){
    foreach($errorMessage as $error){
        echo '<script>swal("' .$error. '", "", "error");</script>';
    }
}
?>