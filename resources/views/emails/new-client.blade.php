@extends('emails.master')
@section('content')
<table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">
  <tbody><tr>
    <td class="padded" style="padding: 0;vertical-align: middle;padding-left: 56px;padding-right: 56px;word-break: break-word;word-wrap: break-word">

<h2 style="font-style: normal;font-weight: bold;Margin-bottom: 0;Margin-top: 0;font-size: 16px;line-height: 24px;font-family: Ubuntu,sans-serif;color: #3e4751">{{$name}}, There's a new client record on ClientApp &#8212; {{$client->name}}&nbsp;</h2><p class="font-cabin" style="font-style: normal;font-weight: 400;font-family: cabin,avenir,sans-serif;Margin-bottom: 22px;Margin-top: 16px;font-size: 13px;line-height: 22px;color: #7c7e7f">The record was crated just now, by {{$client->user->name}}</p>

    </td>
  </tr>
</tbody></table>
@endsection
