<?php
/* ICTN 6845 Final Project>

Copyright © <years> <Tim Ellis>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */
// Base code got from Murach's PHP and MySQL 2nd Edition by Joel Murrach and Ray Harris
require_once('database.php');

// Get IDs
$peopleAttending_id = filter_input(INPUT_POST, 'peopleAttending_id', FILTER_VALIDATE_INT);
$event_id = filter_input(INPUT_POST, 'event_id', FILTER_VALIDATE_INT);

// Delete the people attending from the database
if ($peopleAttending_id != false && $event_id != false) {
    $query = 'DELETE FROM peopleAttending
              WHERE peopleAttendingID = :peopleAttending_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':peopleAttending_id', $peopleAttending_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the People Attending List page
include('index.php');