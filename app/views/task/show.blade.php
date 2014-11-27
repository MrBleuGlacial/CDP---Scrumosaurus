@extends('layouts.master')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <li class="active">{{ $task->name }}</li>
    </ol>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 col-md-4 ">
                <dl class="dl-horizontal">
                    <dt>Nom</dt>
                    <dd>{{ $task->name }}</dd>
                    <dt>Description</dt>
                    <dd>{{ $task->description }}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>Commencé il y a</dt>
                    <dd>
                        <?php
                         // Set timezone
                          date_default_timezone_set("UTC");

                          // Time format is UNIX timestamp or
                          // PHP strtotime compatible strings
                          function dateDiff($time1, $time2, $precision = 6) {
                            // If not numeric then convert texts to unix timestamps
                            if (!is_int($time1)) {
                              $time1 = strtotime($time1);
                            }
                            if (!is_int($time2)) {
                              $time2 = strtotime($time2);
                            }

                            // If time1 is bigger than time2
                            // Then swap time1 and time2
                            if ($time1 > $time2) {
                              $ttime = $time1;
                              $time1 = $time2;
                              $time2 = $ttime;
                            }

                            // Set up intervals and diffs arrays
                            $intervals = array('year','month','day','hour','minute');
                            $diffs = array();

                            // Loop thru all intervals
                            foreach ($intervals as $interval) {
                              // Create temp time from time1 and interval
                              $ttime = strtotime('+1 ' . $interval, $time1);
                              // Set initial values
                              $add = 1;
                              $looped = 0;
                              // Loop until temp time is smaller than time2
                              while ($time2 >= $ttime) {
                                // Create new temp time from time1 and interval
                                $add++;
                                $ttime = strtotime("+" . $add . " " . $interval, $time1);
                                $looped++;
                              }

                              $time1 = strtotime("+" . $looped . " " . $interval, $time1);
                              $diffs[$interval] = $looped;
                            }

                            $count = 0;
                            $times = array();
                            // Loop thru all diffs
                            foreach ($diffs as $interval => $value) {
                              // Break if we have needed precission
                              if ($count >= $precision) {
                            break;
                              }
                              // Add value and interval
                              // if value is bigger than 0
                              if ($value > 0) {
                            // Add s if value is not 1
                            if ($value != 1) {
                              $interval .= "s";
                            }
                            // Add value and interval to times array
                            $times[] = $value . " " . $interval;
                            $count++;
                              }
                            }

                            // Return string with times
                            return implode(", ", $times);
                          }

                        echo dateDiff("now", $task->start);

                        ?>
                    </dd>
                </dl>
            </div>
            <div class="col-sm-5 col-md-5">
                <p>

                </p>
            </div>
        </div>
    </div>


@stop
