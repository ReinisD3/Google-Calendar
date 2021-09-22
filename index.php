
<!DOCTYPE html>
<html>
<body>
<h1>Event link generator</h1>

<form action="/" method="post">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" ><br>
    <label for="from">From:</label><br>
    <input type="text" id="from" name="from"><br>
    <label for="to">To:</label><br>
    <input type="text" id="to" name="to"><br>
    <label for="from">Description:</label><br>
    <input type="text" id="description" name="description"><br>
    <label for="from">Address:</label><br>
    <input type="text" id="address" name="address"><br><br><br>
    <input type="checkbox" id="linkGoogle" name="linkGoogle" value="google">
    <label for="linkGoogle"> Google Link</label>
    <input type="checkbox" id="linkYahoo" name="linkYahoo" value="yahoo">
    <label for="linkYahoo"> Yahoo Link</label>
    <input type="checkbox" id="linkOutlook" name="linkOutlook" value="webOutlook">
    <label for="linkOutlook"> WebOutlook</label>
    <input type="checkbox" id="ics" name="ics" value="ics">
    <label for="ics"> ICS</label><br><br>

    <input type="submit"  name="submit" value="Generate">
</form>


</body>
</html>

<?php

require_once 'vendor/autoload.php';

use Spatie\CalendarLinks\Link;


if (isset($_POST['title']) && isset($_POST['from']) && isset($_POST['to']))
{

    $linkType = [];
    if(isset($_POST['linkGoogle'])) $linkType[]=$_POST['linkGoogle'];
    if(isset($_POST['linkYahoo'])) $linkType[]=$_POST['linkYahoo'];
    if(isset($_POST['linkOutlook'])) $linkType[]=$_POST['linkOutlook'];
    if(isset($_POST['ics'])) $linkType[]=$_POST['ics'];

    foreach ($linkType as $type)
    {
        $link = Link::create(
            $_POST['title'],
            DateTime::createFromFormat('Y-m-d H:i', $_POST['from']),
            DateTime::createFromFormat('Y-m-d H:i', $_POST['to'])
        )
            ->description($_POST['description'])
            ->address($_POST['address'])
            ->$type();
        echo 'Event link for '.$type.':';
        echo "<br><li><a href='$link'>$link</a> </li> ";
    }

}
?>