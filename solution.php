<?php

function cmp($a, $b){
    // sorting by ending times of each presentation
    return $a[1] - $b[1];
}

function maxEvents($arrival, $duration) {
    $presentationsCount = count($arrival);
    $doesnt_fit = 0;
    $timetable = array();

    for ($i = 0; $i < $presentationsCount; $i++){
        // building an associative array of presentations by time intervals
        $timetable[] = [$arrival[$i], $arrival[$i] + $duration[$i]];
    }

    // sorting the timetable by endtimes
    usort($timetable, "cmp");

    // determining the end time of first presentation
    $endTime = $timetable[0][1];

    for ($i = 1; $i < $presentationsCount; $i++){
        // if endtime of presentation is before the current end time position,
        // then that presentation does not fit into the schedule. otherwise,
        // updating the end time by the time of presentation
        ($timetable[$i][0] < $endTime) ? $doesnt_fit++ : $endTime = $timetable[$i][1];
    }

    // deducting number of unfitting presentations from total count
    return $presentationsCount - $doesnt_fit;

}

print_r(maxEvents([1, 3, 3, 5, 7], [2, 2, 1, 2, 1])); // 4
print_r(maxEvents([1, 2], [7, 3])); // 1
