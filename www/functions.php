<?php

function dbConnect() {
    $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
}


class DbDriver {
    /*
     * Properties
     */

    // Connected property for opening/closing mysql connection
    public $connected = false;
    // Db link
    public $link = false;



    /*
     * Functions
     */

    // Db connect function
    public function dbConnect() {
        $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        if (!$link) {
            die('Could not connect: ' . mysql_error());
        }
        // Set link for later access
        $this->link = $link;
        // Set connected to true
        $this->connected = true;

        return $link;
    }

    public function dbClose() {
        if ($this->link) {
            mysql_close($this->link);
            $this->link = false;
            $this->connected = false;
        }
    }
}

?>