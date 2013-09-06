<?php
class DBUtility {

	function DBUtility($sqlfile)	{
		$lines = file($sqlfile);
		$i=0;
		$classdetails='';
		while ($i<count($lines) )	{
			$strings = explode(' ',$lines[$i]);
			if (preg_match('/CREATE TABLE/', $lines[$i])>0)	{
				$classname = trim($strings[5],"`");
				$classdetails = '<?php '."\n";
				$classdetails .= 'class '.ucfirst($classname).' {'."\n";
			} else if (isset($classname) && ($classname != '')) {
				if (preg_match('/ENGINE=InnoDB DEFAULT CHARSET=latin1/',$lines[$i]) > 0){
				$classdetails .= '?> '."\n";					
					file_put_contents('classes/'.$classname.'.php',$classdetails);
					$classname='';
				} else if (preg_match('/KEY/',$lines[$i]) == 0) {
					//echo $strings[0].' '.$strings[1].' '.$strings[2]."\n";
					$colname = trim($strings[2],"`");
					//variable declaration
					$classdetails .= 'var '.'$'.$colname.';'."\n";
					//getter method
					$classdetails .= 'function get'.ucfirst(trim($colname,"_")).'()'.' {'."\n";
					$classdetails .= 'return $this->_'.$colname. ';'."\n";
					$classdetails .= ' }'."\n";					
					//setter method
					$classdetails .= 'function set'.ucfirst(trim($colname,"_")).'($'.$colname.')'.' {'."\n";
					$classdetails .= '$this->_'. $colname . '='. $colname.';'."\n";
					$classdetails .= ' }'."\n";					
				}				
			}
			$i++;
		}
		
	}
	
}
?>