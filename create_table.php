<?php
require "connect_db.php";

    $sql = "CREATE TABLE IF NOT EXISTS products (
              id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              name varchar(128) NOT NULL,
              description text NOT NULL,
              price double NOT NULL,
              photo varchar(30) NOT NULL,
              created datetime NOT NULL,
              modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table User created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
    
    $conn->close();
    
    ?>
