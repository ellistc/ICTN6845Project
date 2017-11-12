<?php
session_start();
/* ICTN 6845 Final Project>

Copyright © <years> <Tim Ellis>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */
// Base code got from Murach's PHP and MySQL 2nd Edition by Joel Murrach and Ray Harris
require_once('database.php');


require_once ('functions.inc.php');

// Get event ID
if (!isset($event_id)) {
    $event_id = filter_input(INPUT_GET, 'event_id', 
            FILTER_VALIDATE_INT);
    if ($event_id == NULL || $event_id == FALSE) {
        $event_id = 1;
    }
}
// Get name for selected event
$queryEvent = 'SELECT * FROM events
                  WHERE eventID = :event_id';
$statement1 = $db->prepare($queryEvent);
$statement1->bindValue(':event_id', $event_id);
$statement1->execute();
$event = $statement1->fetch();
$event_name = $event['eventName'];
$statement1->closeCursor();


// Get all events
$query = 'SELECT * FROM events
                       ORDER BY eventID';
$statement = $db->prepare($query);
$statement->execute();
$events = $statement->fetchAll();
$statement->closeCursor();

// Get people attending for selected event
$queryPeopleAttending = 'SELECT * FROM peopleAttending
                  WHERE eventID = :event_id
                  ORDER BY peopleAttendingID';
$statement3 = $db->prepare($queryPeopleAttending);
$statement3->bindValue(':event_id', $event_id);
$statement3->execute();
$peopleAttending = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Newport Community Volunteering</title>
    
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
       <img src="logo.png" alt="Newport Community Volunteering"
            <!-- Logo made at https://logomakr.com/6k8vIP# -->
            <br>
            
            <a href="administrator.php">Administrator</a>
           
            <section>
            Newport Community Volunteering is a small home grown organization 
            of local residents in the Newport, North Carolina area who want to 
            help out in their free time.  We find people and events in need in 
            Carteret County and the neighboring counties that need help and 
            provide an easy platform for people to sign up and show up to help!
            
        </section>  
                
                <br>
                <dl>Recently Completed Community Events:
                <dt>Stray Round Up - October 15th</dt>   
                    <dd>Carteret County residents came together to find all
                        the animals without homes roaming the streets.  By the
                        end of the day, we had rescued ten animals in need and 
                        found them a home.
                        </dd>
                <dt>Feed the Homeless - September 10th</dt>    
                    <dd>It is unfortunate but there are people without homes
                        in Newport and the surrounding areas that cannot find
                        enough to eat.  With the help of all our volunteers, we
                        were able to put together a feast fit for a king.  No 
                        one went hungry that night.</dd>
                <dt>Build a shed - August 5th</dt>
                    <dd>For the inaugural kickoff of Newport Community 
                        Volunteering, residents came together to help a resident
                        in need.  John Lewis lost his shed with Hurricane Ann.  
                        After a full day of dedicated work, our volunteers were 
                        able to rebuild a bigger and better shed!</dd>
            </dl>
                
                <br>
                
            
            
            
            <header><h1>Upcoming Community Events that Need Help</h1></header>
            
            <h1>Event List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Event Description</th>
            <th>Event Date</th>
            <th>Event Time</th>
            <th>Event People Needed</th>
           
        </tr>        
        <?php foreach ($events as $event) : ?>
        <tr>
            <td><?php echo $event['eventName']; ?></td>
            <td><?php echo $event['eventDescription']; ?></td>
            <td><?php echo $event['eventDate']; ?></td>
            <td><?php echo $event['eventTime']; ?></td>
            <td><?php echo $event['eventPeopleNeeded']; ?></td>
           
        </tr>
        <?php endforeach; ?>    
    </table>
            
<main>
    <h1>Volunteer for an Event</h1>

    <aside>
        <!-- display a list of events -->
        <h2>Events</h2>
        <nav>
        <ul>
            <?php foreach ($events as $event) : ?>
            <li><a href=".?event_id=<?php echo $event['eventID']; ?>">
                    <?php echo $event['eventName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of people attending -->
        <h2><?php echo $event_name; ?></h2>
        <table>
            <tr>
                <th>People Attending</th>
                <th class="right"></th>

            </tr>

            <?php foreach ($peopleAttending as $peopleAttending) : ?>
            <tr>
                
                <td><?php echo $peopleAttending['name']; ?></td>
                
                <td><form action="delete_product.php" method="post">
                    <input type="hidden" name="peopleAttending_id"
                           value="<?php echo $peopleAttending['peopleAttendingID']; ?>">
                    <input type="hidden" name="event_id"
                           value="<?php echo $peopleAttending['eventID']; ?>">
                    <input type="submit" value="Remove">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_product_form.php">Join a Community Event</a></p>
              
    </section>
</main>
<footer>
    <p>Need help? Contact Jim George at <a href="tel:+1-252-867-5309">252-867-5309</a></p>
    
    <p>&copy; <?php echo date("Y"); ?> Newport Community Volunteering, Inc.</p>
</footer>
</body>
</html>