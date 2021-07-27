<?php
include('classes/member_page_class.php');
include('../../manna-configs/db_cfg/agent_config.php');
//get_regions_array($regionalnum);
print_r($_POST);
if(isset($_POST['B1'])){
  print_r($_POST);
}
else {
  // code...
$object = new member_page_info;
$regions_array = $object->get_regions_array(2875);

echo '<br>$regions_array =';
print_r($regions_array );
echo '<br>Count = ', count($regions_array[0]);
$favcolor = "red";

switch (count($regions_array[0])-1) {
  case "0":
    echo 'Global Ad!<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
    <input type="hidden" name="url" value="'.$_GET['url'].'">
    <input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
    <input type="hidden" name="cat_id" value="'.$_GET['category_id'].'">
    <input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
    <input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
    <input type="hidden" name="coin_type" value="BSV"> <input type="hidden" name="location_id" value="'.$regions_array[0][0].'"><input type="submit" class="submit" name="B1" value="Load Your Account With BSV " style="
        border:0;
        background-color:transparent;
        color: blue;
        text-decoration:underline;
    font-size: 16px;
    font-weight: bold;
    background-color: #4CAF50;
    border-radius: 15px;

    "/>';

    break;
  case "1":
    echo 'Continental Ad!<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
    <input type="hidden" name="url" value="'.$_GET['url'].'">
    <input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
    <input type="hidden" name="cat_id" value="'.$_GET['category_id'].'">
    <input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
    <input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
    <input type="hidden" name="coin_type" value="BSV"> <input type="hidden" name="location_id" value="'.$regions_array[1].'"><input type="submit" class="submit" name="B1" value="Load Your Account With BSV " style="
        border:0;
        background-color:transparent;
        color: blue;
        text-decoration:underline;
    font-size: 16px;
    font-weight: bold;
    background-color: #4CAF50;
    border-radius: 15px;

    "/>';
    break;
  case "2":
    echo 'Countrywide Ad!<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
    <input type="hidden" name="url" value="'.$_GET['url'].'">
    <input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
    <input type="hidden" name="cat_id" value="'.$_GET['category_id'].'">
    <input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
    <input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
    <input type="hidden" name="coin_type" value="BSV"> <input type="hidden" name="location_id" value="'.$regions_array[2].'">';
    break;
    case "3":
      echo 'Statewide Ad!<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
      <input type="hidden" name="url" value="'.$_GET['url'].'">
      <input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
      <input type="hidden" name="cat_id" value="'.$_GET['category_id'].'">
      <input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
      <input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
      <input type="hidden" name="coin_type" value="BSV"> <input type="hidden" name="location_id" value="'.$regions_array[3].'"><input type="submit" class="submit" name="B1" value="Load Your Account With BSV " style="
          border:0;
          background-color:transparent;
          color: blue;
          text-decoration:underline;
      font-size: 16px;
      font-weight: bold;
      background-color: #4CAF50;
      border-radius: 15px;

      "/>';
      break;
      case "4":
        echo 'Citywide Ad!<form name="test" action="'. htmlentities($_SERVER['PHP_SELF']).'" method="post">
        <input type="hidden" name="url" value="'.$_GET['url'].'">
        <input type="hidden" name="link_id" value="'.$_GET['link_id'].'">
        <input type="hidden" name="cat_id" value="'.$_GET['category_id'].'">
        <input type="hidden" name="installer_id" value="'.$_GET['installer_id'].'">
        <input type="hidden" name="agent_ID" value="'.AGENT_ID.'">
        <input type="hidden" name="coin_type" value="BSV"> <input type="hidden" name="location_id" value="2875"><input type="submit" class="submit" name="B1" value="Load Your Account With BSV " style="
            border:0;
            background-color:transparent;
            color: blue;
            text-decoration:underline;
        font-size: 16px;
        font-weight: bold;
        background-color: #4CAF50;
        border-radius: 15px;

        "/>';
        break;
  default:
    echo "Your favorite color is neither red, blue, nor green!";
}

foreach($regions_array[0] as $key=>$value){
echo '<br>key = ', $key;
echo '         value = ', $value;
echo '     $regions_array[1] = ', $regions_array[1][$key];

}
}
?>
