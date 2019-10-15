<?php
//
// Curl request:
//  curl -i -X GET
//
//
//
//
//
//
//
//
//
//
//
//

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

if($request[0] != 'course') {
    http_response_code(404);
    exit;
}

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include files
include_once 'config/database.php';
include_once 'classes/courses.php';

// Instance class object
$course = new Course($db_conn);

// HTTP method of GET, POST, PUT and DELETE
switch($method) {
    case 'GET':
        // Code for GET
        if(isset($request[1])) $course->id = $request[1];
        $result = $course->read();
        break;
    case 'POST':
        // Code for POST
        $courseCode = $input['code'];
        $courseName = $input['name'];
        $courseProg = $input['progression'];
        if(!empty($input['courseplan'])) {
        $coursePlan = $input['courseplan'];
        } else {
            $coursePlan = '';
        }

        if(
            !empty($courseCode) &&
            !empty($courseName) &&
            !empty($courseProg)
        ) {
                $course->code = $courseCode;
                $course->name = $courseName;
                $course->progression = $courseProg;
                $course->courseplan = $coursePlan;
                $course->added = date('Y-m-d H:i:s');
            }

        $result = $course->create();
        break;
    case 'PUT':
        // Code for PUT
        if(isset($request[1])) $course->id = $request[1];
        $courseCode = $input['code'];
        $courseName = $input['name'];
        $courseProg = $input['progression'];
        if(!empty($input['courseplan'])) {
        $coursePlan = $input['courseplan'];
        } else {
            $coursePlan = '';
        }

        if(
            !empty($courseCode) &&
            !empty($courseName) &&
            !empty($courseProg)
        ) {
                $course->code = $courseCode;
                $course->name = $courseName;
                $course->progression = $courseProg;
                $course->courseplan = $coursePlan;
                $course->added = date('Y-m-d H:i:s');
            }
        $result = $course->update();
        break;
    case 'DELETE':
        // Code for DELETE
        if(isset($request[1])) $course->id = $request[1];
        $result = $course->delete();
        break;
}

// Create course array
$courseArr = [];
// Fetch objects
if($result) {
    while ($row = $result->fetch_assoc()) {
        // Create name to variable
        extract($row);
        // Create array for each item
        $courseItem = [
            'id' => $id,
            "name" => ucfirst($name),
            'code' => strtoupper($code),
            'progression' => strtoupper($progression),
            'courseplan' => $courseplan,
            'added' => $added
        ];
        // Push courseItem to courseArr
        array_push($courseArr, $courseItem);
    }
    // OK response = 200
    http_response_code(200);

    // Output JSON
    echo json_encode($courseArr);
} else {
    // Add error response code
    http_response_code(404);

    // If no items found
    echo json_encode(
        ['message' => 'No objects found']
    );
}