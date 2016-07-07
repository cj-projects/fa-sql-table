<?php
/**
 * Created by PhpStorm.
 * User: jacyro
 * Date: 07.07.2016
 * Time: 11:31
 *
 * https://github.com/FortAwesome/Font-Awesome/blob/master/css/font-awesome.css
 *
 */

// Define
// Font Awesome CSS File to read
// e.g. https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/css/font-awesome.css (the latest official)
//
$faCssFile = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/css/font-awesome.css';

// Define
// SQL table name you want to use
$sqlTable = 'fa_icon_table';

// Define
// SQL field name you want to use
$sqlField = 'fa_icon';


$sqlQryInsertData = 'INSERT INTO `'.$sqlTable.'` ('.$sqlField.') VALUES ';
$fa_css = file($faCssFile);

$first = true;
for($i=0;$i < count($fa_css); $i++){

    if( substr ($fa_css[$i], 0, 4) === '.fa-' ) {

        if( strpos ($fa_css[$i], ':') !== false) {
            $pos = strpos ($fa_css[$i], ':');
            $faIcon[$i] = substr($fa_css[$i], 0, $pos);
            if($first) {
                $sqlQryInsertData .= '("'.$faIcon[$i].'")';
                $first=false;
            } else {
                $sqlQryInsertData .= ', ("'.$faIcon[$i].'")';
            }
        }

    }

}

$sqlQryCreateTable = 'CREATE TABLE `'.$sqlTable.'` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `'.$sqlField.'` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `'.$sqlTable.'_ID_uindex` (`ID`),
  UNIQUE KEY `'.$sqlTable.'_'.$sqlField.'_uindex` (`'.$sqlField.'`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;';

$sqlQryInsertData .= ';';

echo $sqlQryCreateTable . '<br /><br />' . $sqlQryInsertData;