<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body dir="rtl" style="text-align: right">
<p>
זוהי תזכורת להזמנת רכבת בתאריך:
</p>
<p>
{{ \Carbon\Carbon::parse($orderedTime->departure_time_israel)->format('d/m/Y H:i:s') }}
</p>
<p>ההזמנה נפתחת עכשיו</p>
<p>להזמנת השובר באתר רכבת ישראל לחץ כאן</p>
<a href="https://www.rail.co.il/" target="_blank"></a>
</body>
</html>
