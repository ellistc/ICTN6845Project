<?php
/* ICTN 6845 Final Project>

Copyright © <years> <Tim Ellis>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */
// Base code got from Murach's PHP and MySQL 2nd Edition by Joel Murrach and Ray Harris
require('database.php');
$query = 'SELECT *
          FROM events
          ORDER BY eventID';
$statement = $db->prepare($query);
$statement->execute();
$events = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Newport Community Volunteering</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <img src="logo.png" alt="Newport Community Volunteering">
            <!-- Logo made at https://logomakr.com/6k8vIP# -->
            <br>
    
    <header><h1>Community Events</h1></header>

    <main>
        <h1>Join an Event</h1>
        <form action="add_product.php" method="post"
              id="add_product_form">

            <label>Event:</label>
            <select name="event_id">
            <?php foreach ($events as $event) : ?>
                <option value="<?php echo $event['eventID']; ?>">
                    <?php echo $event['eventName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

           

            <label>Name:</label>
            <input type="text" name="name"><br>


            <label>&nbsp;</label>
            <input type="submit" value="Join Event"><br>
        </form>
        <p><a href="index.php">Home</a></p>
    </main>

    <footer>
        
        <p>Need help? Contact Jim George at <a href="tel:+1-252-867-5309">252-867-5309</a></p>
        <p>&copy; <?php echo date("Y"); ?> Newport Community Volunteering, Inc.</p>
    </footer>
</body>
</html>