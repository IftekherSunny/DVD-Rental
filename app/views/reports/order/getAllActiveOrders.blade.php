<?php use SunHelperClass\config; use SunHelperClass\DateFormat;?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>

    <style>
    *{
    margin: 0px; padding: 0px   }

        body {
            background-color: #fff;
           /* width: 98%;
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-family: Arial, Helvetica, sans-serif;*/
             color: #333;
              font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
              font-size: 12px;
              line-height: 1.42857;
            }

        .container {
            border: 1px solid #fff;
            background-color: #fff;
        }

        .header{            
            text-align: center;
            background-color: #fff;
            overflow: hidden;
        }
        .header b {            
            font-size: 25px;
            line-height: 1.5;
            font-weight: 400;
        }

        .content {
           
        }

        .top {
            overflow: hidden;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
        }

        .left {
            float:left;
            overflow: hidden;
        }

        .right {
            float:right;
            overflow: hidden;
        }

        .right p, .left p {
            font-size: 1.2em;
            font-weight: bold;
            line-height: 1;
        }

        #customers {
            width: 100%;
            border-collapse: collapse;white-space:nowrap;
        }

        #customers td {
            font-size: 12px;
            border: 1px solid #ddd;
            padding: 5px;
        } 

        #customers th {
            border: 1px solid #ddd;
            border-bottom: 2px solid #ddd;
            padding: 5px;
            font-size: 12px;
            text-align: left;
            background: #fff;
            color: #333;
        }

        tr:nth-child(odd) {background: #fff}
        tr:nth-child(even) {background: #f9f9f9}
        @page { margin: 30px 20px !important; }
         .pagenum:before { content: counter(page); }
</style></head>
<body>
      <div class="container">
        
        <div class="top">
          <div class="header">
            <b> {{ $title }} </b>
            <p><?php date_default_timezone_set(config::$timezone);echo date("l, F j, Y, h:i A");  ?></p>   
          </div>
        </div>
        
        <div class="content">
            <table id="customers">
              <thead>
                <tr>
                  <th>#ID</th>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Movie Name</th>
                <th>From</th>
                <th>To</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($orders as $order)
                  <?php $statusActive = $order->status ?>
                  @if($statusActive)
                  <tr>
                    <td>ORD-{{ $order->id }}</td>
                    <td>MEM-{{ $order->member_id }}</td>
                    <td>{{ $order->member->first_name }} {{ $order->member->last_name }}</td>
                    <td>{{ $order->movie->name }}</td>
                    <td>{{ DateFormat::show($order->from) }}</td>
                    <td>{{ DateFormat::show($order->to) }}</td>
                    <td>EMP-{{ $order->employee_id }}</td>
                    <td>{{ $order->employee->first_name }} {{ $order->employee->last_name }}</td>
                  </tr> 
                  @endif  
              @endforeach        
              </tbody>
            </table>
        </div>
      </div>
    
<script type="text/php">
if ( isset($pdf) ) {
  $font = Font_Metrics::get_font("verdana", "bold");
  $pdf->page_text(20,825, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 7, array(0,0,0));
  $pdf->page_text(485,825, "Developed by Iftekher Sunny", $font, 7, array(0,0,0));
}
</script>
</body>
</html>