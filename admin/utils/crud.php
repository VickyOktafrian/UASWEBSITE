<?php
// Create
function createRecord($query, $params) {
    global $conn;
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }
    bindParams($stmt, $params);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Read
function readRecords($query, $params = []) {
    global $conn;
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }
    if (!empty($params)) {
        bindParams($stmt, $params);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $data;
}

// Update
function updateRecord($query, $params) {
    global $conn;
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }
    bindParams($stmt, $params);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Delete
function deleteRecord($query, $params) {
    global $conn;
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt === false) {
        die("Prepare failed: " . mysqli_error($conn));
    }
    bindParams($stmt, $params);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Helper function to bind parameters
function bindParams($stmt, $params) {
    if ($params) {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_double($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            } else {
                $types .= 'b';
            }
        }
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
}
?>
