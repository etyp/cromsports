<?php
include_once '../config/config.php';

class DbDriver {
    /*
     * Properties
     */

    // Connected property for opening/closing mysql connection
    public $connected = false;
    // Db link
    public $conn = false;



    /*
     * Functions
     */

    // Db connect function
    public function dbConnect() {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno()) {
            die('Could not connect: ' . mysqli_error($conn));
        }
        // Set link for later access
        $this->conn = $conn;
        // Set connected to true
        $this->connected = true;

        return $conn;
    }

    public function dbClose() {
        if ($this->conn) {
            mysqli_close($this->conn);
            $this->conn = false;
            $this->connected = false;
        }
    }

    /*
     * Querying functions
     */

    public function getAll($tableName = false, $columns = "*", $asArray = true) {
        if ($tableName) {
            // Connect to db
            $conn = $this->dbConnect();

            // Check columns
            if ($columns != "*") {
                if (is_array($columns)) {
                    $colString = implode(",", $columns);
                }
                else {
                    $colString = "*";
                }
            }
            else {
                $colString = "*";
            }


            // Build query
            $query = "
            SELECT $colString FROM $tableName ORDER BY DEFENSIVE_TOTAL_TACKLES DESC LIMIT 10;
            ";

            // Query db
            $results = mysqli_query($conn, $query);

            // Data array
            $resultsArray = array();

            // Html output
            $output = "";

            while ($row = mysqli_fetch_array($results)) {
                // If asArray, return array
                if ($asArray) {
                    $resultsArray[] = $row;
                }
                else {
                    // TODO figure something out here ??
                    //$output .= $row["name"] . "<br>";
                }
            }

            // Disconnect from db
            $this->dbClose();

            // Return results
            if($asArray){
                return $resultsArray;
            }
            else {
                return $output;
            }
        }
    }
}



?>