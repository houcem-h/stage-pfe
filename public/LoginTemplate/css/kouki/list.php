<?php

$dir1   = 'Control & Navigation';
$dir2   = 'Controls';
$dir3   = 'Devices';
$dir4   = 'Devices & Network';
$dir5   = 'E-Com';
$dir6   = 'Editing';
$dir7   = 'Files & Folders';
$dir8   = 'Finance';
$dir9   = 'Flat';
//$dir10  = 'Flat Smashicons';
$dir11  = 'Gaming';
$dir12  = 'Health & Nutrition';
$dir13  = 'Household';
$dir14  = 'Miscellanceous';
$dir15  = 'Office';
$dir16  = 'Outdoors';
//$dir17  = 'Outline Smashicons';
$dir18  = 'Photo & Video';
$dir19  = 'Social';
$dir20  = 'Social media';
//$dir21  = 'Solid Smashicons';
$dir22  = 'Text Editor';
$dir23  = 'UI';
$dir24  = 'Weather';
$dir25  = 'Web';
//$dir26  = 'Webby Smashicons';

///////////////

$files1  = scandir($dir1 );
$files2  = scandir($dir2 );
$files3  = scandir($dir3 );
$files4  = scandir($dir4 );
$files5  = scandir($dir5 );
$files6  = scandir($dir6 );
$files7  = scandir($dir7 );
$files8  = scandir($dir8 );
$files9  = scandir($dir9 );
//$files10 = scandir($dir10);
$files11 = scandir($dir11);
$files12 = scandir($dir12);
$files13 = scandir($dir13);
$files14 = scandir($dir14);
$files15 = scandir($dir15);
$files16 = scandir($dir16);
//$files17 = scandir($dir17);
$files18 = scandir($dir18);
$files19 = scandir($dir19);
$files20 = scandir($dir20);
//$files21 = scandir($dir21);
$files22 = scandir($dir22);
$files23 = scandir($dir23);
$files24 = scandir($dir24);
$files25 = scandir($dir25);
//$files26 = scandir($dir26);

////////////////////




$files1 = scandir($dir1);
unset($files1[0]);
unset($files1[1]);
$files1 = array_values($files1);

$files2 = scandir($dir2);
unset($files2[0]);
unset($files2[1]);
$files2 = array_values($files2);

$files3 = scandir($dir3);
unset($files3[0]);
unset($files3[1]);
$files3 = array_values($files3);

$files4 = scandir($dir4);
unset($files4[0]);
unset($files4[1]);
$files4 = array_values($files4);

$files5 = scandir($dir5);
unset($files5[0]);
unset($files5[1]);
$files5 = array_values($files5);

$files6 = scandir($dir6);
unset($files6[0]);
unset($files6[1]);
$files6 = array_values($files6);

$files7 = scandir($dir7);
unset($files7[0]);
unset($files7[1]);
$files7 = array_values($files7);

$files8 = scandir($dir8);
unset($files8[0]);
unset($files8[1]);
$files8 = array_values($files8);

$files9 = scandir($dir9);
unset($files9[0]);
unset($files9[1]);
$files9 = array_values($files9);

// $files10 = scandir($dir10);
// unset($files10[0]);
// unset($files10[1]);
// $files10 = array_values($files10);

$files11 = scandir($dir11);
unset($files11[0]);
unset($files11[1]);
$files11 = array_values($files11);

$files12 = scandir($dir12);
unset($files12[0]);
unset($files12[1]);
$files12 = array_values($files12);

$files13 = scandir($dir13);
unset($files13[0]);
unset($files13[1]);
$files13 = array_values($files13);

$files14 = scandir($dir14);
unset($files14[0]);
unset($files14[1]);
$files14 = array_values($files14);

$files15 = scandir($dir15);
unset($files15[0]);
unset($files15[1]);
$files15 = array_values($files15);

$files16 = scandir($dir16);
unset($files16[0]);
unset($files16[1]);
$files16 = array_values($files16);

// $files17 = scandir($dir17);
// unset($files17[0]);
// unset($files17[1]);
// $files17 = array_values($files17);

$files18 = scandir($dir18);
unset($files18[0]);
unset($files18[1]);
$files18 = array_values($files18);

$files19 = scandir($dir19);
unset($files19[0]);
unset($files19[1]);
$files19 = array_values($files19);

$files20 = scandir($dir20);
unset($files20[0]);
unset($files20[1]);
$files20 = array_values($files20);

// $files21 = scandir($dir21);
// unset($files21[0]);
// unset($files21[1]);
// $files21 = array_values($files21);

$files22 = scandir($dir22);
unset($files22[0]);
unset($files22[1]);
$files22 = array_values($files22);

$files23 = scandir($dir23);
unset($files23[0]);
unset($files23[1]);
$files23 = array_values($files23);

$files24 = scandir($dir24);
unset($files24[0]);
unset($files24[1]);
$files24 = array_values($files24);

$files25 = scandir($dir25);
unset($files25[0]);
unset($files25[1]);
$files25 = array_values($files25);

// $files26 = scandir($dir26);
// unset($files26[0]);
// unset($files26[1]);
// $files26 = array_values($files26);









echo "/* [[ $dir1 ]] */ <br><br><br>";
foreach($files1 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir1/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir2 ]] */ <br><br><br>";
foreach($files2 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir2/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir3 ]] */ <br><br><br>";
foreach($files3 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir3/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir4 ]] */ <br><br><br>";
foreach($files4 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir4/" . $value.'");<br>
}' . "<br><br>";
}


echo "/* [[ $dir5 ]] */ <br><br><br>";
foreach($files5 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir5/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir6 ]] */ <br><br><br>";
foreach($files6 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir6/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir7 ]] */ <br><br><br>";
foreach($files7 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir7/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir8 ]] */ <br><br><br>";
foreach($files8 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir8/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir9 ]] */ <br><br><br>";
foreach($files9 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir9/" . $value.'");<br>
}' . "<br><br>";
}



// echo "/* [[ $dir10 ]] */ <br><br><br>";
// foreach($files10 as $value) {
	// $temp_name = str_replace('.svg', '', $value);
	// echo '.kk-'.$temp_name.' {<br>
   // &nbsp; &nbsp;background-image: url("kouki/'."$dir10/" . $value.'");<br>
// }' . "<br><br>";
// }



echo "/* [[ $dir11 ]] */ <br><br><br>";
foreach($files11 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir11/" . $value.'");<br>
}' . "<br><br>";
}


echo "/* [[ $dir12 ]] */ <br><br><br>";
foreach($files12 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir12/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir13 ]] */ <br><br><br>";
foreach($files13 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir13/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir14 ]] */ <br><br><br>";
foreach($files14 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir14/" . $value.'");<br>
}' . "<br><br>";
}



echo "/* [[ $dir15 ]] */ <br><br><br>";
foreach($files15 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir15/" . $value.'");<br>
}' . "<br><br>";
}


echo "/* [[ $dir16 ]] */ <br><br><br>";
foreach($files16 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir16/" . $value.'");<br>
}' . "<br><br>";
}



// echo "/* [[ $dir17 ]] */ <br><br><br>";
// foreach($files17 as $value) {
	// $temp_name = str_replace('.svg', '', $value);
	// echo '.kk-'.$temp_name.' {<br>
   // &nbsp; &nbsp;background-image: url("kouki/'."$dir17/" . $value.'");<br>
// }' . "<br><br>";
// }



echo "/* [[ $dir18 ]] */ <br><br><br>";
foreach($files18 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir18/" . $value.'");<br>
}' . "<br><br>";
}




echo "/* [[ $dir19 ]] */ <br><br><br>";
foreach($files19 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir19/" . $value.'");<br>
}' . "<br><br>";
}




echo "/* [[ $dir20 ]] */ <br><br><br>";
foreach($files20 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir20/" . $value.'");<br>
}' . "<br><br>";
}


// echo "/* [[ $dir21 ]] */ <br><br><br>";
// foreach($files21 as $value) {
	// $temp_name = str_replace('.svg', '', $value);
	// echo '.kk-'.$temp_name.' {<br>
   // &nbsp; &nbsp;background-image: url("kouki/'."$dir21/" . $value.'");<br>
// }' . "<br><br>";
// }


echo "/* [[ $dir22 ]] */ <br><br><br>";
foreach($files22 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir22/" . $value.'");<br>
}' . "<br><br>";
}


echo "/* [[ $dir23 ]] */ <br><br><br>";
foreach($files23 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir23/" . $value.'");<br>
}' . "<br><br>";
}

echo "/* [[ $dir24 ]] */ <br><br><br>";
foreach($files24 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir24/" . $value.'");<br>
}' . "<br><br>";
}

echo "/* [[ $dir25 ]] */ <br><br><br>";
foreach($files25 as $value) {
	$temp_name = str_replace('.svg', '', $value);
	echo '.kk-'.$temp_name.' {<br>
   &nbsp; &nbsp;background-image: url("kouki/'."$dir25/" . $value.'");<br>
}' . "<br><br>";
}


// echo "/* [[ $dir26 ]] */ <br><br><br>";
// foreach($files2 as $value) {
	// $temp_name = str_replace('.svg', '', $value);
	// echo '.kk-'.$temp_name.' {<br>
   // &nbsp; &nbsp;background-image: url("kouki/'."$dir26/" . $value.'");<br>
// }' . "<br><br>";
// }


















?>