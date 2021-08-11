<!DOCTYPE html>
<html>
<head>
	<title>XM Fitri Mail</title>
</head>
<body>
   
<center>
<h2 style="padding: 23px;background: #7adbf5;border-bottom: 6px #15aad2 solid; color: white;">
        New Booking Schedule
</h2>
</center>

<p><strong>Hi, {{ $data['guru_name'] }}</strong></p>
<p>Booking jadwal dari {{$data['user_name']}} telah masuk ke dalam list jadwal Anda dengan detail sebagai berikut:</p>
<table style="width: 100%;">
  <tbody>
    <tr>
      <td width="15%">Tanggal</td>
      <td>:</td>
      <td>{{ $data['schedule_date'] }}</td>
    </tr>
    <tr>
      <td>Waktu</td>
      <td>:</td>
      <td>{{ $data['schedule_time'] }}</td>
    </tr>
  </tbody>
</table>
<p>Silahkan buka dashboard Anda untuk menyetujui jadwal tersebut atau tidak.</p>

<br/>
<p>Terimakasih.</p>
  
<strong>Best regards, XM Fitri.</strong>
  
</body>
</html>