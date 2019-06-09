<?php
$data = '#include<stdio.h> 
 
int main(){
printf("Hello World");
return 0;
}
 
';
$my_file = 'code.c';
$size = file_put_contents(dirname(__FILE__) . "/" . $my_file, $data);
echo "path = " . dirname(__FILE__) . "/" . $my_file . "<br>";
if ($size === FALSE){
	echo "false<br>";
}
else {
	echo "done<br>";
} 

// $output = system("gcc {$my_file} &> error.txt 2>&1");
$output = shell_exec("clang {$my_file} &> error.txt 2>&1");
$error = file_get_contents("error.txt");
 
echo "--$output--<br>";
if($error=='')
    system("./a.out");
else
    echo $error;
?>
