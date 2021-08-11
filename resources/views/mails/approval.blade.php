<!DOCTYPE html>
<html>
<head>
	<title>XM Fitri Mail</title>
</head>
<body>
   
<center>
<h2 style="padding: 23px;background: #7adbf5;border-bottom: 6px #15aad2 solid; color: white;">
        Approval Status of Your Schedule
</h2>
</center>

<p><strong>Hi, {{ $data['user_name'] }}</strong></p>

@if ($data['is_approved'] == 2)
<p>Booking jadwal dengan Guru {{$data['guru_name']}} telah disetujui! Berikut jadwal anda:</p>
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
<p>Silahkan buka dashboard Anda dan simpan jadwal tersebut. Jangan sampai terlewat yaa!</p>
@endif

@if ($data['is_approved'] == 3)
<p>Mohon maaf, booking jadwal dengan Guru {{$data['guru_name']}} tidak disetujui. Berikut alasan yang diberikan:</p>
<table style="width: 100%;">
  <tbody>
    <tr>
      <td width="15%">Alasan</td>
      <td>:</td>
      <td>{{ $data['approved_reason'] }}</td>
    </tr>
  </tbody>
</table>
<p>Silahkan kembali ke dashboard Anda dan pilih kembali jadwal Anda.</p>
@endif

<br/>
<p>Terimakasih.</p>
  
<strong>Best regards, XM Fitri.</strong>
  
</body>
</html>