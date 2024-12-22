<?php

    //LOGICAL FUNCTIONS
    //TESTING FUNCTIONS
    //UI FUNCTIONS    
    //GLOBAL VARIABLES

    $CURDATE = date("Y-m-d");
    $CURTIME = date("H:i:s");
    $CURRENTTIMESTAMP = date("Y-m-d H:i:s");

    function jsonPrint($data, $label = 'PRINT') {
        echo $label.": <br /><br />";
        echo json_encode($data);
        echo "<br /><br />";
    }

    function getAPIResponse() {
        $responseData = new stdClass();
        $responseData->status = 500;
        $responseData->message = '';
        $responseData->data = null;
        return $responseData;
    }

    function generateReferenceNumber($prefix = '', $length = 8) {
        // Generate a unique ID based on the current time in microseconds
        $unique_id = uniqid($prefix, true);

        // Extract and concatenate specific parts of the unique ID for the reference number
        $reference_number = strtoupper(substr(md5($unique_id), 0, $length));

        return $reference_number;
    }

    function getElapsedTime($dateTime) {
        // Create DateTime objects for the given date and current time
        if($dateTime == "0000-00-00 00:00:00" || $dateTime == NULL) return '--';

        $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s", $dateTime );
        $dateTimeParsed = $new_datetime->format('Y-m-d H:i:s');

        $date = new DateTime($dateTimeParsed);
        $now = new DateTime();
        $interval = $now->diff($date);
        
        // Calculate the total elapsed time in different units
        $seconds = $interval->s;
        $minutes = $interval->i;
        $hours = $interval->h;
        $days = $interval->days;
        $months = $interval->m;
        $years = $interval->y;

        if ($years > 0) {
            return $years . ' year' . ($years > 1 ? 's' : '') . ' ago';
        }
        if ($months > 0) {
            return $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
        }
        if ($days > 0) {
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        }
        if ($hours > 0) {
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        }
        if ($minutes > 0) {
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        }
        if ($seconds > 0) {
            return $seconds . ' second' . ($seconds > 1 ? 's' : '') . ' ago';
        }

        return 'a moment ago'; // For cases where the interval is less than a second
    }

    function dateFromFormat($inputDate, $format = 'Y-m-d') {
        if($inputDate == "0000-00-00 00:00:00" || $inputDate == '' || $inputDate == null) return '--';
        $new_datetime = DateTime::createFromFormat ( 'Y-m-d', $inputDate );
        return $new_datetime->format($format); 
    }

    function dateTimeFromFormat($inputDate, $format = 'Y-m-d H:i:s') {
        if($inputDate == "0000-00-00 00:00:00"|| $inputDate == null) return '--';
        $new_datetime = DateTime::createFromFormat ( 'Y-m-d H:i:s', $inputDate );
        return $new_datetime->format($format); 
    }

    function getFileUrl($str) {
        $path = getcwd();
        return $path;
    }

    function getQueryFromObjects($obj1, $obj2, $customExceptions = []) {
        
        $exceptions = array_merge(["id"], $customExceptions);
        $res = "";
        $index = 0;

        foreach ($obj1 as $key => $value) {
            if(isset($obj2[$key]) && !in_array($key, $exceptions)){
                $res .= "`".$key."` = ";
                $newvalue = isset($value) ? $value : $obj2[$key];
                $res .= is_integer($newvalue) ? $newvalue : "'".$newvalue."'";
                if($index < count($obj1) - 1){
                    $res .= ",";
                }
            }
            $index += 1;
        }
        return $res;
    }
    
    function getQueryParamsFormObjects($obj1, $obj2, $customExceptions = []) {
        $exceptions = array_merge(["id"], $customExceptions); // Merge default and custom exceptions
        $queryParts = [];
        $params = [];
    
        foreach ($obj1 as $key => $value) {
            if (isset($obj2[$key]) && !in_array($key, $exceptions)) {
                $queryParts[] = "`".$key."` = ?";
                $params[] = $value ?? $obj2[$key]; // Use $value from $obj1 or fallback to $obj2
            }
        }
    
        $query = implode(", ", $queryParts); // Combine query parts with commas
        return [
            "query" => $query,
            "params" => $params
        ];
    }


?>