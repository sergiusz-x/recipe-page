<?php
    function get_zdjecia_przepisu($conn, $id_przepisu, $tylko_pierwsze_zdjecie) {
        $query = "SELECT * FROM images WHERE przepis_id = $id_przepisu";
        $result = $conn->query($query);
        $zdjecia_list = array();
        //
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $zdjecia_list[] = $row['data'];
            }
        }
        //
        if(empty($zdjecia_list)) {
            $zdjecia_list[] = "../images/dummy.png";
        }
        //
        if($tylko_pierwsze_zdjecie) {
            return $zdjecia_list[0];
        } else {
            return $zdjecia_list;
        }
       
    }
?>