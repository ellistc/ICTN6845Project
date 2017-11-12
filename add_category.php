<?php
/* ICTN 6845 Final Project>

Copyright © <years> <Tim Ellis>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */

// Base code got from Murach's PHP and MySQL 2nd Edition by Joel Murrach and Ray Harris
// Get the category data
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');
$date = filter_input(INPUT_POST, 'date');
$time = filter_input(INPUT_POST, 'time');
$people_needed = filter_input(INPUT_POST, 'people_needed');

// Validate inputs
if ($name == null) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'INSERT INTO events (eventName, eventDescription, eventDate, eventTime, eventPeopleNeeded)
              VALUES (:event_name, :event_description, :event_date, :event_time, :event_people_needed)';
    //add more values above for an insert.

    $statement = $db->prepare($query);
    $statement->bindValue(':event_name', $name);
    $statement->bindValue(':event_description', $description);
    $statement->bindValue(':event_date', $date);
    $statement->bindValue(':event_time', $time);
    $statement->bindValue(':event_people_needed', $people_needed);
    //bind more values above for the insert values

    $statement->execute();
    $statement->closeCursor();

    // Display the Event List page
    include('administrator.php');
}
?>