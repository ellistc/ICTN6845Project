<?php
/* ICTN 6845 Final Project>

Copyright © <years> <Tim Ellis>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */
// Base code got from Murach's PHP and MySQL 2nd Edition by Joel Murrach and Ray Harris

session_start();
require_once('database.php');

// Get all events
$query = 'SELECT * FROM events
                       ORDER BY eventID';
$statement = $db->prepare($query);
$statement->execute();
$events = $statement->fetchAll();
$statement->closeCursor();
?>

<?php
// Base code from http://www.ineedtutorials.com/code/php/creating-a-simple-login-script-with-php-and-mysql
if (!isset($_SESSION['username']) || !isset($_SESSION['loginid'])) {
    //   echo 'Session username inside if: ' . $_SESSION['username'];
    //   echo 'Session login inside if: ' . $_SESSION['loginid'];
    //(!session_is_registered('loginid') || !session_is_registered('username'))
    // user is not logged in.
    if (isset($_POST['cmdlogin'])) {
        // retrieve the username and password sent from login form
      
        $u = strip_tags($_POST['username']);
        $p = md5(strip_tags($_POST['password']));
        //Now let us look for the user in the database.
        //echo 'username: '.$u;
        //echo 'password: '.$p;

        $querypw = 'SELECT loginid FROM login WHERE username = :username AND password = :password LIMIT 1;';
        // echo $querypw;
        $statementpw = $db->prepare($querypw);
        $statementpw->bindValue(':username', $u, PDO::PARAM_STR);


        $statementpw->bindValue(':password', $p, PDO::PARAM_STR);
        $statementpw->execute();
        $resultpw = $statementpw->fetchAll();
        $statementpw->closeCursor();


        if (count($resultpw) != 1) {
            // invalid login information
            echo "Wrong username or password!";
            //show the loginform again.
            include "loginform.php";
        } else {
            // Login was successfull
            // Save the user ID for use later
            $_SESSION['loginid'] = $u;
            // Save the username for use later
            $_SESSION['username'] = $u;
            // Now we show the userbox
            ?>
            <!DOCTYPE html>
            <html>
                <a href="logout.php">Administrative Logout</a>
                <!-- the head section -->
                <head>
                    <title>Newport Community Volunteering</title>
                    <link rel="stylesheet" type="text/css" href="main.css" />
                    <link rel="stylesheet" type="text/css" href="pikaday.css" />

                </head>

                <!-- the body section -->
                <body>
                    <img src="logo.png" alt="Newport Community Volunteering"</h1>
                <!-- Logo made at https://logomakr.com/6k8vIP# -->
                <br>

                <header><h1>Event Manager</h1></header>
                <main>
                    <h1>Event List</h1>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Event Description</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Event People Needed</th>
                            <th>&nbsp;</th>
                        </tr>        
                        <?php foreach ($events as $event) : ?>
                            <tr>
                                <td><?php echo $event['eventName']; ?></td>
                                <td><?php echo $event['eventDescription']; ?></td>
                                <td><?php echo $event['eventDate']; ?></td>
                                <td><?php echo $event['eventTime']; ?></td>
                                <td><?php echo $event['eventPeopleNeeded']; ?></td>
                                <td>
                                    <form action="delete_category.php" method="post">
                                        <input type="hidden" name="event_id"
                                               value="<?php echo $event['eventID']; ?>"/>
                                        <input type="submit" value="Remove"/>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>    
                    </table>

                    <!-- Begin adding new event code -->
                    <h1 class="margin_top_increase">Add Event</h1>
                    <form action="add_category.php" method="post"
                          id="add_category_form">

                        <label>Name:</label>
                        <input type="text" name="name" /> <br>
                        <label>Description:</label>
                        <input type="text" name="description" /><br>
                        <label>Event Date:</label>
                        <input type="text" name="date" id="datepicker" /><br>
                        <label>Event Time:</label>
                        <input type="time" name="time" /><br>
                        <label>People Needed:</label>
                        <input type="text" name="people_needed" /><br>
                        <input id="add_category_button" type="submit" value="Add"/>
                    </form>

                    <p><a href="index.php">Homepage</a></p>

                </main>
                <footer>
                    <p>&copy; <?php echo date("Y"); ?> Newport Community Volunteering, Inc.</p>
                </footer>
            </body>
            <script src="pikaday.js"></script> <!-- Taken from https://github.com/dbushell/Pikaday -->
            <script>
                var picker = new Pikaday({field: document.getElementById('datepicker')});
                // code from https://github.com/dbushell/Pikaday
            </script>
            </html>
            <?php
        }
    } else {
        // User is not logged in and has not pressed the login button
        // so we show him the loginform
        include "loginform.php";
    }
} else {
    // The user is already loggedin, so we show the userbox.
    //already logged in?
    ?>
    <html>

        <!-- the head section -->
        <head>
            <title>Newport Community Volunteering</title>
            <link rel="stylesheet" type="text/css" href="main.css" />
            <link rel="stylesheet" type="text/css" href="pikaday.css" />

        </head>
        <a href="logout.php">Administrative Logout</a>
        <!-- the body section -->
        <body>
            <img src="logo.png" alt="Newport Community Volunteering"</h1>
        <!-- Logo made at https://logomakr.com/6k8vIP# -->
        <br>

        <header><h1>Event Manager</h1></header>
        <main>
            <h1>Event List</h1>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Event Description</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Event People Needed</th>
                    <th>&nbsp;</th>
                </tr>        
                <?php foreach ($events as $event) : ?>
                    <tr>
                        <td><?php echo $event['eventName']; ?></td>
                        <td><?php echo $event['eventDescription']; ?></td>
                        <td><?php echo $event['eventDate']; ?></td>
                        <td><?php echo $event['eventTime']; ?></td>
                        <td><?php echo $event['eventPeopleNeeded']; ?></td>
                        <td>
                            <form action="delete_category.php" method="post">
                                <input type="hidden" name="event_id"
                                       value="<?php echo $event['eventID']; ?>"/>
                                <input type="submit" value="Remove"/>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </table>

            <!-- Begin adding new event code -->
            <h1 class="margin_top_increase">Add Event</h1>
            <form action="add_category.php" method="post"
                  id="add_category_form">

                <label>Name:</label>
                <input type="text" name="name" /> <br>
                <label>Description:</label>
                <input type="text" name="description" /><br>
                <label>Event Date:</label>
                <input type="text" name="date" id="datepicker" /><br>
                <label>Event Time:</label>
                <input type="time" name="time" /><br>
                <label>People Needed:</label>
                <input type="text" name="people_needed" /><br>
                <input id="add_category_button" type="submit" value="Add"/>
            </form>

            <p><a href="index.php">Homepage</a></p>

        </main>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> Newport Community Volunteering, Inc.</p>
        </footer>
    </body>
    <script src="pikaday.js"></script> <!-- Taken from https://github.com/dbushell/Pikaday -->
    <script>
                var picker = new Pikaday({field: document.getElementById('datepicker')});
                // https://github.com/dbushell/Pikaday
    </script>
    </html>
    <?php
}
?>


