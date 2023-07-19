@extends('front.layouts.master')
@section('title', 'İletişim')
@section('bg',
    'https://img.freepik.com/premium-photo/website-internet-contact-us-page-concept-with-phone-chat-email-icons-symbol-telephone-mail-mobile-phone-website-page-contact-us-wide-web-banner-copy-space-blue-background_256259-2730.jpg')
@section('content')
    <div class="col-md-8">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Bizimle iletişime geçebilirsiniz.</p>
        <form method="post" action="{{ route('contact.post') }}">
            @csrf
            <div class="mb-3">
                <label for="pwd" class="form-label">Ad Soyad:</label>
                <input type="text" class="form-control" value="{{ old('name') }}" id="pwd" placeholder="Adınız ve soyadınızı giriniz"
                    name="name">
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="E-Postanızı giriniz" name="email">
            </div>

            <div class="mb-3 mt-3">
                <label for="konu" class="form-label">Konu:</label>
                <select name="topic" class="form-control" id="konu">
                    <option @if(old('topic')=="Bilgi") selected @endif>Bilgi</option>
                    <option @if(old('topic')=="Genel") selected @endif>Genel</option>
                    <option @if(old('topic')=="Destek") selected @endif>Destek</option>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="message" class="form-label">Mesaj:</label>
                <textarea name="message" id="message" rows="10" class="form-control">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <b>
                    İletişim Bilgileri:
                </b>
            </div>
            <div class="card-body">
                <b>Adres:</b><br> İstanbul <br>
                <b>Telefon Bilgileri:</b> <br> +905355977965 <br>
                <b>Mail Adresi:</b> <br> yigithangumuss@gmail.com <br>
            </div>
        </div>
    </div>
@endsection
