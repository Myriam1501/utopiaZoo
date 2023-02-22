<?php


namespace App\Service;

use Dompdf\Dompdf;
use \App\Service\Options;

class PdfService extends Dompdf
{
    private $domPdf;

    public function __construct($config = array()) {
        parent::__construct($config);
        $this->domPdf =new DomPdf();
    }

    public function showPdfFile($html) {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->stream("reservation.pdf", [
            'Attachement' => false
        ]);
    }

    public function generateBinaryPDF($html) {
        $this->domPdf->loadHtml($html);
        $this->domPdf->render();
        $this->domPdf->output();
    }
}
