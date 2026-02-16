<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body>

<div style="background-color:#f3f5f7;margin:0!important;padding:0!important">


        <table border="0" cellpadding="0" cellspacing="0" width="100%">

            <tbody><tr>
                <td align="center">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
                        <tbody><tr>
                            <td align="center" valign="top" style="padding:40px 10px 10px 10px">
                                <a href="#m_6772889176826120015_" style="text-decoration:none">
        							<span style="display:block;font-family:Poppins,sans-serif;color:#3e8ef7;font-size:36px" border="0">
        							    <img src="https://kingvikingrecords.com/public/assets/frontend/img/king-viking-logo.jpg" width="300px" class="CToWUd" data-bit="iit">
        							</span>
                                </a>
                            </td>
                        </tr>
                    </tbody></table>

                </td>
            </tr>

            <tr>
                <td align="center" style="padding:0px 10px 0px 10px">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
                        <tbody><tr>
                            <td bgcolor="#ffffff" align="center" valign="top" style="padding:10px 20px 20px 20px;border-radius:4px 4px 0px 0px">
                              <h1 style="font-size:36px;font-weight:600;margin:0;font-family:Poppins,sans-serif;text-transform:capitalize;text-align:center">Welcome to {{ env('APP_NAME') }}
</h1>
                            </td>
                        </tr>
                    </tbody></table>

                </td>
            </tr>

            <tr>
                <td align="center" style="padding:0px 10px 0px 10px">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">

                      <tbody>
                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding:0px 30px 20px 30px;color:#666666;font-family:sans-serif;font-size:16px;font-weight:400;line-height:25px">
                          <p style="margin:0;color:#161414"><strong style="text-transform:capitalize;font-family:sans-serif">Contact Person Details</strong>
							<br> Email - <a href="mailto:{{ $data['email'] }}" target="_blank">{{ $data['email'] }}</a>
							<br> Phone - <a href="tel:{{ $data['phone'] }}" target="_blank">{{ $data['phone'] }}</a>
							<br> Subject - {{ $data['subject'] }}
							<br> IP Address - {{ $data['ip_address'] }}
							<br> MAC Address - {{ $data['mac_address'] }}
							<br> Device - {{ $data['device'] }}
							<br> Message -
						  </p>
						  <p>{{ $data['message'] }}</p>
                        </td>
                      </tr>

                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding:0px 30px 40px 30px;border-radius:0px 0px 0px 0px;color:#666666;font-family:Poppins,sans-serif;font-size:14px;font-weight:400;line-height:25px">
                          <p style="margin:0">Cheers,<br>{{ env('APP_NAME') }} Team</p>
                        </td>
                      </tr>
                    </tbody></table>

                </td>
            </tr>

            <tr>
                <td align="center" style="padding:10px 10px 50px 10px">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">

                      <tbody><tr style="display:none">
                        <td bgcolor="#ffffff" align="left" style="padding:30px 30px 30px 30px;color:#aaaaaa;font-family:Poppins,sans-serif;font-size:12px;font-weight:400;line-height:18px">
                          <p style="margin:0">
                            <a href="#m_6772889176826120015_" style="color:#999999;font-weight:700">Music Tracks</a> -
                            <a href="#m_6772889176826120015_" style="color:#999999;font-weight:700">About</a> -
                            <a href="#m_6772889176826120015_" style="color:#999999;font-weight:700">Contact Us</a>
                          </p>
                        </td>
                      </tr>

                      <tr>
                        <td bgcolor="#ffffff" align="left" style="padding:0px 30px 30px 30px;color:#aaaaaa;font-family:Poppins,sans-serif;font-size:12px;font-weight:400;line-height:18px">
                          <p style="margin:0">You received this email because you just
messaged us. If it looks weird, check it out in
your browser..</p>
                          <p style="margin:0;color:#b37b16">We stay in the Cutting edge of
integrity Of the Word of God in families who
commit to autism breakthrough.</p>
                        </td>
                      </tr>



                      <tr>
                        <td align="center" style="padding:30px 30px 30px 30px;color:#333333;font-family:Poppins,sans-serif;font-size:12px;font-weight:400;line-height:18px">
                          <p style="margin:0">Copyright © {{ date('Y') }} <a href="{{ env('APP_URL') }}" target="_blank">{{ env('APP_NAME') }}</a> All Rights
Reserved.</p>
                          <p style="margin:0;text-align:center">When it is a good thing,
keep it in your mind.</p>
                        </td>
                      </tr>
                    </tbody></table>

                </td>
            </tr>
        </tbody></table>

        </div>

</body>
</html>


