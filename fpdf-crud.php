<?php
use setasign\Fpdi\Fpdi;

require_once('assets/fpdf182/fpdf.php');
require_once('assets/fpdi-2.3.6/src/autoload.php');
// require 'config.php';

function generateApplicationForm($row) {
    $customer_card_details = json_decode($row['customer_card_details']);
    $key_official_contact_details = json_decode($row['key_official_contact_details']);
    $customer_address = json_decode($row['customer_address']);
    $customer_details = json_decode($row['customer_details']);

    // initiate FPDI
    $pdf = new Fpdi();
    // set the source file
    $pdf->setSourceFile(APPLICATION_FORM_TEMPLATE);
    // add a page
    $pdf->AddPage();
    // We import only page 1
    $tpl = $pdf->importPage(1);
    // Let's use it as a template from top-left corner to full width and height
    $pdf->useTemplate($tpl, 0, 0, null, null);

    // Set font and color
    // $pdf->SetFont('Helvetica', 'B', 20); // Font Name, Font Style (eg. 'B' for Bold), Font Size
    // $pdf->SetTextColor(0, 0, 0); // RGB
    // Position our "cursor" to left edge and in the middle in vertical position minus 1/2 of the font size
    // $pdf->SetXY(0, 139.7-10);
    // Add text cell that has full page width and height of our font
    // $pdf->Cell(215.9, 20, 'This text goes to middle', 0, 2, 'C');
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(112, 24, $customer_card_details->name_on_card, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(112, 1.6, $customer_card_details->name_on_card, 0, 2, 'C');

    switch($customer_card_details->constitution) {
        case '1601':    $horizonal = 125; $veritical = 7;  break;
        case '1602':    $horizonal = 186; $veritical = 7;  break;
        case '1603':    $horizonal = 260; $veritical = 7;  break;
        case '1604':    $horizonal = 330; $veritical = 7;  break;
        
        case '1606':    $horizonal = 125; $veritical = 18;  break;
        case '1605':    $horizonal = 186; $veritical = 18;  break;
        case '1607':    $horizonal = 260; $veritical = 18;  break;
        case '1608':    $horizonal = 260; $veritical = 18;  break;
        default:        $horizonal = 330; $veritical = 18;  break;
    }
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell($horizonal, $veritical, "4", 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(77, 22, $key_official_contact_details->name, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(108, -2, $key_official_contact_details->mobile, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(92, 11, $key_official_contact_details->email_add, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(72, 22, $customer_address->permanent->address, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(80, 20, $customer_address->permanent->location, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(292, -20, $customer_address->permanent->city, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(80, 30, $customer_address->permanent->district, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(292, -30, $customer_address->permanent->state, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(77, 40, $customer_address->permanent->pincode, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(72, -20, $customer_address->communication->address, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(80, 60, $customer_address->communication->location, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(292, -60, $customer_address->communication->city, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(80, 70, $customer_address->communication->district, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(292, -70, $customer_address->communication->state, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(77, 80, $customer_address->communication->pincode, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(77, -61, $key_official_contact_details->nominee, 0, 2, 'C');

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(110, 82, $key_official_contact_details->area, 0, 2, 'C');
    
    switch($customer_details->customer_requirement) {
        case 'Fleet':   $horizonal1 = 125; $veritical1 = -12;  break;
        default:        $horizonal1 = 185; $veritical1 = -12;  break;
    }
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell($horizonal1, $veritical1, "4", 0, 2, 'C');

    /*
    * 2nd page
    */
    $pdf->AddPage();
    // We import only page 1
    $tpl = $pdf->importPage(2);
    // Let's use it as a template from top-left corner to full width and height
    $pdf->useTemplate($tpl, 0, 0, null, null);

    /*
    * 3rd page
    */
    $pdf->AddPage();
    // We import only page 1
    $tpl = $pdf->importPage(3);
    // Let's use it as a template from top-left corner to full width and height
    $pdf->useTemplate($tpl, 0, 0, null, null);

    /*
    * 4th page
    */
    $pdf->AddPage();
    // We import only page 1
    $tpl = $pdf->importPage(4);
    // Let's use it as a template from top-left corner to full width and height
    $pdf->useTemplate($tpl, 0, 0, null, null);

    /*
    * 5th page
    */
    $pdf->AddPage();
    // We import only page 1
    $tpl = $pdf->importPage(5);
    // Let's use it as a template from top-left corner to full width and height
    $pdf->useTemplate($tpl, 0, 0, null, null);

    // Output our new pdf into a file
    // F = Write local file
    // I = Send to standard output (browser)
    // D = Download file
    // S = Return PDF as a string
    $pdf->Output('applications/generated.pdf', 'F');

    return WEB_URL . 'applications/generated.pdf';
}

const DPI = 96;
const MM_IN_INCH = 25.4;
const A4_HEIGHT = 297;
const A4_WIDTH = 210;
// tweak these values (in pixels)
const MAX_WIDTH = 800;
const MAX_HEIGHT = 500;

function addImageToPdf($form_number, $source, $image1, $image2) {

    $pdf = new PDF();
    $pdf->setSourceFile($source);

    $pdf->AddPage();
    $tpl = $pdf->importPage(1);
    $pdf->useTemplate($tpl, 0, 0, null, null);

    $pdf->AddPage();
    $tpl = $pdf->importPage(2);
    $pdf->useTemplate($tpl, 0, 0, null, null);
    
    $pdf->AddPage();
    $pdf->centreImage($image1);

    $pdf->AddPage();
    $pdf->centreImage($image2);

    $pdf->AddPage();
    $tpl = $pdf->importPage(3);
    $pdf->useTemplate($tpl, 0, 0, null, null);

    $pdf->AddPage();
    $tpl = $pdf->importPage(4);
    $pdf->useTemplate($tpl, 0, 0, null, null);

    $pdf->AddPage();
    $tpl = $pdf->importPage(5);
    $pdf->useTemplate($tpl, 0, 0, null, null);

    $pdf->Output('applications/'.$form_number.'-final.pdf', 'F');
    return 'applications/'.$form_number.'-final.pdf';
}

class PDF extends Fpdi {
    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    // tweak these values (in pixels)
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;

    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }

    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);

        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;

        $scale = min($widthScale, $heightScale);

        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    function centreImage($img) {
        list($width, $height) = $this->resizeToFit($img);

        // you will probably want to swap the width/height
        // around depending on the page's orientation
        $this->Image(
            $img, (self::A4_HEIGHT - $width) / 2,
            (self::A4_WIDTH - $height) / 2,
            $width,
            $height
        );
    }
}

?>