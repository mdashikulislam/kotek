<h1 class="pageTitle"><?php echo $title;?></h1>
<div class="dashboardWrapper">
<?php
echo $this->tinyMce;

echo "<table cellpadding='3' cellspacing='0' border='0' class='createNewTable'>";

echo "<tr>";
echo "<td width='150'><label for='subject'>Name :</label></td><td width='810'>";
echo $user_request['name']."</td>";
echo "</tr>";

echo "<tr>";
echo "<td width='150'><label for='subject'>Email :</label></td><td width='810'>";
echo $user_request['email']."</td>";
echo "</tr>";

echo "<tr>";
echo "<td width='150'><label for='subject'>Phone no :</label></td><td width='810'>";
echo $user_request['phoneno']."</td>";
echo "</tr>";

echo "<tr>";
echo "<td width='150'><label for='subject'>Message :</label></td><td width='810'>";
echo $user_request['message']."</td>";
echo "</tr>";


echo "<tr>";
echo "<td width='150'><label for='subject'>Reply :</label></td><td width='810'>";
echo " <a href='".base_url()."admin/subscribers/replyRequest/".$user_request['id']."' class='' title='Delete'> Click Here </a></td>";
echo "</tr>";

echo "</table>";
?>
</div>