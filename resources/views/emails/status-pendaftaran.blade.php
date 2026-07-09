<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Status Pendaftaran Volunteer</title>
</head>

<body style="margin:0;padding:30px;background:#f5f5f5;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:18px;overflow:hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="background:#FFD54F;padding:30px;text-align:center;">
                            <h1 style="margin:0;color:#222;font-size:30px;">
                                Event<span style="color:#7A3E3E;">Crew</span>
                            </h1>

                            <p style="margin-top:10px;color:#555;">
                                Sistem Manajemen Volunteer Event
                            </p>
                        </td>
                    </tr>

                    {{-- Content --}}
                    <tr>
                        <td style="padding:40px;">

                            <h2 style="margin-top:0;color:#222;">
                                Halo,
                                {{ $pendaftaran->volunteer->nama_lengkap }}
                            </h2>

                            <p style="font-size:15px;color:#555;line-height:28px;">
                                Terima kasih telah mendaftar sebagai volunteer di EventCrew.
                                Berikut adalah status terbaru dari pendaftaran Anda.
                            </p>

                            <table width="100%" cellpadding="12"
                                style="margin-top:25px;border-collapse:collapse;background:#fafafa;border-radius:12px;">

                                <tr>
                                    <td width="180"><strong>Event</strong></td>
                                    <td>{{ $pendaftaran->event->nama_event }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Divisi</strong></td>
                                    <td>{{ $pendaftaran->divisi->nama_divisi }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>

                                        @if ($pendaftaran->status_pendaftaran == 'diterima')
                                            <span
                                                style="background:#d1fae5;color:#065f46;padding:8px 18px;border-radius:30px;font-weight:bold;">
                                                ✅ DITERIMA
                                            </span>
                                        @elseif ($pendaftaran->status_pendaftaran == 'ditolak')
                                            <span
                                                style="background:#fee2e2;color:#991b1b;padding:8px 18px;border-radius:30px;font-weight:bold;">
                                                ❌ DITOLAK
                                            </span>
                                        @else
                                            <span
                                                style="background:#fef3c7;color:#92400e;padding:8px 18px;border-radius:30px;font-weight:bold;">
                                                ⏳ MENUNGGU
                                            </span>
                                        @endif

                                    </td>
                                </tr>

                            </table>

                            @if ($pendaftaran->status_pendaftaran == 'diterima')
                                <div
                                    style="margin-top:35px;background:#ECFDF5;padding:20px;border-left:6px solid #10B981;border-radius:8px;">

                                    <h3 style="margin-top:0;color:#065F46;">
                                        🎉 Selamat!
                                    </h3>

                                    <p style="margin:0;color:#444;line-height:28px;">
                                        Pendaftaran Anda telah <strong>DITERIMA</strong>.
                                        Silakan login ke website EventCrew secara berkala untuk melihat
                                        informasi mengenai penugasan volunteer yang akan diberikan oleh panitia.
                                    </p>

                                </div>
                            @endif

                            @if ($pendaftaran->status_pendaftaran == 'ditolak')
                                <div
                                    style="margin-top:35px;background:#FEF2F2;padding:20px;border-left:6px solid #EF4444;border-radius:8px;">

                                    <h3 style="margin-top:0;color:#991B1B;">
                                        Mohon Maaf
                                    </h3>

                                    <p style="margin:0;color:#444;line-height:28px;">
                                        Setelah dilakukan proses seleksi, pendaftaran Anda belum dapat diterima
                                        pada kesempatan ini.

                                        Jangan berkecil hati, kami berharap Anda dapat mengikuti
                                        event EventCrew lainnya di masa mendatang.
                                    </p>

                                </div>
                            @endif

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:30px;background:#f8f8f8;text-align:center;">

                            <p style="margin:0;font-size:14px;color:#777;">
                                Email ini dikirim secara otomatis oleh sistem
                            </p>

                            <h3 style="margin:12px 0 0;color:#222;">
                                Event<span style="color:#7A3E3E;">Crew</span>
                            </h3>

                            <p style="margin-top:8px;font-size:13px;color:#999;">
                                © {{ date('Y') }} EventCrew. All Rights Reserved.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
