<div style="color: blue">
    Dear {{$user['name']}},<br><br>
    Your Payment invoice for {{$user['invoice']['billing_method'] == 1 ? $user['invoice']['invoice_month'] : $user['invoice']['invoice_date']}}
</div>