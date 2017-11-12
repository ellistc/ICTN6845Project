<?php
/* ICTN 6845 Final Project>

Copyright © <years> <Tim Ellis>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */
// Base code got from Murach's PHP and MySQL 2nd Edition by Joel Murrach and Ray Harris
// Get the people attending data data
$event_id = filter_input(INPUT_POST, 'event_id', FILTER_VALIDATE_INT);

$name = filter_input(INPUT_POST, 'name');


// Validate inputs
if ($event_id == null || $event_id == false ||
         $name == null) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the people attending data to the database  
    $query = 'INSERT INTO peopleAttending
                 (eventID, name)
              VALUES
                 (:event_id, :name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':event_id', $event_id);
   
    $statement->bindValue(':name', $name);
    
    $statement->execute();
    $statement->closeCursor();

    // Display the People Attending List page
    include('index.php');
}
?>