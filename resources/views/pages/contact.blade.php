@extends('layouts.main')

<link rel="stylesheet" href="{{ asset('style/contact.css') }}">

@section('content')
    <section class="section-contact">
        <div class="area-contact">
            <div class="contact-header">
                <h1 class="title-header">Contact Us</h1>
                <p class="desk-header">
                    Kami siap membantu apabila Anda memiliki pertanyaan
                    mengenai EventCrew, proses pendaftaran volunteer,
                    maupun informasi event.
                </p>
            </div>
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class='bx bx-envelope'></i>
                    </div>
                    <h4 class="text-card">Email</h4>
                    <p class="desk-card">eventcrew@gmail.com</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class='bx bx-phone'></i>
                    </div>
                    <h4 class="text-card">Telepon</h4>
                    <p class="desk-card">+62 812 3456 7890</p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class='bx bxl-whatsapp'></i>
                    </div>
                    <h4 class="text-card">WhatsApp</h4>
                    <p class="desk-card">Chat Admin EventCrew</p>
                </div>
            </div>
            <div class="contact-button">
                <a href="mailto:eventcrew@gmail.com" class="btn-contact dark">
                    <i class='bx bx-envelope'></i>
                    Kirim Email
                </a>
                <a href="https://wa.me/6281234567890" class="btn-contact green">
                    <i class='bx bxl-whatsapp'></i>
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </section>
@endsection
