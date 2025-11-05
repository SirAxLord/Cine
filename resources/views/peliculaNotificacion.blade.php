<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Notificación de Nueva Película</title>
    </head>
    <body style="margin:0; padding:0; background-color:#f4f4f7;">
        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f4f4f7;">
            <tr>
                <td align="center" style="padding:24px;">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; background:#ffffff; border-radius:10px; border:1px solid #e5e7eb;">
                        <tr>
                            <td style="padding:24px 24px 0 24px; text-align:center;">
                                <div style="font-size:18px; font-weight:700; color:#111827; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">Cinemania</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:8px 24px 0 24px; text-align:center;">
                                <h1 style="margin:0; font-size:22px; line-height:28px; color:#111827; font-weight:700; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">¡Nueva película disponible!</h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 24px 0 24px;">
                                <p style="margin:0; font-size:16px; line-height:24px; color:#374151; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                    La película <strong style="color:#111827;">{{ $pelicula->titulo }}</strong> ha sido agregada a nuestro catálogo.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:16px 24px 0 24px;">
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px;">
                                    <tr>
                                        <td style="padding:16px 16px;">
                                            <ul style="padding:0; margin:0; list-style:none; font-size:14px; line-height:22px; color:#374151; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                <li style="margin:0 0 6px 0;"><strong style="color:#111827;">Título:</strong> {{ $pelicula->titulo }}</li>
                                                @if(!empty($pelicula->genero))
                                                    <li style="margin:0 0 6px 0;"><strong style="color:#111827;">Género:</strong> {{ $pelicula->genero }}</li>
                                                @endif
                                                @if(!empty($pelicula->director))
                                                    <li style="margin:0 0 6px 0;"><strong style="color:#111827;">Director:</strong> {{ $pelicula->director }}</li>
                                                @endif
                                                @if(!empty($pelicula->duracion))
                                                    <li style="margin:0;"><strong style="color:#111827;">Duración:</strong> {{ $pelicula->duracion }} min</li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding:20px 24px 8px 24px;">
                                <a href="{{ route('funciones.user.index') }}" style="display:inline-block; background-color:#2563eb; color:#ffffff; text-decoration:none; padding:12px 20px; border-radius:8px; font-size:14px; font-weight:600; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">Comprar boletos</a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding:0 24px 24px 24px;">
                                <a href="{{ url('/') }}" style="display:inline-block; color:#2563eb; text-decoration:underline; font-size:12px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">Visitar sitio</a>
                            </td>
                        </tr>
                    </table>

                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; margin-top:12px;">
                        <tr>
                            <td style="text-align:center; color:#6b7280; font-size:12px; line-height:18px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                <p style="margin:0;">Recibiste este correo porque estás suscrito a notificaciones de Cinemania.</p>
                                <p style="margin:4px 0 0 0;">© {{ date('Y') }} Cinemania. Todos los derechos reservados.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>