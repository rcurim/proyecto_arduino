<?php
class Ph_List
{

    // database connection and table name
    private $conn;
    private $table_name = "ph_list";

    // object properties
    public $id;
    public $value;
    public $category_id;
    public $category_desc;
    public $creation_date;
    private $categories_arr;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
        //Leemos el JSON
        $categories_string = file_get_contents(__DIR__ . "\\intervals.json");
        //json_decode receive as input a string and return a json value (arrays, etc) 
        $this->categories_arr = json_decode($categories_string, true);
        /*
        $this->categories_arr = array();
        array_push($this->categories_arr, array('high' => 3.99, 'low' => 0.00, 'category_id' => 1));
        array_push($this->categories_arr, array('high' => 5.99, 'low' => 4.00, 'category_id' => 2));
        array_push($this->categories_arr, array('high' => 7.99, 'low' => 6.00, 'category_id' => 3));
        array_push($this->categories_arr, array('high' => 20.00, 'low' => 8.00, 'category_id' => 4));
        */
    }

    // search products
    function search($keywords)
    {

        // select all query
        $query = "SELECT
                    c.description as category_desc, p.id, p.value, p.category_id, p.creation_date
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        ph_categories c
                            ON p.category_id = c.id
                WHERE
                    p.value LIKE ? OR c.description LIKE ?
                ORDER BY
                    p.creation_date DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function searchById()
    {
        // query to read single record
        $query = "SELECT * FROM
                    " . $this->table_name . " p
                WHERE
                    p.id = ?
                LIMIT
                    0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();
        //if there is a record then return true
        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }

    // read products
    function read()
    {

        // select all query
        $query = "SELECT
                    c.description as category_desc, p.id, p.value, p.category_id, p.creation_date
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        ph_categories c
                            ON p.category_id = c.id
                ORDER BY
                    p.creation_date DESC
                LIMIT
                    10";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read products
    function readToPdf()
    {

        // select all query
        $query = "SELECT
                    c.description as category_desc, p.id, p.value, p.category_id, p.creation_date
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        ph_categories c
                            ON p.category_id = c.id
                ORDER BY
                    p.creation_date DESC
                LIMIT
                    30";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // used when filling up the update product form
    function readOne()
    {

        // query to read single record
        $query = "SELECT
                    c.description as category_desc, p.id, p.value, p.category_id, p.creation_date
                FROM
                    " . $this->table_name . " p
                    LEFT JOIN
                        ph_categories c
                            ON p.category_id = c.id
                WHERE
                    p.id = ?
                LIMIT
                    0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties

        $this->value = $row['value'];
        $this->category_id = $row['category_id'];
        $this->category_desc = $row['category_desc'];
        $this->creation_date = $row['creation_date'];
    }


    // create product
    function create()
    {

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . "( value, creation_date ,category_id )
                VALUES
                    ( :value, current_timestamp ,:category_id )";

        // prepare query
        $stmt = $this->conn->prepare($query);
        if( !isset($this->category_id) ) {
            $this->setCategory($this->value);
        }

        // sanitize "desinfectar"
        $this->value = htmlspecialchars(strip_tags($this->value));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // bind values
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":category_id", $this->category_id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    private function setCategory($nvalue)
    {
        if (isset($nvalue)) {
            foreach ($this->categories_arr as $categ) {
                //to access to one data of a wiki, you must use ['field'], it's safe.
                if ($categ['low'] <= $nvalue &&  $nvalue < $categ['high']) { 
                    $this->category_id = $categ['category_id'];
                    return;
                }
            }
        }
    }
}
