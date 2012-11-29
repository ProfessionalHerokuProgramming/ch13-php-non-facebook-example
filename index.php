<?php

    // Creates the connection string for our Postgres DB using DATABASE_URL
    extract(parse_url($_ENV["DATABASE_URL"]));
    $pg_conn = "user=$user password=$pass host=$host dbname=" . substr($path, 1) . 
        " sslmode=require";
    $db = pg_connect($pg_conn);
    
    // Get all employee records
    $result = pg_query($db, "SELECT * FROM employees");

?>
<html>
    <head>
        <title>Employee List</title>
    </head>
    <body>

        <h1>Employee List</h1>
        
        <table>
            <tr>
                <th>Employee Id</th>
                <th>Name</th>
                <th>E-mail Address</th>
            </tr>
<?php


    // Go through each record returned
    while ($row = pg_fetch_row($result)) { 
        print "<tr>\n";
        print "<td>" . $row[0] . "</td>\n"; 
        print "<td>" . $row[1] . "</td>\n"; 
        print "<td>" . $row[2] . "</td>\n"; 
        print "</tr>\n";
    }

?>
        </table>
    </body>
</html>