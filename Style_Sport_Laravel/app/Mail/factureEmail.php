<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class factureEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fecha_factura;

    /**
     * Create a new message instance.
     */
    public function __construct($fecha_factura)
    {
        $this->fecha_factura = $fecha_factura;
    }

    /**
     * Get the message envelope.
     */

    public function build()
    {
        $fecha_factura = $this->fecha_factura;
        $id_user = FacadesAuth::user()->id;
        $datos_usuario = DB::selectOne("SELECT u.nombre, u.telefono, u.direccion , u.correo, c.ciudades, u.N_Identificacion  FROM Users u INNER JOIN Ciudad c ON u.id_ciudad =c.id WHERE u.id = $id_user");
        $compras = DB::select("SELECT c.total, c.id, p.nombre, c.cantidad, t.talla, colors.color, c.colores_id FROM compra c
        INNER JOIN productos p ON c.id_producto = p.id
        INNER JOIN tallas t ON c.tallas_id = t.id
        INNER JOIN colores colors ON c.colores_id = colors.id
        INNER JOIN factura f ON c.factura_id = f.id
        WHERE c.id_user = $id_user AND f.fecha = '$fecha_factura'");
        return $this->subject('Factura')
                    ->view('mails.facture', compact('compras', 'datos_usuario', 'fecha_factura'));
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
