@extends('emails.layout')

@section('content')
<table class="row" align="center" bgcolor="#F4F4F4" cellpadding="0">
  <tr>
    <td class="spacer" height="40" style="font-size: 40px; line-height: 40px; mso-line-height-rule: exactly;">&nbsp;</td>
  </tr>
  <tr valign="top" style="vertical-align: top;">
    <th class="column mobile-12" width="640" style="padding-left: 30px; padding-right: 30px; color: #232323; font-weight: 400; text-align: left;">
      <div style="font-size: 28px; font-weight: 700; line-height: 30px; margin-bottom: 30px;">Dear {{ $admin->name }},</div>
      <div style="color: #666666; font-size: 18px;">Here is the submit data from Tanya Produk :</div>
    </th>
  </tr>
</table>

<table class="row" align="center" bgcolor="#F4F4F4" cellpadding="0">
  <tr>
    <td class="spacer" colspan="2" height="40" style="font-size: 40px; line-height: 40px; mso-line-height-rule: exactly;">&nbsp;</td>
  </tr>
  <tr valign="top" style="vertical-align: top;">
    <th class="column mobile-12 mobile-padding-bottom" width="100%" style="padding-left: 30px; padding-right: 10px; color: #232323; font-weight: 400; text-align: left;">
      <div style="color: #666666; font-size: 15px;">
        @foreach($model as $key => $row)
            @if($key !== 'subject' && $key !== '_token')
                {{ ucwords(str_replace("_"," ",$key)).' : '.$row }}<br/>
            @endif
        @endforeach
      </div>
    </th>
  </tr>
  <tr>
    <td class="spacer" colspan="2" height="40" style="font-size: 40px; line-height: 40px; mso-line-height-rule: exactly;">&nbsp;</td>
  </tr>
</table>
@endsection
