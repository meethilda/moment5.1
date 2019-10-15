<?php
class Course {
    // Tablename
    private $table_name = 'courses';
    // Save connection
    private $conn;

    // Variables for courses
    public $id;
    public $code;
    public $name;
    public $progression;
    public $courseplan;
    public $added;

    // Create connection to database
    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    // Output all courses
    function read() {
        $query = "SELECT
            `id`, `code`, `name`, `progression`, `courseplan`, `added`
        FROM
            " . $this->table_name . "
        ORDER BY
            added ASC";

        if(!empty($this->id)) {
            $query = "SELECT
            `id`, `code`, `name`, `progression`, `courseplan`, `added`
        FROM
            " . $this->table_name . "
        WHERE
            id=" . $this->id . "
        ORDER BY
            added ASC";
        }

    $result = mysqli_query($this->conn, $query);
    return $result;
    }

    // Add course
    function create() {
        $query = "INSERT INTO
            `courses`(`code`, `name`, `progression`, `courseplan`, `added`)
        VALUES
            ('" . $this->code . "', '" . $this->name . "', '" . $this->progression . "', '" . $this->courseplan . "', '" . $this->added . "')";

        $result = mysqli_query($this->conn, $query);
        if($result) {
            $query = "SELECT
                id, code, name, progression, courseplan, added
            FROM
                " . $this->table_name;
            $result = mysqli_query($this->conn, $query);
        }
        return $result;
    }

    // Delete course
    function delete() {
        $query = "DELETE FROM
                `courses`
            WHERE
                id=" . $this->id;

        $result = mysqli_query($this->conn, $query);
        if($result) {
            $query = "SELECT
                id, code, name, progression, courseplan, added
            FROM
                " . $this->table_name;
            $result = mysqli_query($this->conn, $query);
        }
        return $result;
    }

    function update() {
        $query = "UPDATE
                `courses`
            SET
                `code`='" . $this->code . "',
                `name`='" . $this->name . "',
                `progression`='" . $this->progression . "',
                `courseplan`='" . $this->courseplan . "'
            WHERE
                id=" . $this->id;

        $result = mysqli_query($this->conn, $query);
        if($result) {
            $query = "SELECT
                id, code, name, progression, courseplan, added
            FROM
                " . $this->table_name;
            $result = mysqli_query($this->conn, $query);
        }
        return $result;
    }
}